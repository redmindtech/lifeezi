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
                        @if($client)
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('client.update', $client)}}" >
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Name<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text" class="form-control" name="client_name" value="{{$client->client_name ?? old('employee_name')}}"/>
                                    @if($errors->has('client_name'))
                                            <div class="error">{{ $errors->first('client_name') }}</div>
                                  @endif
                                </div>
                                 <div class="col-md-6">
                                    <label for="sex" class="form-label">Sex<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                                      <div style="display: flex;flex-wrap:wrap">
                                    <div class="form-check" style="margin-right: 8px">
  <input class="form-check-input" type="radio" name="sex" value="male" id="male" @if($client->sex == 'male') checked @endif>
  <label class="form-check-label" for="male">
    Male
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="sex" value="female" id="female" @if($client->sex == 'female') checked @endif >
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
                                    <input type="number"class="form-control" name="mobile" value="{{$client->mobile ?? old('mobile')}}"/>
                                @if($errors->has('mobile'))
                                    <div class="error">{{ $errors->first('mobile') }}</div>
                                 @endif
                                </div>
                                      <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$client->email ?? old('email')}}"/>
                                @if($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                  @endif
                                </div>
                         
                            </div>
                            <div class="row" >
                          
                                <div class="col-md-12">
                                    <label for="status" class="form-label">Objectives<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select name="transformation_plan[]" multiple="multiple" id="transformation_plan" class="form-control select2" onchange=onChangeOthers()>
                                      <option value =''>--- Select any one option ---</option>
                                      @if($data['transformation_plans'])
                                        @foreach(explode(',',$client->transformation_plan) as $key)
                                        <?php $val = true ?>
                                         @foreach($data['transformation_plans'] as $value)
                                         @if($key ==$value->span)
                                         <?php $val = false ?>
                                          @foreach($data['transformation_plans'] as $value)
                                         <option @if(($key ?? old('transformation_plan')) == $value->span ) selected @endif value="{{$value->span}}" >{{$value->name}}</option> 
                                          @endforeach
                                         @endif
                                         @endforeach
                                         @if($val)
                                         <option value ="{{ $key }}" selected>{{ $key }}</option>
                                         @endif
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
                                    <select class="form-control" name="reference" id="reference" onchange=onChangeReference()>
                                        @if($data['reference'])
                                        <option value=''>--Select any one option --</option>
                                        @foreach ($data['reference'] as $key => $value )
                                            <option @if(($client->reference ?? old('reference')) == $key) selected @endif value="{{ $key}}" >{{$value}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                       @if($errors->has('reference'))
                                    <div class="error">{{ $errors->first('reference') }}</div>
                                @endif
                                </div>
                                @if($client->reference_input)
                                <div class="col-md-6" id="reference_col_div">
                                    @if($client->reference =="reference")
                                    <label for="reference_input" class="form-label">Reference Name</label>
                                    @elseif($client->reference =="others")
                                    <label for="reference_input" class="form-label">Others</label>
                                    @endif
                                    <input type="text" name="reference_input" value="{{ $client->reference_input ?? old('reference_input')}}" class="form-control" />
                                </div>
                                @endif
                                
                            </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <label for="expiry_date" class="form-label">Enquiry Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="expiry_date" value="{{$client->expiry_date ?? old('expiry_date')}}"/>
                                @if($errors->has('expiry_date'))
                                            <div class="error">{{ $errors->first('expiry_date') }}</div>
                                  @endif
                                </div>
                               </div>
                               <div class="row">
                                <div class="col-md-12">
                                    <label for="comments" class="form-label">Preliminary Assessment</label>
                                    <textarea name="comments" class="form-control">{{$client->comments ?? old('comments')}}</textarea>
                                </div>
                               </div>
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
                              <script type="text/javascript">
                  function onChangeOthers() {
                    
             let value = $('#transformation_plan').find(':selected').val();
             if(value == 'others') {
                $('#secondary').append('<div class="row" id="secondary_input"><div class="col-md-12">'
                    +'<label class="form-label">Custom Plan<a style="text-decoration: none;color:red">*</a></label><input type="text" name="transformation_input" class="form-control" required />'
                    +'</div</div>')
             } else {
                $('#secondary_input').remove();
             }
           }
            function onChangeReference() {
               
                let value = $('#reference').find(':selected').val();
             if(value == 'reference' ) {
                $('#reference_col_div').remove();
                $('#reference_div').append('<div id="reference_col_div" class="col-md-6">'
                    +'<label class="form-label">Reference Name<a style="text-decoration: none;color:red">*</a></label><input type="text" name="reference_input" class="form-control"  />'
                    +'</div>')
                     
             } 
             else if(value == 'others') {
                $('#reference_col_div').remove();
                $('#reference_div').append('<div id="reference_col_div" class="col-md-6">'
                    +'<label class="form-label">Others<a style="text-decoration: none;color:red">*</a></label><input type="text" name="reference_input"  class="form-control"  />'
                    +'</div>')
             }
             else {
                $('#reference_col_div').remove();
               
             }

           }

                    $(document).ready(function() {
            $('#transformation_plan').select2({
                tags:true
            });
            });
               
        </script> 
                </div>
            </div>
        
@endsection