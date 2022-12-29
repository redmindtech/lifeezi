@extends('layouts.app',[
    'activeName' => 'Observation'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-3">
                         <h2>Observation</h2>
                        </div>
                        <div class="col-md-9 float-right">
                            <a href="{{ route('observation.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        @if($observation)
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('observation.update', $observation)}}" >
                            @csrf
                            @method('PATCH')
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <input type="hidden" style="display: none" name="onboarding_id" value="{{ $data['onboarding']['id']}}" />
                            <div id = "delete_ids"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="date" value="{{old('date') ?? $observation->date}}"/>
                                    @if($errors->has('date'))
                                            <div class="error">{{ $errors->first('date') }}</div>
                                  @endif
                                </div>
                                  <div class="col-md-6">
                                    <label  class="form-label">Day of Observation<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text" class="form-control" name="day_of_observation" value="{{old('day_of_observation') ?? $observation->day_of_observation}}"/>
                                    @if($errors->has('day_of_observation'))
                                            <div class="error">{{ $errors->first('day_of_observation') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Wake Up Time</label>
                                    <input type="time" class="form-control" name="wake_up_time" value="{{old('wake_up_time') ?? $observation->wake_up_time}}"/>
                                    @if($errors->has('wake_up_time'))
                                            <div class="error">{{ $errors->first('wake_up_time') }}</div>
                                  @endif
                                </div>
                                  <div class="col-md-6">
                                    <label  class="form-label">Bed Time</label>
                                    <input type="time" class="form-control" name="bed_time" value="{{old('bed_time') ?? $observation->bed_time}}"/>
                                    @if($errors->has('bed_time'))
                                            <div class="error">{{ $errors->first('bed_time') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Activity</label>
                                    <input type="text" class="form-control" name="exercise_routine" value="{{old('exercise_routine') ?? $observation->exercise_routine}}"/>
                                    @if($errors->has('exercise_routine'))
                                            <div class="error">{{ $errors->first('exercise_routine') }}</div>
                                  @endif
                                </div>
                                  <div class="col-md-6">
                                    <label  class="form-label">Walking Time/Steps</label>
                                    <input type="number" class="form-control" name="steps" value="{{old('steps') ?? $observation->steps}}"/>
                                    @if($errors->has('steps'))
                                            <div class="error">{{ $errors->first('steps') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Water Intake (Litres)</label>
                                    <input type="number" class="form-control" name="water_intake" value="{{old('water_intake') ?? $observation->water_intake}}"/>
                                    @if($errors->has('water_intake'))
                                            <div class="error">{{ $errors->first('water_intake') }}</div>
                                  @endif
                            </div>
                            <br/>
                            <br/>
                            <div class="row" >
                                <div class="col-md-12" >
                                    <a class="btn btn-info" style="margin: 5px 0" id="observation" >+ Add Meal Details<a>
                                </div>
                            </div>
                            <br/>
                            <?php $meal_types = old('meal_type') ?? null ?>
                            <div id="observation_div">
                                     @if($observation->observation_type && !$meal_types)
                                @foreach ($observation->observation_type as $key => $observation_type )
                                <input type="hidden" style="display: none" value="{{$observation_type->id}}" name="ids[]" />
                                    
                            <div id="observation_inputs_{{$key}}" class="card observation" style="margin:5px 0;">
                                <div class="card-body" style="height:auto"> 
                                    <?php $id = $observation->id ?>
                                   <div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard({{$key}},{{$id}})>
                                       <span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6">
                                         <label class="form-label">Meal Type<a style="text-decoration: none;color:red">*</a></label>
                                         <select required name="meal_type[]" id="select_meal_type_{{$key}}" class="form-control" >
                                           <option value="">--- Select any one ---</option>
                                              @if(MEALTYPE) 
                                              @foreach (MEALTYPE as $key => $value )
                                                  <option @if($observation_type->meal_type == $key) selected @endif value="{{ $key }}">{{ $value }}</option>
                                               @endforeach
                                               @endif   
                                           </select>
                                         </div>
                                          <div class="col-md-6">
                                           <label class="form-label">Meal Time<a style="text-decoration: none;color:red">*</a></label>
                                          <input class="form-control" required type="time" id="meal_time_{{$key}}" name="meal_time[]" value="{{ $observation_type->meal_time }}"> 
                                        </div>
                                       </div>
                                       <div class="row">
                                               <div class="col-md-6">
                                           <label class="form-label">Meal<a style="text-decoration: none;color:red">*</a></label>
                                          <input class="form-control" required type="text" id="meal{{$key}}" name="meal[]" value="{{ $observation_type->meal }}"> 
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <label class="form-label">Comments</label>
                                             <input type="text" class="form-control"  id="comments_{{$key}}" name="comments[]" value="{{ $observation_type->comments }}" />
                                        </div>
                                    </div>
                                   </div>
                            </div>
                            <br/>
                            @endforeach
                            @elseif($meal_types)
                               @foreach ($meal_types as $k => $meal_type )

                                    
                            <div id="observation_inputs_{{$k}}" class="card observation" style="margin:5px 0;">
                                <div class="card-body" style="height:auto"> 
                                    <?php $meal_type = old('meal_type')[$k]  ?? null?>
                                       <?php $meal_time = old('meal_time')[$k] ?? null ?>
                                          <?php $comments = old('comments')[$k] ?? null ?>
                                           <?php $meal = old('meal')[$k] ?? null ?>
                                           <?php $id = old('ids')[$k] ?? null ?>
                                            <input type="hidden" style="display: none" value="{{$id}}" name="ids[]" />
                                   <div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard({{$k}},{{$id}})>
                                       <span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6">
                                         <label class="form-label">Meal Type<a style="text-decoration: none;color:red">*</a></label>
                                         <select required name="meal_type[]" id="select_meal_type_{{$k}}" class="form-control" >
                                           <option value="">--- Select any one ---</option>
                                              @if(MEALTYPE) 
                                              @foreach (MEALTYPE as $key => $value )
                                                  <option @if($meal_type == $key) selected @endif value="{{ $key }}">{{ $value }}</option>
                                               @endforeach
                                               @endif   
                                           </select>
                                         </div>
                                          <div class="col-md-6">
                                           <label class="form-label">Meal Time<a style="text-decoration: none;color:red">*</a></label>
                                          <input class="form-control" required type="time" id="meal_time_{{$k}}" name="meal_time[]" value="{{ $meal_time }}"> 
                                        </div>
                                       </div>
                                       <div class="row">
                                               <div class="col-md-6">
                                           <label class="form-label">Meal<a style="text-decoration: none;color:red">*</a></label>
                                          <input class="form-control" required type="text" id="meal{{$k}}" name="meal[]" value="{{ $meal }}"> 
                                        </div>
                                     
                                        <div class="col-md-6">
                                            <label class="form-label">Comments</label>
                                             <input type="text" class="form-control" type="text" id="comments_{{$k}}" name="comments[]" value="{{ $comments }}"/>
                                        </div>
                                         </div>
                                   </div>
                            </div>
                            <br/>
                            @endforeach
                            @endif
                            </div>
                            <br/>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                   </div>
                </div>
            </div>
                 @include('pages.observation.observation_script')
        </div>
@endsection