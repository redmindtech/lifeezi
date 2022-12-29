<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto" >
<div class="row">
    @if($data['client'])
    <?php $client = $data['client'] ?>
    @endif
    <div class="col-md-3">
        <label >Name</label>
        <p>{{ $client->client_name }}</p>
    </div>
    <div class="col-md-3">
        <label >Sex</label>
        <p>{{ ucfirst($client->sex) }}</p>
    </div>
    <div class="col-md-3">
        <label >Email</label>
        <p>{{ $client->email }}</p>
    </div>
    <div class="col-md-3">
        <label >Objectives</label>
        @if($client->transformation_plan == 'others')
        <p>{{ucfirst(implode(' ', explode('_', $client->transformation_input)))}}</p>
        @else
        <p>{{ucfirst(implode(' ', explode('_', $client->transformation_plan)))}}</p>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label >Enquiry Date</label>
        <p>{{ dateFormat($client->expiry_date) }}</p>
    </div>
    <div class="col-md-3">
        <label >Mobile</label>
        <p>{{ $client->mobile }}</p>
    </div>
    @if($client->schedule_assement ?? null)
    <div class="col-md-3">
        <label >Schedule Date</label>
        <p>{{ dateFormat($client->schedule_assement->schedule_date_time,true) }}</p>
    </div>
    <div class="col-md-3">
        <label >Schedule Comments</label>
        <p>{{ $client->schedule_assement->comments }}</p>
    </div>
    @endif
</div>
<div class="row">
    @if($client->summary ?? null)
    <div class="col-md-3">
        <label>Summary Date</label>
        <p>{{ dateFormat($client->summary->summary_date) }}</p>
    </div>
      
        <div class="col-md-3">
        <label>Summary Details</label>
        <p>{{ $client->summary->summary_details }}</p>
    </div>
    @endif
</div>

</div>
</div>
</div>