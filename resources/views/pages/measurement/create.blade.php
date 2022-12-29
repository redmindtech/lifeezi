@extends('layouts.app',[
    'activeName' => 'Measurement'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Measurement</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('measurement.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                    @include('include.measurement')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('measurement.store')}}" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <input type="hidden" style="display: none" name="onboarding_id" value="{{ $data['onboarding']['id']}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Measurement Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="measurement_date" value="{{old('measurement_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('measurement_date'))
                                            <div class="error">{{ $errors->first('measurement_date') }}</div>
                                  @endif
                                </div>
                                  <div class="col-md-6">
                                    <label  class="form-label">Next Measurement Date</label>
                                    <input type="date" class="form-control" name="next_measurement_date" value="{{old('next_measurement_date') ?? \Carbon\Carbon::today()->addDays(1)->format('Y-m-d')}}"/>
                                    @if($errors->has('next_measurement_date'))
                                            <div class="error">{{ $errors->first('next_measurement_date') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea class="form-control" name="comments">{{old('comments') ?? ''}}</textarea>
                                @if($errors->has('comments'))
                                            <div class="error">{{ $errors->first('comments') }}</div>
                                  @endif
                                </div>
                            </div>
                            <br/>
                             <?php $measurement_types = old('measurement_types') ?? null ?>
                            <div class="row">
                                <div class="col-md-12" >
                                    <a class="btn btn-info" id="measurement" >+ Add Row<a>
                                </div>
                            </div>
                            <br/>
                            <div id="measurement_div">
                                @if(old('measurement_types') ?? null)
                                @foreach ((old('measurement_types') ?? null) as $k => $measurement_type)
                                   <?php $measurement_type = old('measurement_types')[$k] ?>
                                       <?php $values = old('values')[$k] ?>
                                          <?php $comments = old('measurement_comments')[$k] ?>
                                                         
                            <div id="measurement_inputs_{{$k}}" class="card measurement" style="margin:5px 0;">
                                <div class="card-body" style="height:auto"> 
                                   <div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard({{$k}})>
                                       <span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-4">
                                         <label class="form-label">Measurement<a style="text-decoration: none;color:red">*</a></label>
                                         <select required name="measurement_types[]" id="select_measurement_{{$k}}" class="form-control" >
                                           <option value="">--- Select any one ---</option>
                                              @if(MEASUREMENT) 
                                              @foreach (MEASUREMENT as $key => $value )
                                                  <option @if($measurement_type == $key) selected @endif value="{{ $key }}">{{ $value }}</option>
                                               @endforeach
                                               @endif   
        
                                           </select>
                                         </div>
                                          <div class="col-md-4">
                                           <label class="form-label">Value<a style="text-decoration: none;color:red">*</a></label>
                                          <input class="form-control" required type="number" id="value_{{$k}}" name="values[]" value="{{ $values }}"> 
                                      </div>
                    
                                        <div class="col-md-4">
                                            <label class="form-label">Comments</label>
                                             <input class="form-control" type="text" id="comments_{{$k}}" name="measurement_comments[]" value="{{ $comments }}"/>
                                        </div>
                                         </div>

                                   </div>
                            </div>
                                    
                                @endforeach
                                @endif
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
                 @include('pages.measurement.measurement_script')
        </div>
@endsection