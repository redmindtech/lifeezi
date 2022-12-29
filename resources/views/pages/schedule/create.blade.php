@extends('layouts.app',[
    'activeName' => 'Schedule Assessment'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Schedule Assessment</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('schedule.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('schedule.store')}}" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Schedule Date and Time<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="datetime-local" step="any" class="form-control" name="schedule_date_time" value="{{old('schedule_date_time') ?? Carbon\Carbon::now()->format('Y-m-d h:i')}}"/>
                                    @if($errors->has('schedule_date_time'))
                                            <div class="error">{{ $errors->first('schedule_date_time') }}</div>
                                  @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Comments</label>
                                    <input type="text" class="form-control" name="comments" value="{{ old('comments') ?? '' }}" />
                                     @if($errors->has('comments'))
                                       <div class="error">{{ $errors->first('comments') }}</div>
                                  @endif
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
           function handleSubmit(){
             $('#button').attr('disabled',true)
           }
           </script>
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection