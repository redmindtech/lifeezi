<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ScheduleAssement;
use Exception;
 use Yajra\DataTables\DataTables;

class ScheduleController extends Controller
{

        public function getData($scheduleAssement) {
        $client = Client::findOrFail($scheduleAssement->client_id);
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
            return view('pages.schedule.index');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the schedule index');
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
            $data = [  'client' => $client ];
            return view('pages.schedule.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('schedule.index')->with('error', 'Error occured in the schedule create');
        } 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        try{
            ScheduleAssement::create($request->only(ScheduleAssement::REQUEST_INPUTS));
            $client_id = $request->input('client_id');
            $client = Client::findOrFail($client_id);
            $client->journey = 'schedule';
            $client->save();
            return redirect()->route('schedule.index')->with('success', 'Schedule Created Successfully');
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
            $scheduleAssement = ScheduleAssement::findOrFail($id);
            $data = $this->getData($scheduleAssement);
            return view('pages.schedule.show',compact('data', 'scheduleAssement'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('schedule.index')->with('error', 'Error occured in the schedule show');
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
            $scheduleAssement = ScheduleAssement::findOrFail($id);
            $data = $this->getData($scheduleAssement);
            return view('pages.schedule.edit',compact('data', 'scheduleAssement'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('schedule.index')->with('error', 'Error occured in the schedule edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $scheduleAssement)
    {
        try{
            $scheduleAssement = ScheduleAssement::findOrFail($scheduleAssement);
            $scheduleAssement->update($request->only(ScheduleAssement::REQUEST_INPUTS));
            return redirect()->route('schedule.index')->with('success', 'Schedule Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('schedule.index')->with('error', 'Error occured in the schedule update');
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
            $scheduleAssement = ScheduleAssement::findOrFail($id);
            $scheduleAssement->delete();
            return response()->json('Schedule Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('schedule.index')->with('error', 'Error occured in the schedule destroy');
        } 
    }

    public function getSchedule()
    {
        try {
            $clients = Client::whereIn('journey', ['enquiry','schedule'])->with('schedule_assement')->get();
            

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('schedule', function ($client) {
                if (!$client->schedule_assement ?? null)
                return '<a href="' . route('schedule.add', $client) . '" class="btn btn-primary"><i class="fa fa-clock"></i> </a>';
                else
                    return Carbon::parse($client->schedule_assement->schedule_date_time)->format('d-M-Y g:i A');
            })->editColumn('show', function ($client) {
                if ($client->schedule_assement ?? null)
                    return '<a href="' . route('schedule.show', $client->schedule_assement->id) . '" class="btn btn-primary"><i class="fa fa-eye"></i> </a>';
                else
                    return '-';
            })->editColumn('edit', function ($client) {
                if ($client->schedule_assement ?? null)
                    return '<a href="' . route('schedule.edit', $client->schedule_assement->id) . '" class="btn btn-success"> <i class="fa fa-user-pen "></i></a>';
                else
                    return '-';
            })->editColumn('delete', function ($client) {
                if ($client->schedule_assement ?? null)
                    return '<div class="form-group"><button class="btn btn-danger" onclick="deleteSchedule('. $client->schedule_assement->id  .')" type="submit"><i class="fa fa-trash "></i></a></div> ';
                else
                    return '-';

            })->rawColumns(['schedule','show', 'edit', 'delete'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}
