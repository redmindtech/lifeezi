@extends('layouts.app',[
    'activeName' => 'Observation'
])

@section('content')
<div class="py-3" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-3">
                         <h2>OBSERVATION</h2>
                        </div>
                        <div class="col-md-9 float-right">
                            <a href="{{ route('observation.list', $observation->client_id)}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        @if($observation)
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('observation.store')}}" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Date</label>
                                    <p>{{old('date') ?? dateFormat($observation->date)}}</p>
                                </div>
                                  <div class="col-md-6">
                                    <label  class="form-label">Day of Observation</label>
                                      <p>{{old('day_of_observation') ?? $observation->day_of_observation}}</p>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Wake up Time</label>
                                    <p>{{ Carbon\Carbon::parse($observation->wake_up_time)->format('g:i A') }}</p>
                                    <!-- <p>{{old('wake_up_time') ?? $observation->wake_up_time}}</p> -->
                                </div>
                                  <div class="col-md-6">
                                    <label  class="form-label">Bed Time</label>
                                    <p>{{ Carbon\Carbon::parse($observation->bed_time)->format('g:i A') }}</p>
                                      <!-- <p>{{old('bed_time') ?? $observation->bed_time}}</p> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Activity</label>
                                    <p>{{old('exercise_routine') ?? $observation->exercise_routine}}</p>
                                </div>
                                  <div class="col-md-6">
                                    <label  class="form-label">Remarks</label>
                                      <p>{{old('steps') ?? $observation->steps}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Water Intake Litres</label>
                                    <p>{{old('water_intake') ?? $observation->water_intake}}</p>
                                </div>
                            </div>

                            <br/>
                            <div id="measurement_div">
                                @if($observation->observation_type)
                                @foreach ($observation->observation_type as $key => $observation_type )
                                <div class="card">
                                 <div class="card-body" style="height: 15vh;" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Meal Type</label>
                                            <p>{{ ucfirst($observation_type->meal_type) }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Meal Time</label>
                                            <p>{{ getTime($observation_type->meal_time) }}</p>
                                        </div>
                                          <div class="col-md-3">
                                            <label class="form-label">Meal</label>
                                            <p>{{ $observation_type->meal }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Comments</label>
                                            <p tooltip="{{$observation_type->comments }}">{{ $observation_type->comments }}</p>
                                        </div>
                                    </div>
                                 </div>
                                </div>

                                @endforeach
                                @endif
                            </div>
                            <br/>
                            <hr/>

                        </form>
                        @endif
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection