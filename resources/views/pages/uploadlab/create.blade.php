@extends('layouts.app',[
    'activeName' => 'UploadLab'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Upload Lab Reports</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('upload.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                  @include('include.client')
                    @include('include.onboarding')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('upload.store')}}" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Test Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="test_date" value="{{old('test_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('test_date'))
                                            <div class="error">{{ $errors->first('test_date') }}</div>
                                  @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Report Stage</label>
                                    <select name="report_stage" class="form-control">
                                        <option value=''>--- Select any one option ---</option>
                                    @if(REPORT_STAGE)
                                    @foreach (REPORT_STAGE as $key => $value )
                                        <option @if(old('report_stage') == $key) selected @endif value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                    @endif
                                    </select>
                                     @if($errors->has('report_stage'))
                                       <div class="error">{{ $errors->first('report_stage') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                    <label for="Name" class="form-label">Upload Report<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="file" class="form-control" name="upload_lab" value="{{old('upload_report') ?? ''}}"/>
                                    @if($errors->has('upload_lab'))
                                            <div class="error">{{ $errors->first('upload_lab') }}</div>
                                  @endif
                                </div>
                                   <div class="col-md-6">
                                    <label for="Name" class="form-label">Next Test Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="next_test_date" value="{{old('next_test_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('next_test_date'))
                                            <div class="error">{{ $errors->first('next_test_date') }}</div>
                                  @endif
                                </div>
                            </div>
                            <br/>
                            <div class="row" >
                                <div class="col-md-12" >
                                    <a class="btn btn-info" id="uploadlab" >+ Add Row<a>
                                </div>
                            </div>
                            <br/>
                            <div id="upload_div">
                                      @if(old('report_type') ?? null)
                                @foreach (old('report_type') as $key => $uploadlab_type )
                              <?php $report_type = old('report_type')[$key] ?>
                                       <?php $values = old('value')[$key] ?>
                                          <?php $comments = old('comments')[$key] ?>
                                    
                            <div id="uploadlab_inputs_{{$key}}" class="card uploadlab">
                                <div class="card-body" style="height:30vh"> 
                                   <div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard({{$key}})>
                                       <span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-4">
                                         <label class="form-label">Report Type<a style="text-decoration: none;color:red">*</a></label>
                                         <select required name="report_type[]" id="select_report_type_{{$key}}" class="form-control" >
                                           <option value="">--- Select any one ---</option>
                                              @if(REPORT_TYPES) 
                                              @foreach (REPORT_TYPES as $key => $value )
                                                  <option @if($report_type == $key) selected @endif value="{{ $key }}">{{ $value }}</option>
                                               @endforeach
                                               @endif   
        
                                           </select>
                                         </div>
                                          <div class="col-md-4">
                                           <label class="form-label">Value<a style="text-decoration: none;color:red">*</a></label>
                                          <input class="form-control" required type="number" id="value_{{$key}}" name="value[]" value="{{ $values }}"> 
                                      </div>
                                           <div class="col-md-4">
                                            <label class="form-label">Benchmark Value</label>
                                             <input class="form-control" type="text" id="comments_{{$key}}" name="comments[]" value="{{ $comments }}" />
                                        </div>
                                       </div>
                                       <div class="row">
                                   
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
                 @include('pages.uploadlab.upload_script')
        </div>
@endsection