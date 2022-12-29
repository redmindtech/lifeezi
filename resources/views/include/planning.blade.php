@foreach ($data['plannings'] as $plan )
@if(($planning->id ?? null) != $plan->id)
<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto;" >
<div class="row">
    <div class="col-md-4">
        <label>Plan Start Date</label>
        <p>{{ dateFormat($plan->plan_start_date) }}</p>
    </div>
    <div class="col-md-4">
        <label>Plan End Date</label>
        <p>{{ dateFormat($plan->plan_end_date) }}</p>
    </div>
    <div class="col-md-4">
        <label>Mail Send Date</label>
        <p>{{ dateFormat($plan->mail_send_date) }}</p>
    </div> 
</div>
<div class="row">
    <div class="col-md-4">
        <label>Explanation Date</label>
        <p>{{ dateFormat($plan->explanation_date) }}</p>
    </div>
    <div class="col-md-4">
        <label>Objective</label>
        <p>{{ $plan->objective }}</p>
    </div>
<!--    <div class="col-md-4">-->
<!--        <label>Wake Up Time</label>-->
<!--        <p>{{ getTime($plan->wake_up_time) }}</p>-->
<!--    </div> -->
<!--</div>-->
<!--<div class="row">-->
<!--    <div class="col-md-4">-->
<!--        <label>Bed Time</label>-->
<!--        <p>{{ getTime($plan->bed_time) }}</p>-->
<!--    </div>-->
    <!--<div class="col-md-4">-->
    <!--    <label>Steps</label>-->
    <!--    <p>{{ $plan->steps }}</p>-->
    <!--</div>-->
    <!--<div class="col-md-4">-->
    <!--    <label>Water Intake</label>-->
    <!--    <p>{{ $plan->water_intake }}</p>-->
    <!--</div> -->
<!--</div>-->
<!--<div class="row">-->
<!--    <div class="col-md-4">-->
<!--        <label>Food Avoid</label>-->
<!--        <p>{{ $plan->food_to_avoid }}</p>-->
<!--    </div>-->
    <div class="col-md-4">
        <label>Comments</label>
        <p>{{ $plan->comments }}</p>
    </div>
    <div class="col-md-4">
        <label>Activity</label>
        <p>{{ $plan->exercise_routine }}</p>
    </div> 
</div>
 @if($plan->plan_type)
 @foreach ($plan->plan_type as $plan_type )
 <div class="row">
       <div class="col-md-6">
        <label>Meal Category</label>
        <p>{{ $plan_type->meal_category }}</p>
    </div>
    <div class="col-md-6">
        <label>Food Details</label>
        <p>{{ $plan_type->food_details }}</p>
    </div> 
 </div>
 @endforeach
 @endif
</div>
</div> 
</div>
@endif
@endforeach