<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use App\Models\Onboarding;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Client;
use Exception;
use App\Http\Requests\PlanningRequest;
use App\Models\Planning;
use App\Models\PlanType;
use App\Models\UploadLab;
use Illuminate\Support\Str;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

use Yajra\DataTables\DataTables;

class PlanningController extends Controller
{
    
    public function getData($id = null) {
        $onboarding = Onboarding::findOrFail($id);
        $client = Client::findOrFail($onboarding->client_id);
        $client->load(['summary', 'schedule_assement']);
        $observations = Observation::where('client_id', $onboarding->client_id)->get();
        $uploadlabs = UploadLab::where('client_id', $onboarding->client_id)->with('upload_lab_type')->get();
        $plannings = Planning::where('client_id', $onboarding->client_id)->with('plan_types')->get();

        return [
            'client' => $client,
            'onboarding'=> $onboarding,
            'observations' => $observations,
            'uploadlabs' => $uploadlabs,
            'plannings' => $plannings
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
            return view('pages.planning.index');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the planning index');
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
            return view('pages.planning.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the planning create');
        } 
    }

    public function list(Client $client)
    {
        try{
            $onboarding = Onboarding::where('client_id', $client->id)->first();
            $data = $this->getData($onboarding->id);
            return view('pages.planning.list',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the planning list');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanningRequest $request)
    {
        
        try{
            $planning = Planning::create($request->only(Planning::REQUEST_INPUTS));
            $data = $request->only(PlanType::REQUEST_INPUTS);
            
             if($data['meal_category'] ?? null) {
                foreach ($data['meal_category'] as $key => $meal_category) {
                    PlanType::create([
                        'planning_id' => $planning->id ?? null,
                        'meal_category' => $meal_category ?? null,
                        'food_details' => $data['food_details'][$key] ?? null,
                        'meal_time' => $data['meal_time'][$key] ?? null,
                    ]);
                }
            }
              $data = [
        'date' => Carbon::now()->format('d-M-Y'),
        'image' =>  url('assets\images\logo.png')
    ];
            $file_name = Str::random(10) .'.pdf';
   $file_path = storage_path('app\public\pdf\planning_' . $file_name);
    $planning->load(['plan_types', 'client']);
    $start_date = new DateTime($planning->plan_start_date);
    $end_date = new DateTime($planning->plan_end_date);
    $remaining_days = $start_date->diff($end_date)->format('%a');
    $data['remaining_days'] = $remaining_days;
    $data['planning'] = $planning;
  
            return redirect()->route('planning.index')->with('success', 'Planning Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the observation create');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Planning $planning)
    {
        try{
            $onboarding = Onboarding::where('client_id', $planning->client_id)->first();
            $data = $this->getData($onboarding->id);
            $planning->load('plan_types');
            return view('pages.planning.show',compact('data','planning'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the planning show');
        } 
    }

    public function planningPdf($client,$planning)
    {
        try{
            $client = Client::findOrFail($client);
            $planning = Planning::where('client_id', $client->id)->where('id', $planning)->with(['plan_types', 'client'])->first();
        $data = [
        'date' => Carbon::now()->format('d-M-Y'),
        'image' =>  url('assets\images\logo.png')
    ];  
    $start_date = new DateTime($planning->plan_start_date);
    $end_date = new DateTime($planning->plan_end_date);
    $remaining_days = $start_date->diff($end_date)->format('%a');
    $data['remaining_days'] = $remaining_days;
    $data['planning'] = $planning;       

    $pdf = Pdf::loadView('pdf.planning', $data);
    return $pdf->stream();
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the planning show');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Planning $planning)
    {
        try{
            $onboarding = Onboarding::where('client_id', $planning->client_id)->first();
            $data = $this->getData($onboarding->id);
            $planning->load('plan_types');
            return view('pages.planning.edit',compact('data','planning'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the planning edit');
        } 
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planning $planning)
    {
        try{
            $planning->update($request->only(Planning::REQUEST_INPUTS));
            $data = $request->only(PlanType::REQUEST_INPUTS);
             $ids = $request->input('ids') ?? null;
             if($data['meal_category'] ?? null) {
                foreach ($data['meal_category'] as $key => $meal_category) {
                      PlanType::updateOrCreate(
                        ['id' => $ids[$key] ?? null],[
                        'planning_id' => $planning->id ?? null,
                        'meal_category' => $meal_category ?? null,
                        'food_details' => $data['food_details'][$key] ?? null,
                    ]);
                }
            }

            $deletePlanTypes = $request->input('delete') ?? null;
            if($deletePlanTypes) {
                foreach($deletePlanTypes as $id){
                    $plan_type = PlanType::findOrFail($id);
                    $plan_type->delete();

                }
            }
            return redirect()->route('planning.index')->with('success', 'Planning Updated Successfully');
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
    public function destroy($planning)
    {
        try{
            $planning = Planning::findOrFail($planning);
            $planning->plan_types()->delete();
            $planning->delete();
            return response()->json('Planning Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('planning.index')->with('error', 'Error occured in the observation destroy');
        }
    }

    public function getPlanning()
    {
        try {
            $clients = Client::where('journey','onboarding')->with('planning')->get();
            

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('planning', function ($client) {
                return '<a href="' . route('planning.add', $client) . '" class="btn btn-primary  btn-sm"><i class="fa fa-ruler"></i> </a>';
            })->editColumn('view', function ($client) {
                    return '<a href="' . route('planning.list', $client) . '" class="btn btn-info  btn-sm"><i class="fa fa-eye"></i> </a>';
            })
            ->rawColumns(['planning','view'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occurred in the client store');
        }
    }

    public function getPlanningMeal()
    {
        try {
            $options = MEALCATEGORY;
            return response()->json(['data' => $options]);
        } catch (\Exception  $exception) {
            info($exception);
            return redirect()->back()->with('error', 'Error occurred. Please contact administrator');
        }
    }

    public function getClientPlanning($client)
    {
        try {
            $client = Client::findOrFail($client);
            $plannings = Planning::where('client_id', $client->id)->get();


            return Datatables::of($plannings)
                ->editColumn('plan_start_date', function ($planning) {
                    return dateFormat($planning->plan_start_date);
                })->editColumn('plan_end_date', function ($planning) {
                return dateFormat($planning->plan_end_date);
            })->editColumn('planning', function ($planning) {
                return '<a target="_blank"  href="' . route('planning.planningPdf', ['client' => $planning->client_id ,'planning' => $planning]) . '" class="btn btn-primary">Download</i> </a>';
            })
            ->editColumn('show', function ($planning) {
                return '<a href="' . route('planning.show', $planning) . '" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($planning) {
                return '<a href="' . route('planning.edit', $planning) . '" class="btn btn-success  btn-sm"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($planning) {
                return '<div class="form-group" ><button class="btn btn-danger  btn-sm" onclick=deletePlanning('. $planning->id .')  ><i class="fa fa-trash"></i></a></div>';
                  // return '<form method="POST"  onsubmit="return confirm("Are you sure want to delete the client?")" action="' . route('client.destroy',$client) .'">' . csrf_field() . method_field('DELETE') . '<div class="form-group"><button class="btn btn-danger" type="submit"><i class="fa fa-trash "></i></a></div></form> ';
                
            })->rawColumns(['show', 'edit','delete','planning'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}