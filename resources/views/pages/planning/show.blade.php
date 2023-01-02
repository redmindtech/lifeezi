@extends('layouts.app',[
    'activeName' => 'Planning'
])

@section('content')
  @if($planning)
<div class="py-3" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-3">
                         <h2>PLANNING</h2>
                        </div>
                        <div class="col-md-9 float-right">
                            <a href="{{ route('planning.list', $planning->client_id)}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                    @include('include.observations')
                    @include('include.uploadlab')
                    @include('include.planning')
                    
                     <div class="card">
                        <div class="card-body" style="height: auto;" >
                   <div class="row">
                    <div class="col-md-12">
                       <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('observation.store')}}" >
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="Name" class="form-label">Plan Start Date</label>
                                    <p>{{old('plan_start_date') ?? dateFormat($planning->plan_start_date)}}</p>
                                </div>
                                  <div class="col-md-3">
                                    <label  class="form-label">Plan End Date</label>
                                      <p>{{old('plan_end_date') ?? dateFormat($planning->plan_end_date)}}</p>
                                </div>
                                    <div class="col-md-3">
                                    <label  class="form-label">Mail Send Date</label>
                                      <p>{{old('mail_send_date') ?? dateFormat($planning->mail_send_date)}}</p>
                                </div>
                                 <div class="col-md-3">
                                    <label>Explanation Date</label>
                                    <p>{{old('explanation_date') ?? dateFormat($planning->explanation_date)}}</p>
                                </div>
                            </div>
                            <div class="row">
                               
                                     <div class="col-md-3">
                                    <label>Objective</label>
                                    <p>{{old('objective') ?? $planning->objective}}</p>
                                </div>
                
                               
                                 <div class="col-md-3">
                                    <label for="Name" class="form-label">Activity</label>
                                    <p>{{old('exercise_routine') ?? $planning->exercise_routine}}</p>
                                </div> 
                                <div class="col-md-3">
                                    <label for="Name" class="form-label">Comments/Note</label>
                                    <p>{{old('exercise_routine') ?? $planning->comments}}</p>
                                </div> 
                            </div>

                            <hr>
                            <div id="measurement_div">
                                @if($planning->plan_types)
                                @foreach ($planning->plan_types as $key => $plan_type )
                               <div style="margin: 5px 0px">
                                    <div class="card">
                                    <div class="card-body" style="height: auto;" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Meal Cateory</label>
                                            <p>{{ ucfirst($plan_type->meal_category) }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Food Details</label>
                                            <p>{{ $plan_type->food_details }}</p>
                                        </div>
                                         <div class="col-md-3">
                                            <label class="form-label">Meal Time</label>
                                            <p>{{ $plan_type->meal_time }}</p>
                                        </div>

                                    </div>
                                 </div>
                                </div>

                                @endforeach
                                @endif
                            </div>
                            <br>
                            <hr>
                        </form>
                    </div>
                   </div>
                </div>
            </div>
        </div>
    @endif
@endsection