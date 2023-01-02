@if($data['observations'] ?? null)
@foreach ($data['observations'] as $observation )
<div style="margin: 5px 0px">
<div class="card">
<div class="card-body" style="height: auto" >
<div class="row">
    <div class="col-md-3">
        <label>Date</label>
            <p>{{ dateFormat($observation->date)}}</p>
        </div>
        <div class="col-md-3">
            <label>Day of Observation</label>
            <p>{{$observation->day_of_observation}}</p>
        </div>
        <div class="col-md-3">
                <label>Bed Time</label>
                <p>{{old('bed_time') ?? getTime($observation->bed_time)}}</p>
            </div>
        <div class="col-md-3">
            <label>Wake up Time</label>
                <p>{{old('wake_up_time') ?? getTime($observation->wake_up_time)}}</p>
        </div>
            
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Activity</label>
            <p>{{old('exercise_routine') ?? $observation->exercise_routine}}</p>
        </div>
        <div class="col-md-3">
            <label>Remarks</label>
            <p>{{old('steps') ?? $observation->steps}}</p>
            </div>
                        
            <div class="col-md-3">
             <label>Water Intake Litres</label>
            <p>{{old('water_intake') ?? $observation->water_intake}}</p>
        </div>
    </div>
</div>
</div>
</div>
@endforeach
@endif