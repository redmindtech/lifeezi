@foreach ($data['follow_ups'] as $follow_up )
@if(($followUp->id ?? null) != $follow_up->id)
<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto;" >
<div class="row">
    <div class="col-md-4">
        <label>FollowUp Date</label>
        <p>{{ dateFormat($follow_up->follow_date) }}</p>
    </div>
    <div class="col-md-4">
        <label>FollowUp Day</label>
        <p>{{ $follow_up->follow_day }}</p>
    </div>
    <div class="col-md-4">
        <label>Follow Up</label>
        <p>{{ $follow_up->follow_up }}</p>
    </div> 
</div>
<div class="row">
    <div class="col-md-4">
        <label>Comments</label>
        <p>{{ $follow_up->comments }}</p>
    </div>
    <div class="col-md-4">
        <label>Deviation</label>
        <p>{{ $follow_up->devation }}</p>
    </div>
    <div class="col-md-4">
        <label>Weight</label>
        <p>{{ $follow_up->weight }}</p>
    </div> 
</div>
</div>
</div>
</div>
@endif
@endforeach
