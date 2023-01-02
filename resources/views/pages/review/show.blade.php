@extends('layouts.app',[
    'activeName' => 'Review'
])

@section('content')
<div class="py-6" style="width: 100%;margin:12px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Review</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('review.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                    @include('include.measurement')
                    @include('include.observations')
                    @include('include.uploadlab')
                    @include('include.planning')
                    @include('include.followups')
                   <div class="row">
                    <div class="col-md-12">
                            @if($review ?? null)
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="review_date" class="form-label">Review Date</label>
                                    <p>{{dateFormat($review->review_date)}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="next_review_date" class="form-label">Next Review Date</label>
                                    <p>{{dateFormat($review->next_review_date)}}</p>
                                </div>
                                 <div class="col-md-4">
                                 <label for="client_progress" class="form-label">Client Progress</label>
                                 <p>{{$review->client_progress}}</p>
                                </div>
                            </div>
                            <div class="row">
                                   <div class="col-md-4">
                                    <label for="client_conerns" class="form-label">Client Conerns</label>
                                    <p>{{$review->client_conern}}</p>
                                   </div>
                                <div class="col-md-4">
                                    <label for="area_to_focus" class="form-label">Area To Focus</label>
                                    <p>{{$review->area_need_to_focus}}</p>
                                </div>
                               </div> 
                               @endif 
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection