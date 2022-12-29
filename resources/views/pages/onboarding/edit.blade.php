@extends('layouts.app',[
    'activeName' => 'Onboarding'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Onboarding</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('onboarding.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        @if($onboarding)
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('onboarding.update',$onboarding)}}" >
                            @csrf
                            @method('PATCH')
                            <input type="hidden" style="display: none" name="client_id" value="{{ $onboarding->client_id}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Onboarding Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="onboarding_date" value="{{ $onboarding->onboarding_date ?? old('onboarding_date')}}"/>
                                    @if($errors->has('onboarding_date'))
                                            <div class="error">{{ $errors->first('onboarding_date') }}</div>
                                  @endif
                                </div>
                                 <div class="col-md-6">
                                    <label for="target_days" class="form-label">Target Days</label>
                                <input class="form-control" name="target_days" type="number" value="{{$onboarding->target_days ?? old('target_days')}}" />
                                @if($errors->has('target_days'))
                                            <div class="error">{{ $errors->first('target_days') }}</div>
                                 @endif
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_of_birth" class="form-label">Date of Birth<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date"class="form-control" name="date_of_birth" value="{{$onboarding->date_of_birth ?? old('date_of_birth') }}"/>
                                @if($errors->has('date_of_birth'))
                                    <div class="error">{{ $errors->first('date_of_birth') }}</div>
                                 @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="occupation" class="form-label">Job Nature<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text"class="form-control" name="occupation" value="{{$onboarding->occupation ?? old('occupation')}}"/>
                                 @if($errors->has('occupation'))
                                    <div class="error">{{ $errors->first('occupation') }}</div>
                                 @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Location<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <textarea class="form-control" name="address">{{$onboarding->address ?? old('address')}}</textarea>
                                @if($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="height" class="form-label">Height<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text"class="form-control" name="height" value="{{$onboarding->height ?? old('height')}}"/>
                                 @if($errors->has('height'))
                                    <div class="error">{{ $errors->first('height') }}</div>
                                 @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="weight" class="form-label">Weight<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text"class="form-control" name="weight" value="{{$onboarding->weight ?? old('weight') }}"/>
                                 @if($errors->has('weight'))
                                    <div class="error">{{ $errors->first('weight') }}</div>
                                 @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="height" class="form-label">Client Fee(Monthly)<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text" class="form-control" name="client_fee" value="{{ old('client_fee') ?? $onboarding->client_fee}}" />
                                 @if($errors->has('client_fee'))
                                    <div class="error">{{ $errors->first('client_fee') }}</div>
                                 @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="weight" class="form-label">Upload PARQ form</label>
                                    <input type="file"class="form-control" name="upload_form" accept="pdf" value="{{old('upload_form') ?? ''}}"/>
                                 @if($errors->has('upload_form'))
                                    <div class="error">{{ $errors->first('upload_form') }}</div>
                                 @endif
                                </div>
                            </div>
                            <div class="row" >
                                    <div class="col-md-6">
                                    <label for="coach" class="form-label">Past/Present Health History</label>
                                    <select class="form-control" id="past_history"  name="past_history" >
                                        @if(PASTHISTORY)
                                        <option value=''>--Select any one option --</option>
                                        @foreach (PASTHISTORY as  $value )
                                            <option @if((old('past_history') ?? $onboarding->past_history) == $value) selected @endif value="{{ $value}}">{{$value}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                       @if($errors->has('past_history'))
                                    <div class="error">{{ $errors->first('past_history') }}</div>
                                @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="coach" class="form-label">Wellness coach<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select class="form-control"  name="coach" >
                                        @if($data['employees'])
                                        <option value=''>--Select any one option --</option>
                                        @foreach ($data['employees'] as  $value )
                                            <option @if(($onboarding->coach ?? old('coach')) == $value->employee_name) selected @endif value="{{ $value->employee_name}}">{{$value->employee_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                       @if($errors->has('coach'))
                                    <div class="error">{{ $errors->first('coach') }}</div>
                                @endif
                                </div>
                            </div>
                                                        <div class="row">
                                <div class="col-md-12">
                                    <label for="comments" class="form-label">Doctor's Comment</label>
                                    <textarea class="form-control" name="comments">{{old('comments') ?? $onboarding->comments}}</textarea>
                                @if($errors->has('comments'))
                                            <div class="error">{{ $errors->first('comments') }}</div>
                                  @endif
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                    <label for="family_disease_history" class="form-label">Family Disease History</label>
                                    <textarea class="form-control" name="family_disease_history">{{old('family_disease_history') ?? $onboarding->family_disease_history}}</textarea>
                                @if($errors->has('family_disease_history'))
                                            <div class="error">{{ $errors->first('family_disease_history') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="current_medication" class="form-label">Current Medications</label>
                                    <textarea class="form-control" name="current_medication">{{old('current_medication') ?? $onboarding->current_medication}}</textarea>
                                @if($errors->has('current_medication'))
                                            <div class="error">{{ $errors->first('current_medication') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="objective_client" class="form-label">Objective of client</label>
                                    <textarea class="form-control" name="objective_client">{{old('objective_client') ?? $onboarding->objective_client}}</textarea>
                                @if($errors->has('objective_client'))
                                            <div class="error">{{ $errors->first('objective_client') }}</div>
                                  @endif
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
                    <script type="text/javascript">
                     $(`#past_history`).select2({
                             tags:true
                           });
                    </script>
                   </div>
                </div>
            </div>
        </div>
@endsection