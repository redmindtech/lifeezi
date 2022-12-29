@extends('layouts.app',[
    'activeName' => 'Planning'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>PLANNING</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('planning.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                    @include('include.observations')
                    @include('include.uploadlab')
                    @include('include.planning')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('planning.store')}}" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Plan Start Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="plan_start_date" value="{{old('plan_start_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('plan_start_date'))
                                            <div class="error">{{ $errors->first('plan_start_date') }}</div>
                                  @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Plan End Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="plan_end_date" value="{{old('plan_end_date') ?? \Carbon\Carbon::today()->addDays(1)->format('Y-m-d')}}"/>
                                    @if($errors->has('plan_end_date'))
                                            <div class="error">{{ $errors->first('plan_end_date') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                     <div class="col-md-4">
                                    <label for="Name" class="form-label">Mail Send Date</label>
                                    <input type="date" class="form-control" name="mail_send_date" value="{{old('mail_send_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('mail_send_date'))
                                            <div class="error">{{ $errors->first('mail_send_date') }}</div>
                                  @endif
                                </div> 
                                <div class="col-md-4">
                                    <label for="Name" class="form-label">Explanation Date</label>
                                    <input type="date" class="form-control" name="explanation_date" value="{{old('explanation_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('explanation_date'))
                                            <div class="error">{{ $errors->first('explanation_date') }}</div>
                                  @endif
                                </div> 
                                   <div class="col-md-4">
                                    <label for="Name" class="form-label">Objective</label>
                                    <input type="text" class="form-control" name="objective" value="{{old('objective') ?? '' }}"/>
                                    @if($errors->has('objective'))
                                            <div class="error">{{ $errors->first('objective') }}</div>
                                  @endif
                                </div> 
                            </div>
                            <div class="row">
                                    <div class="col-md-12">
                                    <label for="Name" class="form-label">Activity</label>
                                    <textarea class="form-control" name="exercise_routine">{{ old('exercise_routine') ?? '' }}</textarea>
                                    @if($errors->has('exercise_routine'))
                                            <div class="error">{{ $errors->first('exercise_routine') }}</div>
                                  @endif
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="col-md-12">
                                    <label for="Name" class="form-label">Comments/Note</label>
                                    <textarea class="form-control" name="comments">{{ old('comments') ?? '' }}</textarea>
                                    @if($errors->has('comments'))
                                            <div class="error">{{ $errors->first('comments') }}</div>
                                  @endif
                                    </div>
                            </div>
                            
                            <br/>
                            <div class="row" >
                                <div class="col-md-12" >
                                    <a class="btn btn-info" id="plantype" >+ Add Meal Time<a>
                                </div>
                            </div>
                            <br/>
                             <?php $meal_categories = old('meal_category') ?? null ?>
                            <div id="planning_div">
                                   @if($meal_categories )
                                @foreach ($meal_categories as $key => $plan_type )
                                  <?php $meal_category = old('meal_category')[$key] ?>
                                       <?php $food_details = old('food_details')[$key] ?>
                                       <?php $meal_time = old('meal_time')[$key] ?>
                                    
                            <div id="plantype_inputs{{$key}}" class="card plantype" style="margin:5px 0;">
                                <div class="card-body" style="height:auto"> 
                                   <div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard({{$key}})>
                                       <span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span>
                                    </div>
                                    <div class="row"><div class="col-md-6"><h4></h4></div></div>
                                    <div class="row">
                                       <div class="col-md-4">
                                         <label class="form-label">Meal Category<a style="text-decoration: none;color:red">*</a></label>
                                         <select required name="meal_category[]"  id="select_meal_category_{{$key}}" class="form-control select2" >
                                           <option value="">--- Select any one ---</option>
                                              @if(MEALCATEGORY) 
                                                <?php $val = true ?>
                                              @foreach (MEALCATEGORY as $key => $value )
                                                @if($meal_category == $value)
                                                <?php $val = false ?>
                                                @endif
                                                  <option @if($meal_category == $value)  selected @endif value="{{ $key }}">{{ $value }}</option>
                                               @endforeach
                                               @endif 
                                               @if($val)
                                               <option value="{{$meal_category}}" selected>{{$meal_category}}</option>
                                               @endif  
                                           </select>
                                         </div>
                                          <div class="col-md-4">
                                           <label class="form-label">Food Details<a style="text-decoration: none;color:red">*</a></label>
                                          <input class="form-control" required type="text" id="food_details_{{$key}}" name="food_details[]" value="{{ $food_details }}"> 
                                        </div>
                                         <div class="col-md-4">
                                           <label class="form-label">Meal Time<a style="text-decoration: none;color:red">*</a></label>
                                          <input class="form-control" required type="time" id="meal_time_{{$key}}" name="meal_time[]" value="{{ $meal_time }}"> 
                                        </div>
                                       </div>
                                       <script text="type/javascript">
                                       $('#select_meal_category_'{{$key}}).select2({
                                        tags:true
                                       })
                                       </script>
                                </div>
                            </div>
                            @endforeach
                            @endif
                                 <script text="type/javascript">
                                       $( document ).ready(function() {
                                         $('.select2').select2({
                                            tags:true
                                         })                                          });
                                       </script>
                            </div>
                            <br/>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                         <script type="text/javascript">
           function handleSubmit(){
             $('#button').attr('disabled',true)
           }
           </script>
                    </div>
                   </div>
                </div>
            </div>
                 @include('pages.planning.planning_script')
        </div>
@endsection