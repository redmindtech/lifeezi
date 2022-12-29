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
                            <a href="{{ route('measurement.list',$data['client'])}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                    @include('include.measurement')
                   <div class="row">
                    <div class="col-md-12">
                        @if($measurement)
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('measurement.store')}}" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Measurement Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <p>{{old('measurement_date') ?? dateFormat($measurement->measurement_date)}}</p>
                                </div>
                                  <div class="col-md-6">
                                    <label  class="form-label">Next Measurement Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                      <p>{{old('next_measurement_date') ?? dateFormat($measurement->next_measurement_date)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="comments" class="form-label">Comments</label>
                                    <p>{{old('comments') ?? $measurement->comments}}</p>
                                </div>
                            </div>
                            <br/>
                            <div id="measurement_div">
                                @if($measurement->measurement_type)
                                @foreach ($measurement->measurement_type as $key => $measurement_type )
                                <div class="card" style="margin:5px 0;">
                                 <div class="card-body" style="height: 15vh;" >
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Measurement Type</label>
                                            <p>{{ $measurement_type->measurement_type }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Value</label>
                                            <p>{{ $measurement_type->value }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Comments</label>
                                            <p tooltip="{{$measurement_type->comments }}">{{ $measurement_type->comments }}</p>
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