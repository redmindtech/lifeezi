@foreach ($data['reviews'] as $reviewing )
@if(($review->id ?? null) != $reviewing->id)
<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto;" >
<div class="row">
    <div class="col-md-4">
        <label>Review Date</label>
        <p>{{ dateFormat($reviewing->review_date) }}</p>
    </div>
    <div class="col-md-4">
        <label>Next Review Date</label>
        <p>{{ dateFormat($reviewing->next_review_date) }}</p>
    </div>
    <div class="col-md-4">
        <label>Client Progress</label>
        <p>{{ $reviewing->client_progress }}</p>
    </div> 
</div>
<div class="row">
    <div class="col-md-4">
        <label>Client Conern</label>
        <p>{{ $reviewing->client_conern }}</p>
    </div>
    <div class="col-md-4">
        <label>Area To Focus</label>
        <p>{{ $reviewing->area_need_to_focus }}</p>
    </div>
</div>

</div>
</div> 
</div>
@endif
@endforeach