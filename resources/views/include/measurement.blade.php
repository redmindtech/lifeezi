@foreach ($data['measurements'] as $measure )
@if(($measurement->id ?? null) != $measure->id)
<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto;" >
<div class="row">
    <div class="col-md-4">
        <label>Measurement Date</label>
        <p>{{ dateFormat($measure->measurement_date) }}</p>
    </div>
    <div class="col-md-4">
        <label>Next Measurement Date</label>
        <p>{{ dateFormat($measure->next_measurement_date) }}</p>
    </div>
    <div class="col-md-4">
        <label>Comments</label>
        <p>{{ $measure->comments }}</p>
    </div> 
</div>
 @if($measure->measurement_type)
 @foreach ($measure->measurement_type as $measurement_type )
 <div class="row">
       <div class="col-md-4">
        <label>Measurement Type</label>
        <p>{{ $measurement_type->measurement_type }}</p>
    </div>
    <div class="col-md-4">
        <label>Value</label>
        <p>{{ $measurement_type->value }}</p>
    </div>
    <div class="col-md-4">
        <label>Comments</label>
        <p>{{ $measurement_type->comments }}</p>
    </div>  
 </div>
 @endforeach
 @endif
</div>
</div> 
</div>
@endif
@endforeach