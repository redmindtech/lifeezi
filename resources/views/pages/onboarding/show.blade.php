@extends('layouts.app',[
    'activeName' => 'Onboarding'
])

@section('content')
<div class="py-3" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>ONBOARDING</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('onboarding.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        @if($onboarding)
                        <form enctype="multipart/form-data" class="form-group" method="POST" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" >Onboarding Date</label>
                                   <p>{{ Carbon\Carbon::parse($onboarding->onboarding_date)->format('d-M-Y') }}</p>
                                </div>
                                 <div class="col-md-6">
                                    <label for="target_days" >Target Days</label>
                                   <p>{{ $onboarding->target_days }}</p>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_of_birth" >Date of Birth</label>
                                  <p>{{ Carbon\Carbon::parse($onboarding->date_of_birth)->format('d-M-Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="occupation" >Job Nature</label>
                                 <p>{{ $onboarding->occupation }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="address" >Location</label>
                                  <p>{{ $onboarding->address }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="height" >Height</label>
                                <p>{{ $onboarding->height }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="weight" >Weight</a></label>
                            <p>{{ $onboarding->weight }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="height" >Client Fee</label>
                                  <p>{{ $onboarding->client_fee }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label  >Upload PARQ form</label>
                                    <p><a href="{{  url('assets/uploads/'. $onboarding->upload_form ) }}" download >Download</a></p>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-6">
                                    <label for="coach" >Wellness coach</label>
                                    <p>{{ $onboarding->coach }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="height" >Past/Present Health History</label>
                                  <p>{{ $onboarding->past_history }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label  >Doctor's Comment</label>
                                    <p>{{ $onboarding->comments}}</p>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-6">
                                    <label for="coach" >Current Medications</label>
                                    <p>{{ $onboarding->current_medication }}</p>
                                </div>
                                  <div class="col-md-6">
                                    <label for="coach" >Objective of client</label>
                                    <p>{{ $onboarding->objective_client }}</p>
                                </div>
                                
                            </div>

                        </form>
                        @endif
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection