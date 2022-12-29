@extends('layouts.app',[
    'activeName' => 'Summary'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Assessment Summary</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('summary.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('summary.store')}}" >
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $data['client']['id']}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Assessment Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="summary_date" value="{{old('summary_date') ?? Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('summary_date'))
                                            <div class="error">{{ $errors->first('summary_date') }}</div>
                                  @endif
                                </div>
                                                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Assessment Status<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select name="summary_status" class="form-control">
                                        <option value="">--- Select any one option ---</option>
                                        <option value="Joining" @if(old('summary_status') == 'Joining') selected @endif >Joining</option>
                                        <option value="NotJoining" @if(old('summary_status') == 'NotJoining') selected @endif>Not Joining</option>
                                        <option value="InDilemma" @if(old('summary_status') == 'InDilemma') selected @endif>In Dilemma</option>
                                    </select>
                                     @if($errors->has('summary_status'))
                                       <div class="error">{{ $errors->first('summary_status') }}</div>
                                  @endif
                                </div>

                            </div>
                            <div class="row">
                                    <div class="col-md-12">
                                    <label for="Name" class="form-label">Assessment Details<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <textarea class="form-control" name="summary_details">{{old('summary_details') ?? ''}}</textarea>
                                    @if($errors->has('summary_details'))
                                            <div class="error">{{ $errors->first('summary_details') }}</div>
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