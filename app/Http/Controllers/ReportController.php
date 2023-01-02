<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FollowUp;
use App\Models\Measurement;
use App\Models\Observation;
use App\Models\Onboarding;
use App\Models\Planning;
use App\Models\Review;
use App\Models\UploadLab;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class ReportController extends Controller
{

    public function getData($id = null) {
        $client = Client::findOrFail($id);
        $onboarding = Onboarding::where('client_id', $client->id)->first();      
        $client->load(['summary', 'schedule_assement']);
        $observations = Observation::where('client_id', $onboarding->client_id)->get();
        $uploadlabs = UploadLab::where('client_id', $onboarding->client_id)->with('upload_lab_type')->get();
        $plannings = Planning::where('client_id', $onboarding->client_id)->with('plan_types')->get();
        $follow_ups = FollowUp::where('client_id', $client->id)->get();
             $measurements = Measurement::with('measurement_type')->where('client_id', $onboarding->client_id)->get();
        $reviews = Review::where('client_id', $client->id)->get();
        return [
            'client' => $client,
            'onboarding'=> $onboarding,
            'observations' => $observations,
            'uploadlabs' => $uploadlabs,
            'plannings' => $plannings,
            'follow_ups' => $follow_ups,
            'measurements' => $measurements,
            'reviews' => $reviews
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
            return view('pages.reports.index');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client index');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $data = $this->getData($id);
            return view('pages.reports.show', compact('data'));

        }catch(Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client show');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

       public function getReportClient()
      {
          try{
            $clients = Client::all();

            return DataTables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('show', function ($client) {
                return '<a href="' . route('reports.show', $client) . '" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i> </a>';
            })->rawColumns(['show'])
                ->make(true);
        } catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        } 
    }


}