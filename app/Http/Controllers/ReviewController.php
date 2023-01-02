<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Client;
use App\Models\FollowUp;
use App\Models\Measurement;
use App\Models\Observation;
use App\Models\Onboarding;
use App\Models\Planning;
use App\Models\Review;
use App\Models\UploadLab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use DateTime;

class ReviewController extends Controller
{

    public function getData($id = null) {
        $client = Client::findOrFail($id);
        $onboarding = Onboarding::where('client_id', $client->id)->first();
        $client->load(['summary', 'schedule_assement']);
        $observations = Observation::where('client_id', $onboarding->client_id)->get();
        $uploadlabs = UploadLab::where('client_id', $onboarding->client_id)->with('upload_lab_type')->get();
        $plannings = Planning::where('client_id', $onboarding->client_id)->with('plan_types')->get();
        $reviews = Review::where('client_id', $onboarding->client_id)->get();
        $measurements = Measurement::where('client_id', $onboarding->client_id)->get();
        $follow_ups = FollowUp::where('client_id', $client->id)->get();

        return [
            'client' => $client,
            'onboarding'=> $onboarding,
            'observations' => $observations,
            'uploadlabs' => $uploadlabs,
            'plannings' => $plannings,
            'reviews' => $reviews,
            'measurements' => $measurements,
            'follow_ups' => $follow_ups,     
            
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          try{
            return view('pages.review.index');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the review index');
        } 
    }

    public function list(Client $client)
    {
        try{
            $data = $this->getData($client->id);
            return view('pages.review.list',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('review.index')->with('error', 'Error occured in the review list');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        try{
            $data = $this->getData($client->id);
            return view('pages.review.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the planning create');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        try{
            $data = $request->only(Review::REQUEST_INPUTS);
            Review::create($data);
            return redirect()->route('review.index')->with('success', 'Review Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('review.index')->with('error', 'Error occured in the Review store');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $review = Review::findOrFail($id);
            $data = $this->getData($review->client_id);
            return view('pages.review.show',compact('review','data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('review.index')->with('error', 'Error occured in the review show');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $review = Review::findOrFail($id);
            $data = $this->getData($review->client_id);
            return view('pages.review.edit',compact('review','data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('review.index')->with('error', 'Error occured in the review show');
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $review = Review::findOrFail($id);
            $review->update($request->only(Review::REQUEST_INPUTS));
            return redirect()->route('review.index')->with('success', 'Review Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('review.index')->with('error', 'Error occured in the Review store');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $review = Review::findOrFail($id);
            $review->delete();
            return response()->json('Review Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('review.index')->with('error', 'Error occured in the review destroy');
        }
    }

    public function getReview()
    {
        try {
            $clients = Client::where('journey','onboarding')->with('reviews')->get();
        
            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('review', function ($client) {
                return '<a href="' . route('review.add', $client) . '" class="btn btn-primary  btn-sm"><i class="fa fa-magnifying-glass"></i> </a>';
            })->editColumn('view', function ($client) {
                    return '<a href="' . route('review.list', $client) . '" class="btn btn-info  btn-sm"><i class="fa fa-eye"></i> </a>';
            })
            ->rawColumns(['review','view'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('review.index')->with('error', 'Error occurred in the client store');
        }
    }

     public function getClientReview($client)
    {
        try {
            $client = Client::findOrFail($client);
            $client->load('reviews');
            $reviews = $client->reviews;
    
    

            return Datatables::of($reviews)
                ->editColumn('review_date', function ($review) {
                    return dateFormat($review->review_date);
                })->editColumn('next_review_date', function ($review) {
                return dateFormat($review->next_review_date);
            })->editColumn('client_progress', function ($review) {
                return $review->client_progress;
            })
            ->editColumn('download', function ($review) {
                      return '<a target="_blank" href="' . route('review.reviewPdf', ['client' => $review->client_id ,'review' => $review]) . '" class="btn btn-primary">Download</i> </a>';
            })
            ->editColumn('show', function ($review) {
                return '<a href="' . route('review.show', $review) . '" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($review) {
                return '<a href="' . route('review.edit', $review) . '" class="btn btn-success  btn-sm"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($review) {
                return '<div class="form-group"><button class="btn btn-danger  btn-sm" onclick=deleteReview('. $review->id .')  ><i class="fa fa-trash"></i></a></div>';
            })->rawColumns(['show', 'edit','delete','download'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }

        public function reviewPdf($client,$review)
    {
        try{
            $client = Client::findOrFail($client);
            $client->load('onboarding');
            $review = Review::where('client_id', $client->id)->where('id', $review)->first();
            $onboarding_date = $client->onboarding->onboarding_date;
        $data = [
        'date' => Carbon::now()->format('d-M-Y'),
        'image' =>  url('assets\images\logo.png'),
        'client' => $client
    ];  
    $start_date = new DateTime($onboarding_date);
    $end_date = new DateTime($review->review_date);
    $remaining_days = $start_date->diff($end_date)->format('%a');
    $data['remaining_days'] = $remaining_days;
    $data['review'] = $review;       

    $pdf = Pdf::loadView('pdf.review', $data);
    return $pdf->stream();
        }catch(Exception $e) {
           info($e);
           return redirect()->route('review.index')->with('error', 'Error occured in the planning show');
        } 
    }
}