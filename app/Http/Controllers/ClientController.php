<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\TransformationPlan;
use Exception;
 use Yajra\DataTables\DataTables;

class ClientController extends Controller
{


    public function getData() {
            $transformation_plans = TransformationPlan::all();
            $reference = REFERENCE;
            $journey = JOURNEYSTATUS;
        return [
            'transformation_plans' => $transformation_plans,
            'reference' => $reference,
            'journey' => $journey
        ];
    }

    public function getValidationData($data = [],$request) {
            if($data['transformation_plan'] == 'others'){
                $data['transformation_input'] = $request->input('transformation_input');
            } else {
            $data['transformation_input'] = null;
            }
            
            if(in_array($data['journey'],INACTIVE)){
                    $data['status'] = 'inactive';
            } else {
                    $data['status'] = 'active';
            }
            
            if($data['reference'] == 'reference'|| $data['reference'] =='others'){
                $data['reference_input'] = $request->input('reference_input');
            } else {
            $data['reference_input'] = null;
            }
        return $data;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            return view('pages.client.index');
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
        try{
            $data = $this->getData();
            return view('pages.client.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client create');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
    
        try{
            $data = $request->only(Client::REQUEST_INPUTS);
            $data['journey'] = 'enquiry';
            $validationData = $this->getValidationData($data, $request);
            $validationData['transformation_plan'] = implode(',', $data['transformation_plan']);
            Client::create($validationData);
            return redirect()->route('client.index')->with('success', 'Enquiry Details Created Successfully');
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
    public function show(Client $client)
    {
        try{
            return view('pages.client.show',compact('client'));
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
    public function edit(Client $client)
    {
       try{
            $data = $this->getData();
            return view('pages.client.edit',compact('client','data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client edit');
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        
        try{
            $data = $request->only(Client::REQUEST_INPUTS);
            $data['journey'] = 'enquiry';
            $validationData = $this->getValidationData($data, $request);
            $validationData['transformation_plan'] = implode(',', $data['transformation_plan']);
            $client->update($validationData);
            return redirect()->route('client.index')->with('success', 'Enquiry Details Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client update');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client)
    {
        try{
            $client = Client::findOrFail($client);
            $client->delete();
            return response()->json('Enquiry Details Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client destroy');
        } 
    }

     public function getClient()
      {
          try{
            $clients = Client::all();
            
            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('show', function ($client) {
                return '<a href="' . route('client.show', $client) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($client) {
                return '<a href="' . route('client.edit', $client) . '" class="btn btn-success btn-sm"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($client) {
                return '<div class="form-group" ><button class="btn btn-danger btn-sm" onclick=deleteClient('. $client->id .') data-id="'. $client->id . '" ><i class="fa fa-trash"></i></a></div>';
                  // return '<form method="POST"  onsubmit="return confirm("Are you sure want to delete the client?")" action="' . route('client.destroy',$client) .'">' . csrf_field() . method_field('DELETE') . '<div class="form-group"><button class="btn btn-danger" type="submit"><i class="fa fa-trash "></i></a></div></form> ';
                
            })->rawColumns(['show', 'edit','delete'])
                ->make(true);
        } catch(Exception $e) {
           info($e);
           return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        } 
    }

}