<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisengagementRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Disengagement;
use Exception;
use App\Models\Employee;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class DisEngagementController extends Controller
{

    public function getData($client = null) {
        $employees = Employee::all();
        return [
            'client' => $client,
            'employees' => $employees 
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
            $clients = Client::whereIn('journey', ['engagement','review'])->paginate(5);
            return view('pages.disengagement.index',compact('clients'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('disengagement.index')->with('error', 'Error occured in the disengagement index');
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
            $data = $this->getData($client);
            return view('pages.disengagement.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('disengagement.index')->with('error', 'Error occured in the disengagement create');
        } 
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisengagementRequest $request)
    {
        try{
            Disengagement::create($request->only(Disengagement::REQUEST_INPUTS));
            $client_id = $request->input('client_id') ?? null;
            $client = Client::findOrFail($client_id);
            $client->journey = 'disengagement';
            $client->save();
    return redirect()->route('disengagement.index')->with('success', 'DisEngagement Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('disengagement.index')->with('error', 'Error occured in the disengagement create');
        } 
    }

    public function show( $client){
        
       try{
            $client = Client::findOrFail($client);

                         $data = [
        'title' => $client->client_name,
        'date' => Carbon::now()->format('d-M-Y'),
        'image' =>  url('assets\images\logo.png')
    ];
            $disengagement = Disengagement::where('client_id', $client->id)->first();
            $data['disengagement'] = $disengagement;
            if($disengagement->disengagement_type == 'temporary_discontinuation'){
               $pdf = Pdf::loadView('pdf.temporary', $data);
                return $pdf->stream();
            } else {
                $pdf = Pdf::loadView('pdf.document', $data);
                return $pdf->stream();
            }
        }catch(Exception $e) {
           info($e);
           return redirect()->route('disengagement.index')->with('error', 'Error occured in the disengagement create');
        } 
    }

       public function getDisEngagement()
    {
        try {
            $clients = Client::whereIn('journey', ['onboarding','disengagement','enquiry'])->with('disengagement')->get();
            

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('disengagement', function ($client) {
                if (!$client->disengagement ?? null)
                return '<a href="' . route('disengagement.add', $client) . '" class="btn btn-primary"><i class="fa fa-thumbs-down"></i> </a>';
                else {
                  return '<a target="_blank"  href="' . route('disengagement.show', $client) . '" class="btn btn-primary">Download </a>';
                }
            })
            ->rawColumns(['disengagement'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}
