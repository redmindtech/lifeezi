

@if($data['uploadlabs'] ?? null)
@foreach ($data['uploadlabs'] as $uploadlab )
<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto" >
<div class="row">
    <div class="col-md-3">
        <label for="Name" class="form-label"> Test Date<a style="text-decoration: none;color:red">*</a></label>
            <p>{{ dateFormat($uploadlab->test_date)}}</p>
        </div>
        <div class="col-md-3">
            <label  class="form-label">Report Stage</label>
            <p>{{$uploadlab->report_stage}}</p>
        </div>
        <div class="col-md-3">
            <label for="Name" class="form-label">Upload Lab</label>
        <p><a href="{{ url('/assets/upload/'. $uploadlab->upload_lab)}}" download>Download</a></p>
        </div>
            <div class="col-md-3">
                <label  class="form-label">Next Test Date</label>
                <p>{{old('next_test_date') ?? $uploadlab->next_test_date}}</p>
            </div>
    </div>
     @if($uploadlab->upload_lab_type)
 @foreach ($uploadlab->upload_lab_type as $upload_lab_type )
 <div class="row">
       <div class="col-md-4">
        <label>Upload Type</label>
        <p>{{ $upload_lab_type->upload_type }}</p>
    </div>
    <div class="col-md-4">
        <label>Value</label>
        <p>{{ $upload_lab_type->value }}</p>
    </div>
    <div class="col-md-4">
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