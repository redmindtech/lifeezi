@extends('layouts.app',[
    'activeName' => 'FollowUp'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>FOLLOWUP</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('followup.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                         @include('include.client')
                    @include('include.onboarding')
                    @include('include.observations')
                    @if($followUp)
                    <div style="margin: 5px 0px">
                        <div class="card">
                            <div class="card-body" style="height: auto;" >
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" class="form-group" method="POST" onsubmit=handleSubmit() action="{{ route('followup.store')}}" >
                            @csrf
                                                        <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="Name" class="form-label">Date</label>
                                   <p>{{dateFormat($followUp->follow_date)}}</p>
                                </div>
                                         <div class="col-md-3">
                                    <label for="mobile" class="form-label">Day</label>
                                <p>{{$followUp->follow_day}}</p>
                                </div>
                            <!--</div>-->
                            <!--<div class="row">-->
                                 <div class="col-md-3">
                                    <label for="yes" class="form-label">Are you FollowUp ?</label>
                                    <p>{{ $followUp->follow_up}}</p>
                                                
                                </div>
                                <div class="col-md-3">
                                    <label for="mobile" class="form-label">Comments/Deviations</label>
                                    <p>{{$followUp->comments}}</p>
                                    </div>
                            <!--</div>-->
                        </form>
                    </div>
                   </div>
                   @endif
                </div>
            </div>
        </div>
@endsection