<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientPaymentRequest;
use App\Models\Client;
use App\Models\ClientPayment;
use App\Models\Onboarding;
use Illuminate\Http\Request;
use Exception;
use Yajra\DataTables\DataTables;

class ClientPaymentController extends Controller
{
      public function getData($client = null) {
        $client = Client::findOrFail($client);
        $client->load(['summary', 'schedule_assement']);
        $onboarding = Onboarding::where('client_id', $client->id)->first();
        return [
            'client' => $client,
            'onboarding' => $onboarding 
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
            return view('pages.payment.index');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('payment.index')->with('error', 'Error occured in the payment index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $clientPayment)
    {
        try{
            $clientPayment = ClientPayment::findOrFail($clientPayment);
            $clientPayment->load('client');
            $data = $this->getData($clientPayment->client_id);
            return view('pages.payment.edit', compact('clientPayment','data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('payment.index')->with('error', 'Error occured in the payment edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientPaymentRequest $request,  $clientPayment)
    {
           try{
            $clientPayment = ClientPayment::findOrFail($clientPayment);
            $clientPayment->update($request->only(ClientPayment::REQUEST_INPUTS));
            return redirect()->route('payment.index')->with('success', 'Payment Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('payment.index')->with('error', 'Error occured in the payment update');
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
        //
    }

      public function getPaymentData()
    {
        try {
            $clients = ClientPayment::where('payment_status', 'pending')->with('client')->get();

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->client->sex);
            })->editColumn('phone', function ($client) {
                return $client->client->mobile;
            })->editColumn('payment_date', function ($client) {
                return $client->payment_date;
            })->editColumn('edit', function ($client) {
                return '<a href="' . route('payment.edit', $client) . '" class="btn btn-primary"><i class="fa fa-user-pen "></i> </a>';
            })
            ->rawColumns(['edit'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}
