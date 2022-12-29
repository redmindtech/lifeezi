@extends('layouts.app',[
    'activeName' => 'Enquiries'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
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
                        <form enctype="multipart/form-data" class="form-group" method="POST" onsubmit=handleSubmit() action="{{ route('client.store')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Name<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text" class="form-control" name="client_name" value="{{old('client_name') ?? ''}}"/>
                                    @if($errors->has('client_name'))
                                            <div class="error">{{ $errors->first('client_name') }}</div>
                                  @endif
                                </div>
                                 <div class="col-md-6">
                                    <label for="sex" class="form-label">Sex<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                                    <div style="display: flex;flex-wrap:wrap">
    <div class="form-check" style="margin-right:8px;">
  <input class="form-check-input" type="radio" name="sex" value="male" id="male" @if(old('sex') == 'male') checked @endif>
  <label class="form-check-label" for="male">
    Male
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="sex" value="female" id="female" @if(old('sex') == 'female') checked @endif >
  <label class="form-check-label" for="female">
  Female
  </label>
</div>
                                                    </div>
                                @if($errors->has('sex'))
                                            <div class="error">{{ $errors->first('sex') }}</div>
                                 @endif
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="number"class="form-control" name="mobile" value="{{old('mobile') ?? ''}}"/>
                                @if($errors->has('mobile'))
                                    <div class="error">{{ $errors->first('mobile') }}</div>
                                 @endif
                                </div>
                                               <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{old('email') ?? ''}}"/>
                                @if($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                  @endif
                                </div>

                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <label for="status" class="form-label">Objectives <a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select name="transformation_plan[]" multiple="multiple"  id="transformation_plan" class="form-control select2" >
                                      <option value =''>--- Select any one option ---</option>
                                      <?php $array=old('transformation_plan') ?? NULL ?>

                                      @if($data['transformation_plans'] && !$array)                                      
                                         @foreach($data['transformation_plans'] as $value)
                                         <option @if(old('transformation_plan') == $value->span ) selected @endif value="{{$value->span}}" >{{$value->name}}</option>
                                         @endforeach
                                         @elseif($array && count($array) > 0 )
                                         @foreach($data['transformation_plans'] as $value)
                                         @foreach($array as $row)
                                         <option @if($row == $value->span ) selected @endif value="{{$value->span}}" >{{$value->name}}</option>
                                         @endforeach
                                         @endforeach
                                      @endif
                                    </select>
                                @if($errors->has('transformation_plan'))
                                    <div class="error">{{ $errors->first('transformation_plan') }}</div>
                                @endif
                            </div>
                            </div>
                            <div class="row" id="reference_div">
                                <div class="col-md-6">
                                    <label for="reference" class="form-label">Enquiry Source</label>
                                    <select class="form-control" id="reference" name="reference" onchange=onChangeReference()>
                                        @if($data['reference'])
                                        <option value=''>--Select any one option --</option>
                                        @foreach ($data['reference'] as $key => $value )
                                            <option @if(old('reference') == $key) selected @endif value="{{ $key}}" >{{$value}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                       @if($errors->has('reference'))
                                    <div class="error">{{ $errors->first('reference') }}</div>
                                @endif
                                </div>
                                
                                @if(old('reference_input') ?? null)
                                <div id="reference_col_div" class="col-md-6">
                    <label class="form-label">Reference Name<a style="text-decoration: none;color:red">*</a></label><input type="text" name="reference_input" class="form-control"  />
                    </div>
                      @if($errors->has('reference_input'))
                                    <div class="error">{{ $errors->first('reference_input') }}</div>
                                @endif
                                @endif
                            </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <label for="expiry_date" class="form-label">Enquiry Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="expiry_date" value="{{old('expiry_date') ?? \Carbon\Carbon::now()->format('Y-m-d')}}"/>
                                @if($errors->has('expiry_date'))
                                            <div class="error">{{ $errors->first('expiry_date') }}</div>
                                  @endif
                                </div>
        
                               </div>
                               <div class="row">
                                <div class="col-md-12">
                                    <label for="comments" class="form-label">Preliminary Assessment</label>
                                    <textarea name="comments" class="form-control">{{old('comments') ?? ''}}</textarea>
                                </div>
                               </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit"id="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                   </div>
                </div>
            </div>
           <script type="text/javascript">
            function handleSubmit(){
             $('#button').attr('disabled',true)
           }

           function onChangeReference() {
            let value = $('#reference').find(':selected').val();
             if(value == 'reference') {
                $('#reference_div').append('<div id="reference_col_div" class="col-md-6">'
                    +'<label class="form-label">Reference Name<a style="text-decoration: none;color:red">*</a></label><input type="text" name="reference_input" class="form-control"  />'
                    +'</div>')
             } else {
                $('#reference_col_div').remove();
             }
           }
          
           $(document).ready(function() {
            console.log('readhy');
            $('#transformation_plan').select2({
                tags:true
            });
            });
               
        </script> 
        </div>
@endsection