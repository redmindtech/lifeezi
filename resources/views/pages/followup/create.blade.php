@extends('layouts.app',[
    'activeName' => 'FollowUp'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>FOLLOWUP</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('followup.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                         @include('include.client')
                    @include('include.onboarding')
                    @include('include.observations')
                    @include('include.followups')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" class="form-group" method="POST" onsubmit=handleSubmit() action="{{ route('followup.store')}}" >
                            @csrf
                                                        <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Name" class="form-label">Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="follow_date" value="{{old('follow_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('follow_date'))
                                            <div class="error">{{ $errors->first('follow_date') }}</div>
                                  @endif
                                </div>
                                         <div class="col-md-4">
                                    <label for="mobile" class="form-label">Day<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text"class="form-control" name="follow_day" value="{{old('follow_day') ?? (count($data['follow_ups'])+1)}}"/>
                                @if($errors->has('follow_day'))
                                    <div class="error">{{ $errors->first('follow_day') }}</div>
                                 @endif
                                </div>
                                 <div class="col-md-4">
                                    <label for="yes" class="form-label">Is Client Following Schedule?<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                                    <div style="display: flex;flex-wrap:wrap">
    <div class="form-check" style="margin-right:8px;">
  <input class="form-check-input" type="radio" name="follow_up" value="yes" id="yes" @if(old('follow_up') == 'yes') checked @endif>
  <label class="form-check-label" for="yes">
Yes
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="follow_up" value="no" id="no" @if(old('follow_up') == 'no') checked @endif >
  <label class="form-check-label" for="no">
  No
  </label>
</div>
                                                    </div>
                                @if($errors->has('follow_up'))
                                            <div class="error">{{ $errors->first('follow_up') }}</div>
                                 @endif
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Comments</label>
                                    <textarea class="form-control" name="comments"> {{old('comments') ?? ''}}</textarea>
                                @if($errors->has('comments'))
                                    <div class="error">{{ $errors->first('comments') }}</div>
                                 @endif
                                    </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Deviation</label>
                                    <textarea class="form-control" name="deviation"> {{old('deviation') ?? ''}}</textarea>
                                @if($errors->has('deviation'))
                                    <div class="error">{{ $errors->first('deviation') }}</div>
                                 @endif
                                    </div>
                            </div>
                            <div class="row">
                                     <div class="col-md-6">
                                    <label for="Name" class="form-label">Weight<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text" class="form-control" name="weight" value="{{old('weight') ?? ''}}"/>
                                    @if($errors->has('weight'))
                                            <div class="error">{{ $errors->first('weight') }}</div>
                                  @endif
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="button"  class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                            <script type="text/javascript">
           function handleSubmit(){
             $('#button').attr('disabled',true)
           }
           </script>
                   </div>
                </div>
            </div>
        </div>
@endsection