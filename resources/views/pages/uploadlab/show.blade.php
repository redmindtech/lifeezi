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
                         <h2>UPLOAD LAB REPORTS</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('upload.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                    <div style="margin: 5px 0px">
                      <div class="card">
                       <div class="card-body" style="height: auto;" >
                   <div class="row">
                    <div class="col-md-12">
                        @if($uploadLab)
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('upload.update',$uploadLab)}}" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="Name" class="form-label">Test Date</label>
                                    <p>{{ dateFormat($uploadLab->test_date)}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="Name" class="form-label">Report Stage</label>
                                     <p>{{$uploadLab->report_stage}}</p>
                                </div>
                            <!--</div>-->
                            <!--<div class="row">-->
                                    <div class="col-md-3">
                                    <label for="Name" class="form-label">Upload Report</label>
                                    <p><a href="{{ url('/assets/uploads/' . $uploadLab->upload_lab)}}" download>Download</a></p>
                                </div>
                                   <div class="col-md-3">
                                    <label for="Name" class="form-label">Next Test Date</label>
                                    <p>{{ dateFormat($uploadLab->next_test_date)}}</p>
                                </div>
                            </div>
                        
                       <div id="upload_div">
                                @if($uploadLab->upload_lab_type)
                                @foreach ($uploadLab->upload_lab_type as $key => $upload_lab_type )
                                 <div class="card" style="margin: 5px 0" >
                                 <div class="card-body" style="height: auto;" >
                                    <div class="row">
                                       <div class="col-md-3">
                                         <label class="form-label">Report Type</label>
                                         <p>{{ $upload_lab_type->upload_type}}</p>
                                         </div>
                                          <div class="col-md-3">
                                           <label class="form-label">Value</label>
                                          <p>{{ $upload_lab_type->value }}</p>
                                          </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Comments</label>
                                             <p>{{ $upload_lab_type->comments }}</p>
                                        </div>
                                   </div>
                            </div>
                                 </div>
                            @endforeach
                            @endif
                            </div>
                            <br/>
                            
                        </form>
                        @endif
                    </div>
                   </div>
                </div>
            </div>
                 @include('pages.observation.observation_script')
        </div>
@endsection