@extends('layouts.app',[
    'activeName' => 'Summary'
])

@section('content')
<div class="py-3" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Assessment Summary</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('summary.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('summary.store')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Assessment Date</label>
                                    <p>{{ dateFormat($summary->summary_date) }}</p>
                                
                                </div>
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Assessment Status</label>
                                  <p>{{ $summary->summary_status }}</p>
                                     @if($errors->has('summary_status'))
                                       <div class="error">{{ $errors->first('summary_status') }}</div>
                                  @endif
                                </div>
                       
                            </div>
                            <div class="row">
                                       <div class="col-md-6">
                                    <label for="Name" class="form-label">Assessment Details</label>
                                      <p>{{ $summary->summary_details }}</p>
                                </div>
                            </div>
                        </form>
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection