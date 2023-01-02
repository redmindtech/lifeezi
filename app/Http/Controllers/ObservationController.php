<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObservationRequest;
use App\Models\Measurement;
use App\Models\Onboarding;
use App\Models\Client;
use App\Models\Observation;
use App\Models\ObservationType;
use Illuminate\Http\Request;
use Exception;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\DataTables;
class ObservationController extends Controller
{

    public function getData($id = null) {
        $onboarding = Onboarding::findOrFail($id);
        $client = Client::findOrFail($onboarding->client_id);
        $client->load(['summary', 'schedule_assement']);
        $observations = Observation::where('client_id', $onboarding->client_id)->get();

        return [
            'client' => $client,
            'onboarding'=> $onboarding,
            'observations' => $observations
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
            $clients = Client::whereIn('journey',['onboarding'])->paginate(5);
            return view('pages.observation.index',compact('clients'));
        }catch(Exception $e) {
           info($e->getMessage());
           return redirect()->route('measurement.index')->with('error', 'Error occured in the observation index');
        } 
    }

    public function list(Client $client)
    {
        try{
            $onboarding = Onboarding::where('client_id', $client->id)->first();
            $data = $this->getData($onboarding->id);
            $observations = Observation::where('client_id', $client->id)->get();
            return view('pages.observation.list',compact('data','observations'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the observation list');
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
            $onboarding = Onboarding::where('client_id', $client->id)->first();
            $data = $this->getData($onboarding->id);
            return view('pages.observation.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('observation.index')->with('error', 'Error occured in the onboarding create');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObservationRequest $request)
    {
    
     try{
            $observation = Observation::create($request->only(Observation::REQUEST_OBSERVATION));
            $data = $request->only(ObservationType::REQUEST_INPUTS);
            
             if($data['meal_type'] ?? null) {
                foreach ($data['meal_type'] as $key => $meal_type) {
                    ObservationType::create([
                        'observation_id' => $observation->id ?? null,
                        'meal_type' => $meal_type ?? null,
                        'meal_time' => $data['meal_time'][$key] ?? null,
                        'meal' => $data['meal'][$key] ?? null,
                        'comments' => $data['comments'][$key] ?? null,
                    ]);
                }
            }
            return redirect()->route('observation.index')->with('success', 'Observation Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('observation.index')->with('error', 'Error occured in the observation create');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Observation $observation)
    {
        try{
            $data = $this->getData($observation->onboarding_id);
            $observation->load('observation_type');
            return view('pages.observation.show',compact('data','observation'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('observation.index')->with('error', 'Error occured in the observation show');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Observation $observation)
    {
        try{
            $data = $this->getData($observation->onboarding_id);
            $observation->load('observation_type');
            return view('pages.observation.edit',compact('data','observation'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('observation.index')->with('error', 'Error occured in the observation edit');
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Observation $observation)
    {
        try{
            $observation->update($request->only(Observation::REQUEST_OBSERVATION));
            $data = $request->only(ObservationType::REQUEST_INPUTS);
             $ids = $request->input('ids');
             if($data['meal_type'] ?? null) {
                foreach ($data['meal_type'] as $key => $meal_type) {
                      ObservationType::updateOrCreate(
                        ['id' => $ids[$key] ?? null],[
                        'observation_id' => $observation->id ?? null,
                        'meal_type' => $meal_type ?? null,
                        'meal_time' => $data['meal_time'][$key] ?? null,
                        'meal' => $data['meal'][$key] ?? null,
                        'comments' => $data['comments'][$key] ?? null,
                    ]);
                }
            }

            $deleteObservation = $request->input('delete') ?? null;
            if($deleteObservation) {
                foreach($deleteObservation as $id){
                    $observationType = ObservationType::findOrFail($id);
                    $observationType->delete();

                }
            }
            return redirect()->route('observation.index')->with('success', 'Observation Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('observation.index')->with('error', 'Error occured in the observation update');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($observation)
    {
        try{
            $observation = Observation::findOrFail($observation);
            $observation->observation_type()->delete();
            $observation->delete();
            return response()->json('Observation Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('observation.index')->with('error', 'Error occured in the observation destroy');
        }
    }

    public function getMeals() {
        try {
            $options = MEALTYPE;
            return response()->json(['data' => $options]);
        } catch (\Exception  $exception) {
            info($exception);
            return redirect()->back()->with('error', 'Error occurred. Please contact administrator');
        }
    }

     public function getObservation()
    {
        try {
            $clients = Client::where('journey','onboarding')->with('observation')->get();
            

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('observation', function ($client) {
                return '<a href="' . route('observation.add', $client) . '" class="btn btn-primary  btn-sm"><i class="fa fa-tower-observation"></i> </a>';
            })->editColumn('view', function ($client) {
                    return '<a href="' . route('observation.list', $client) . '" class="btn btn-info  btn-sm"><i class="fa fa-eye"></i> </a>';
            })
            ->rawColumns(['observation','view'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }

   public function getClientObservation($client)
    {
        try {
            $client = Client::findOrFail($client);
            $observations = Observation::where('client_id', $client->id)->get();


            return Datatables::of($observations)
                ->editColumn('date', function ($observation) {
                    return dateFormat($observation->date);
                })->editColumn('day_of_observation', function ($observation) {
                return ucfirst($observation->day_of_observation);
            })->editColumn('wake_up_time', function ($observation) {
                return getTime($observation->wake_up_time);
            })->editColumn('bed_time', function ($observation) {
                return getTime($observation->bed_time);
            })->editColumn('show', function ($observation) {
                return '<a href="' . route('observation.show', $observation) . '" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($observation) {
                return '<a href="' . route('observation.edit', $observation) . '" class="btn btn-success  btn-sm"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($observation) {
                return '<div class="form-group" ><button class="btn btn-danger  btn-sm" onclick=deleteObservation('. $observation->id .')  ><i class="fa fa-trash"></i></a></div>';
                  // return '<form method="POST"  onsubmit="return confirm("Are you sure want to delete the client?")" action="' . route('client.destroy',$client) .'">' . csrf_field() . method_field('DELETE') . '<div class="form-group"><button class="btn btn-danger" type="submit"><i class="fa fa-trash "></i></a></div></form> ';
                
            })->rawColumns(['show', 'edit','delete'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }


    public function observationList($client){
        try{
           $observations = Observation::where('client_id',$client)->get();
            $data = [
                'observations' => $observations,
                'image' =>  url('assets\images\logo.png')
            ];
            return Pdf::loadView('pages.observation.download',compact('data'))->stream();
           
        }catch(Exception $e) {
           info($e);
           return redirect()->route('observation.index')->with('error', 'Error occured in the observation destroy');
        } 
    }
}