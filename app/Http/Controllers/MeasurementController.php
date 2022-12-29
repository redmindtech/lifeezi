<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeasurementRequest;
use App\Models\Measurement;
use App\Models\Onboarding;
use App\Models\Client;
use App\Models\MeasurementType;
use Exception;
use Yajra\DataTables\DataTables;

class MeasurementController extends Controller
{

    public function getData($onboarding = null) {
        $client = Client::findOrFail($onboarding->client_id);
        $measurements = Measurement::with('measurement_type')->where('client_id', $onboarding->client_id)->get();
        return [
            'client' => $client,
            'onboarding' => $onboarding,
            'measurements' => $measurements
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
            return view('pages.measurement.index');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the measurement index');
        }     
    }

    public function list(Client $client)
    {
        try{
            $onboarding = Onboarding::where('client_id', $client->id)->first();
            $data = $this->getData($onboarding);
            return view('pages.measurement.list',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the measurement list');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $onboarding)
    {
        try{
            $onboarding = Onboarding::findOrFail($onboarding);
            $data = $this->getData($onboarding);
            return view('pages.measurement.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the onboarding create');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeasurementRequest $request)
    {
        try{
            $data = $request->only(MEASUREMENT::REQUEST_INPUTS);
           $measurement = Measurement::create([
              'client_id' => $data['client_id'],
              'onboarding_id' => $data['onboarding_id'],
              'measurement_date' => $data['measurement_date'],
              'next_measurement_date' => $data['next_measurement_date'],
              'comments' => $data['comments']
            ]);
            
             if($data['measurement_types'] ?? null) {
                foreach ($data['measurement_types'] as $key => $measurement_type) {
                    MeasurementType::create([
                        'measurement_id' => $measurement->id ?? null,
                        'measurement_type' => $measurement_type ?? null,
                        'value' => $data['values'][$key] ?? null,
                        'comments' => $data['measurement_comments'][$key] ?? null,
                    ]);
                }
            }
            return redirect()->route('measurement.index')->with('success', 'Measurement Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the onboarding create');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Measurement $measurement)
    {
        try{
            $onboarding = Onboarding::findOrFail($measurement->onboarding_id);
            $data = $this->getData($onboarding);
            $options = MEASUREMENT;
            $measurement->load('measurement_type');
            return view('pages.measurement.show',compact('data','measurement','options'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the onboarding show');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Measurement $measurement)
    {
       try{
            $onboarding = Onboarding::findOrFail($measurement->onboarding_id);
            $data = $this->getData($onboarding);
            $measurement->load('measurement_type');
            return view('pages.measurement.edit',compact('data','measurement'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the onboarding show');
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Measurement $measurement)
    {
        try {
            $measurement->update(
                [
                    'measurement_date' => $request->input('measurement_date'),
                    'next_measurement_date' => $request->input('next_measurement_date'),
                    'comments' => $request->input('comments'),
                ]
            );
            $ids = $request->input('ids');
            $data = $request->only(Measurement::REQUEST_INPUTS);
            if ($request->input('measurement_types') ?? null) {
                foreach ($request->input('measurement_types') as $key => $measurement_type) {
                    MeasurementType::updateOrCreate(
                        ['id' => $ids[$key] ?? null],
                        [
                            'measurement_id' => $measurement->id ?? null,
                            'measurement_type' => $measurement_type ?? null,
                            'value' => $data['values'][$key] ?? null,
                            'comments' => $data['measurement_comments'][$key] ?? null,
                        ]
                    );
                }
            }

            $deleteMeasurements = $request->input('delete') ?? null;
            if($deleteMeasurements) {
                foreach($deleteMeasurements as $id){
                    $measurement = MeasurementType::findOrFail($id);
                    $measurement->delete();

                }
            }
            return redirect()->route('measurement.index')->with('success','Measurement Updated Successfully');
        } catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the observation destroy');
        } 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($measurement)
    {
       try{
            $measurement = Measurement::findOrFail($measurement);
            $measurement->measurement_type()->delete();
            $measurement->delete();
            return response()->json('Measurement Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('measurement.index')->with('error', 'Error occured in the measurement destroy');
        }
    }

    public function getMeasurement()
    {
        try {
            $options = MEASUREMENT;
            return response()->json(['data' => $options]);
        } catch (\Exception  $exception) {
            info($exception);
            return redirect()->back()->with('error', 'Error occurred. Please contact administrator');
        }
    }

    public function getMeasurementData()
    {
        try {
            $clients = Client::where('journey','onboarding')->with(['measurement','onboarding'])->get();
            

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('measurement', function ($client) {
                return '<a href="' . route('measurement.add', $client->onboarding->id) . '" class="btn btn-primary"><i class="fa fa-weight-scale"></i> </a>';
            })->editColumn('view', function ($client) {
                    return '<a href="' . route('measurement.list', $client) . '" class="btn btn-info"><i class="fa fa-eye"></i> </a>';
            })
            ->rawColumns(['measurement','view'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }

    public function getClientMeasurement($client)
    {
        try {
            $client = Client::findOrFail($client);
            $measurements = Measurement::where('client_id', $client->id)->get();

            return Datatables::of($measurements)
                ->editColumn('measurement_date', function ($measurement) {
                    return dateFormat($measurement->measurement_date);
                })->editColumn('next_measurement_date', function ($measurement) {
                return dateFormat($measurement->next_measurement_date);
            })->editColumn('comments', function ($measurement) {
                return $measurement->comments;
            })->editColumn('show', function ($measurement) {
                return '<a href="' . route('measurement.show', $measurement) . '" class="btn btn-primary"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($measurement) {
                return '<a href="' . route('measurement.edit', $measurement) . '" class="btn btn-success"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($measurement) {
                return '<div class="form-group" ><button class="btn btn-danger" onclick=deleteMeasurement('. $measurement->id .')  ><i class="fa fa-trash"></i></a></div>';
                  // return '<form method="POST"  onsubmit="return confirm("Are you sure want to delete the client?")" action="' . route('client.destroy',$client) .'">' . csrf_field() . method_field('DELETE') . '<div class="form-group"><button class="btn btn-danger" type="submit"><i class="fa fa-trash "></i></a></div></form> ';
                
            })->rawColumns(['show', 'edit','delete'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}


