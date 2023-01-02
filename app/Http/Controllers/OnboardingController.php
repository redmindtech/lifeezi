<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnboardingRequest;
use App\Models\Client;
use App\Models\ClientPayment;
use App\Models\Employee;
use App\Models\Onboarding;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class OnboardingController extends Controller
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
            $clients = Client::where('journey', 'enquiry')->paginate(5);
            return view('pages.onboarding.index',compact('clients'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('onboarding.index')->with('error', 'Error occured in the observation index');
        } 
    }


   public function list()
    {
        try{
            $onboardings = Onboarding::with('client')->paginate(5);
            return view('pages.onboarding.list',compact('onboardings'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('onboarding.index')->with('error', 'Error occured in the onboarding list');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client = null)
    {
        try{
            $client->load(['schedule_assement', 'summary']);
            $data = $this->getData($client);
            return view('pages.onboarding.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('onboarding.index')->with('error', 'Error occured in the observation create');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OnboardingRequest $request)
    {
        try{
            $file = $request->file('upload_form') ?? null;
            $data = $request->only(Onboarding::REQUEST_INPUTS);
            if ($file) {
                $extension = $request->file('upload_form')->getClientOriginalExtension();
                $filename = Str::random(5) . '.' . $extension;
                $path = public_path() . '/assets/uploads/';
                public_path('/assets/uploads' . $file . '.pdf');
                $file->move($path, $filename);
                $data['upload_form'] = $filename;
            }
            Onboarding::create($data);
            $client = Client::findOrFail($data['client_id']);
            $client->journey = 'onboarding';
            $client->save();
            ClientPayment::create([
                'client_id' => $client->id,
                'payment_date' => $data['onboarding_date'],
                'next_payment_date' => Carbon::parse($data['onboarding_date'])->addDays(30)->format('Y-m-d'),
                'payment_status' => 'completed'
            ]);
            return redirect()->route('onboarding.index')->with('success', 'Onboarding Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('onboarding.index')->with('error', 'Error occured in the store onboarding picture');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Onboarding $onboarding)
    {
        try{
            $client = Client::findOrFail($onboarding->client_id);
             $client->load(['schedule_assement', 'summary']);
            $data = $this->getData($client);
            return view('pages.onboarding.show',compact('data', 'onboarding'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the observation create');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Onboarding $onboarding)
    {
         try{
            $client = Client::findOrFail($onboarding->client_id);
            $client->load(['schedule_assement', 'summary']);
            $data = $this->getData($client);
            return view('pages.onboarding.edit',compact('data', 'onboarding'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the observation edit');
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Onboarding $onboarding)
    {
            try{
            $file = $request->file('upload_form') ?? null;
            $data = $request->only(Onboarding::REQUEST_INPUTS);
            if ($file) {
                $extension = $request->file('upload_form')->getClientOriginalExtension();
                $filename = Str::random(5) . '.' . $extension;
                $path = public_path() . '/assets/uploads/';
                public_path('/assets/uploads' . $file . '.pdf');
                $file->move($path, $filename);
                $data['upload_form'] = $filename;
            }
            $onboarding->update($data);
            return redirect()->route('onboarding.index')->with('success', 'Onboarding Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('onboarding.index')->with('error', 'Error occured in the  onboarding update');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $onboarding)
    {
        try{
            $onboarding = Onboarding::findOrFail($onboarding);
            $onboarding->delete();
            return response()->json('Onboarding Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the observation edit');
        } 
    }

    public function getOnboarding()
    {
        try {
            $clients = Client::whereIn('journey', ['joining','onboarding'])->with('onboarding')->get();
            

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('onboarding', function ($client) {
                if (!$client->onboarding ?? null)
                return '<a href="' . route('onboarding.add', $client) . '" class="btn btn-primary  btn-sm"><i class="fa fa-plane"></i> </a>';
                else
                    return dateFormat($client->onboarding->onboarding_date);
            })->editColumn('show', function ($client) {
                if ($client->onboarding ?? null)
                    return '<a href="' . route('onboarding.show', $client->onboarding) . '" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i> </a>';
                else
                    return '-';
            })->editColumn('edit', function ($client) {
                if ($client->onboarding ?? null)
                    return '<a href="' . route('onboarding.edit', $client->onboarding) . '" class="btn btn-success  btn-sm"> <i class="fa fa-user-pen "></i></a>';
                else
                    return '-';
            })->editColumn('delete', function ($client) {
                if ($client->onboarding ?? null)
                    return  '<div class="form-group"><button class="btn btn-danger  btn-sm" onclick=deleteOnboarding('. $client->onboarding->id  .')><i class="fa fa-trash "></i></a></div></form> ';
                else
                    return '-';

            })->rawColumns(['onboarding','show', 'edit', 'delete'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}