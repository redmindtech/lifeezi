<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Client;
use Exception;
use App\Models\Summary;
use App\Http\Requests\SummaryRequest;
use Yajra\DataTables\DataTables;

class SummaryController extends Controller
{
   
    public function getData($summary) {
        $client = Client::with(['schedule_assement'])->findOrFail($summary->client_id);
        return [
            'client' => $client,
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
            return view('pages.summary.index');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the summary index');
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
            $client->load('schedule_assement');
            $data = [  'client' => $client ];
            return view('pages.summary.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('summary.index')->with('error', 'Error occured in the summary create');
        } 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SummaryRequest $request)
    {
        try{
            Summary::create($request->only(Summary::REQUEST_INPUTS));
            $summary_status = $request->input('summary_status');
            if ($summary_status == 'Joining') {
                $client_id = $request->input('client_id');
                $client = Client::findOrFail($client_id);
                $client->journey = 'joining';
                $client->save();
            }
            return redirect()->route('summary.index')->with('success', 'Summary Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client store');
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
            $summary = Summary::findOrFail($id);
            $data = $this->getData($summary);
            return view('pages.summary.show',compact('data', 'summary'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('summary.index')->with('error', 'Error occured in the summary show');
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
            $summary = Summary::findOrFail($id);    
            $data = $this->getData($summary);
            return view('pages.summary.edit',compact('data', 'summary'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('summary.index')->with('error', 'Error occured in the summary edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SummaryRequest $request, Summary $summary)
    {
        try{
            $summary->update($request->only(Summary::REQUEST_INPUTS));
            $summary_status = $request->input('summary_status');
            $client_id = $request->input('client_id');
            $client = Client::findOrFail($client_id);
            if ($summary_status == 'Joining') {
                $client->journey = 'joining';
                $client->save();
            } else {
                $client->journey = 'schedule';
                $client->save();
            }
            return redirect()->route('summary.index')->with('success', 'Summary Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('summary.index')->with('error', 'Error occured in the summary update');
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
            $summary = Summary::findOrFail($id);
            $summary->delete();
            return response()->json('Summary Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('summary.index')->with('error', 'Error occured in the summary destroy');
        } 
    }

        public function getSummary()
    {
        try {
            $clients = Client::whereIn('journey',['schedule', 'joining'])->with('summary')->get();
            

            return DataTables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('summary', function ($client) {
                if (!$client->summary ?? null)
                return '<a href="' . route('summary.add', $client) . '" class="btn btn-primary"><i class="fa fa-book"></i> </a>';
                else
                    return $client->summary->summary_status;
            })->editColumn('show', function ($client) {
                if ($client->summary ?? null)
                    return '<a href="' . route('summary.show', $client->summary->id) . '" class="btn btn-primary"><i class="fa fa-eye"></i> </a>';
                else
                    return '-';
            })->editColumn('edit', function ($client) {
                if ($client->summary ?? null)
                    return '<a href="' . route('summary.edit', $client->summary->id) . '" class="btn btn-success"> <i class="fa fa-user-pen "></i></a>';
                else
                    return '-';
            })->editColumn('delete', function ($client) {
                if ($client->summary ?? null)
                return '<div class="form-group"><button class="btn btn-danger" onclick="deleteSummary('. $client->summary->id .')"><i class="fa fa-trash "></i></a></div></form> ';
                else
                    return '-';

            })->rawColumns(['summary','show', 'edit', 'delete'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}
