<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowupRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Exception;
use App\Models\Observation;
use App\Models\Onboarding;
use App\Models\Client;
use App\Models\FollowUp;

class FollowUpController extends Controller
{

      public function getData($id = null) {
        $onboarding = Onboarding::where('client_id',$id)->first();
        $client = Client::findOrFail($id);
        $client->load(['summary', 'schedule_assement']);
        $observations = Observation::where('client_id', $id)->get();
         $follow_ups = FollowUp::where('client_id', $client->id)->get();

        return [
            'client' => $client,
            'onboarding'=> $onboarding,
            'observations' => $observations,
            'follow_ups' => $follow_ups
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
            return view('pages.followup.index');
        }catch(Exception $e) {
           info($e->getMessage());
           return redirect()->route('upload.index')->with('error', 'Error occured in the upload index');
        } 
    }

        public function list(Client $client)
    {
        
        try{
            $data = $this->getData($client->id);
            return view('pages.followup.list',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('followup.index')->with('error', 'Error occured in the followup list');
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
           
            return view('pages.followup.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('followup.index')->with('error', 'Error occured in the followup create');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FollowupRequest $request)
    {
              try{
            FollowUp::create($request->only(FollowUp::REQUEST_INPUTS));
            
            return redirect()->route('followup.index')->with('success', 'FollowUp Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('followup.index')->with('error', 'Error occured in the followup create');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $followUp)
    {
        try{
            $followUp = FollowUp::findOrFail($followUp);
            $data = $this->getData($followUp->client_id);
            return view('pages.followup.show',compact('data','followUp'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('followup.index')->with('error', 'Error occured in the followup show');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($followUp)
    {
        try{
            $followUp = FollowUp::findOrFail($followUp);
            $data = $this->getData($followUp->client_id);
            return view('pages.followup.edit',compact('data','followUp'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('followup.index')->with('error', 'Error occured in the followup edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $followUp)
    {
        try{
            $followUp=FollowUp::findOrFail($followUp);
            $followUp->update($request->only(FollowUp::REQUEST_INPUTS));
            return redirect()->route('followup.index')->with('success', 'FollowUp Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('followup.index')->with('error', 'Error occured in the followup update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $followUp)
    {
        try{
            $followUp = FollowUp::findOrFail($followUp);
            $followUp->delete();
            return response()->json('FollowUp Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('followup.index')->with('error', 'Error occured in the followup update');
        }
    }



     public function getFollowUp()
    {
        try {
            $clients = Client::where('journey','onboarding')->with('follow_up')->get();
            

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('follow_up', function ($client) {
                return '<a href="' . route('followup.add', $client) . '" class="btn btn-primary  btn-sm"><i class="fa fa-layer-group"></i> </a>';
            })->editColumn('view', function ($client) {
                    return '<a href="' . route('followUpList', $client) . '" class="btn btn-info  btn-sm"><i class="fa fa-eye"></i> </a>';
            })
            ->rawColumns(['follow_up','view'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }

    public function getClientFollowUp($client)
    {
        try {
            $client = Client::findOrFail($client);
            $followups = FollowUp::where('client_id', $client->id)->get();

            return Datatables::of($followups)
                ->editColumn('followup_date', function ($followup) {
                    return dateFormat($followup->follow_date);
                })->editColumn('followup_day', function ($followup) {
                return $followup->follow_day;
            })->editColumn('follow_up', function ($followup) {
                return ucfirst($followup->follow_up);
            })->editColumn('comments', function ($followup) {
                return ucfirst($followup->comments);
            })->editColumn('deviation', function ($followup) {
                return ucfirst($followup->deviation);
            })
            ->editColumn('show', function ($followup) {
                return '<a href="' . route('followup.show', $followup) . '" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($followup) {
                return '<a href="' . route('followup.edit', $followup) . '" class="btn btn-success  btn-sm"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($followup) {
                return '<div class="form-group" ><button class="btn btn-danger  btn-sm" onclick=deleteFollowUp('. $followup->id .')  ><i class="fa fa-trash"></i></a></div>';
                  // return '<form method="POST"  onsubmit="return confirm("Are you sure want to delete the client?")" action="' . route('client.destroy',$client) .'">' . csrf_field() . method_field('DELETE') . '<div class="form-group"><button class="btn btn-danger" type="submit"><i class="fa fa-trash "></i></a></div></form> ';
                
            })->rawColumns(['show', 'edit','delete'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}