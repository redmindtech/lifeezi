@extends('layouts.app',[
    'activeName' => 'Enquiries'
])

@section('content')
<div class="py-3" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Enquiry Details</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('client.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                   <div class="row">
                    <div class="col-md-12">
                        @if($client)
                        <form enctype="multipart/form-data" class="form-group" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" >Name</label>
                                    <p>{{$client->client_name ?? old('client_name')}}</p>
                                </div>
                                 <div class="col-md-6">
                                    <label for="sex" >Sex</label>
                                          <p>{{ ucfirst(implode(' ', explode('_', $client->sex))) ?? old('sex')}}</p>                              
                                  </div>
                                </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="mobile" >Mobile</label>
                                    <p>{{ $client->mobile ?? old('mobile')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="landline" >Alternate/LandLine</label>
                                    <p>{{ $client->landline ?? old('landline')}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Email" >Email</label>
                                    <p>{{$client->email ?? old('email')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="status" >Objectives</label>
                                    <p>{{ucfirst(implode(' ', explode('_', $client->transformation_plan))) ?? old('transformation_plan') }}</p>
                            </div>
                            </div>
                            <div id="secondary">
                                @if($client->transformation_input)
                                <div class="row" id="secondary_input">
                                    <div class="col-md-12">
                                        <label for="transformation_input" >Secondary</label>
                                        <p>{{ $client->transformation_input ?? old('transformation_input')}}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="row" id="reference_div">
                                <div class="col-md-6">
                                    <label for="reference" >Enquiry Source</label>
                                    <p>{{ucfirst(implode(' ', explode('_', $client->reference))) ?? old('reference') }}</p>
                                </div>
                                 @if($client->reference_input)
                                <div class="col-md-6" id="reference_col_div">
                                    <label for="reference_input" >Reference Name</label>
                                    <p>{{ $client->reference_input ?? old('reference_input')}}</p>
                                </div>
                                @endif
                            </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <label for="expiry_date" >Enquiry Date</label>
                                      <p>{{Carbon\Carbon::parse($client->expiry_date)->format('d-M-Y') ?? old('expiry_date') }}</p>
                                </div>
                                <div class="col-md-6">
                                      <label for="journey" >Journey Status</label>
                                      <p>{{ucfirst(implode(' ', explode('_', $client->journey)))}}</p>
                            
                                </div>
                               </div>
                               <div class="row">
                                <div class="col-md-12">
                                    <label for="comments" >Comments</label>
                                    <p>{{ $client->comments}}</p>
                                </div>
                               </div>
                            <hr/>
                        </form>
                        @endif
                    </div>
                   </div>
                </div>
            </div>
        
@endsection