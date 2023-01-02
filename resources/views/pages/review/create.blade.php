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
                    @include('include.review')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('review.store')}}" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="review_date" class="form-label">Review Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="review_date" value="{{old('review_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('review_date'))
                                            <div class="error">{{ $errors->first('review_date') }}</div>
                                  @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="next_review_date" class="form-label">Next Review Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="next_review_date" value="{{old('next_review_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('next_review_date'))
                                            <div class="error">{{ $errors->first('next_review_date') }}</div>
                                  @endif
                                </div>
                               </div>
                                 <div class="row">
                                 <div class="col-md-6">
                                 <label for="client_progress" class="form-label">Client Progress</label>
                                    <textarea name="client_progress" class="form-control">{{old('client_progress') ?? ''}}</textarea>
                                </div>
                                   <div class="col-md-6">
                                    <label for="client_conerns" class="form-label">Client Conern</label>
                                    <textarea name="client_conern" class="form-control">{{old('client_conern') ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="area_to_focus" class="form-label">Area To Focus</label>
                                    <textarea name="area_need_to_focus" class="form-control">{{old('area_need_to_focus') ?? ''}}</textarea>
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