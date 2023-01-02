@extends('layouts.app',[
    'activeName' => 'Disengagement'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>DISENGAGEMENT</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('disengagement.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('disengagement.store')}}" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row" id="disengagement_div">
                                <div class="col-md-6">
                                    <label for="target_days" class="form-label">Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                <input class="form-control" name="date" type="date" value="{{old('date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}" />
                                @if($errors->has('date'))
                                            <div class="error">{{ $errors->first('date') }}</div>
                                 @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Disengagement Type<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select class="form-control" id="disengagement" onchange=selectchange() name="disengagement_type" value="{{old('disengagement_type') ?? ''}}">
                                        <option value="">--- Select any one option ---</option>
                                        <option value="self_maintenance">Self Maintenance</option>
                                        <option value="termination">Termination</option>
                                        <option value="temporary_discontinuation">Temporary Discontinuation</option>
                                    </select>
                                    
                                    @if($errors->has('disengagement_type'))
                                            <div class="error">{{ $errors->first('disengagement_typ') }}</div>
                                  @endif
                                </div>

                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="disengagement_reason" class="form-label">Disengagement Reason<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text"class="form-control" name="disengagement_reason" value="{{old('disengagement_reason') ?? ''}}"/>
                                @if($errors->has('disengagement_reason'))
                                    <div class="error">{{ $errors->first('disengagement_reason') }}</div>
                                 @endif
                                </div>
                                           <div class="col-md-6">
                                    <label for="reviewed_by" class="form-label">Reviewed By<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select class="form-control"  name="reviewed_by" >
                                        @if($data['employees'])
                                        <option value=''>--Select any one option --</option>
                                        @foreach ($data['employees'] as  $value )
                                            <option @if(old('reviewed_by') == $value->employee_name) selected @endif value="{{ $value->employee_name}}">{{$value->employee_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                       @if($errors->has('reviewed_by'))
                                    <div class="error">{{ $errors->first('reviewed_by') }}</div>
                                @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Lifeezi Comments<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <textarea class="form-control" name="comments">{{old('comments') ?? ''}}</textarea>
                                @if($errors->has('comments'))
                                            <div class="error">{{ $errors->first('comments') }}</div>
                                  @endif
                                </div>
                            </div>
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
       
                                    function selectchange(){
                                  let value = $('#disengagement').find(':selected').val();
                                  if(value == 'temporary_discontinuation') {
                                     $('#disengagement_div').append('<div id="disengagement_date" class="col-md-4">'
                                     +'<label class="form-label">End Date<a style="text-decoration: none;color:red">*</a></label><input type="date" name="end_date" id="end_date" class="form-control"   />'

                                       +'</div>')
                                       document.getElementById('end_date').value = new Date().toISOString().substring(0, 10);
                                     } else {
                                        $('#disengagement_date').remove();
                                     }

                                    }

           </script>
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection