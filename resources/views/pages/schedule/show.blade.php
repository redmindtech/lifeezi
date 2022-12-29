@extends('layouts.app',[
    'activeName' => 'Schedule Assessment'
])

@section('content')
<div class="py-3" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Schedule Assessment</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('schedule.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        @if($scheduleAssement)
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('schedule.update',$scheduleAssement)}}" >

                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Schedule Date and Time</label>
                                   <p>{{ dateFormat($scheduleAssement->schedule_date_time,true)}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Comments</label>
                                    <p>{{ $scheduleAssement->comments}}</p>
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