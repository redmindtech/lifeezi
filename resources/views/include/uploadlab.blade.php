@if($data['uploadlabs'] ?? null)
@foreach ($data['uploadlabs'] as $uploadlab )
<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto" >
<div class="row">
    <div class="col-md-3">
        <label> Test Date</label>
            <p>{{ dateFormat($uploadlab->test_date)}}</p>
        </div>
        <div class="col-md-3">
            <label>Report Stage</label>
            <p>{{$uploadlab->report_stage}}</p>
        </div>
        <div class="col-md-3">
            <label>Upload Lab</label>
        <p><a href="{{ url('/assets/upload/'. $uploadlab->upload_lab)}}" download>Download</a></p>
        </div>
            <div class="col-md-3">
                <label>Next Test Date</label>
                <p>{{old('next_test_date') ?? dateFormat($uploadlab->next_test_date)}}</p>
            </div>
    </div>
     @if($uploadlab->upload_lab_type)
 @foreach ($uploadlab->upload_lab_type as $upload_lab_type )
 <div class="row">
       <div class="col-md-3">
        <label>Upload Type</label>
        <p>{{ $upload_lab_type->upload_type }}</p>
    </div>
    <div class="col-md-3">
        <label>Value</label>
        <p>{{ $upload_lab_type->value }}</p>
    </div>
    <div class="col-md-3">
        <label>Comments</label>
        <p>{{ $upload_lab_type->comments }}</p>
    </div>  
 </div>
 @endforeach
 @endif
</div>
</div>
</div>
@endforeach
@endif