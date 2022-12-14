@if($data['onboarding'] ?? null)
<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto;" >
<div class="row">
    @if($data['onboarding'])
    <?php $onboarding = $data['onboarding'] ?>
    @endif

    <div class="col-md-3">
        <label>OnBoarding Date</label>
        <p>{{ dateFormat( $onboarding->onboarding_date ) }}</p>
    </div>
    <div class="col-md-3">
        <label>Target Days</label>
        <p>{{ $onboarding->target_days }}</p>
    </div>
    <div class="col-md-3">
        <label>Date of birth</label>
        <p>{{ dateFormat($onboarding->date_of_birth) }}</p>
    </div>
    <div class="col-md-3">
        <label>Job Nature</label>
        <p>{{ $onboarding->occupation }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <label>Location</label>
        <p>{{  $onboarding->address  }}</p>
    </div>
    <div class="col-md-3">
        <label>Height</label>
        <p>{{ $onboarding->height }}</p>
    </div>
    <div class="col-md-3">
        <label>Weight</label>
        <p>{{ $onboarding->weight }}</p>
    </div>
        <div class="col-md-3">
        <label>Form</label>
        <p><a href="{{ url('/assets/uploads/'. $onboarding->upload_form)}}" download>Download</a></p>
    </div>
</div>

<div class="row">

    <div class="col-md-3">
        <label>Wellness Coach</label>
        <p>{{ $onboarding->coach }}</p>
    </div>
       <div class="col-md-3">
        <label>Past History</label>
        <p>{{ $onboarding->past_history }}</p>
    </div>
        
       <div class="col-md-3">
        <label>Comments</label>
        <p>{{ $onboarding->comments }}</p>
    </div>
          <div class="col-md-3">
        <label>Family Disease History</label>
        <p>{{ $onboarding->family_disease_history }}</p>
    </div>
</div>
<div class="row">
        
 
            
       <div class="col-md-3">
        <label>Current Medication</label>
        <p>{{ $onboarding->current_medication }}</p>
    </div>
    <div class="col-md-3">
        <label>Objective Client</label>
        <p>{{ $onboarding->objective_client }}</p>
    </div>
    
</div>
</div>
</div>
</div>
@endif