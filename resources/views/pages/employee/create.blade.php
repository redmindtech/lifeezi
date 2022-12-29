@extends('layouts.app',[
    'activeName' => 'Employee'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-3">
                         <h2>Employee</h2>
                        </div>
                        <div class="col-md-9 float-right">
                            <a href="{{ route('employee.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('employee.store')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Name<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text" class="form-control" name="employee_name" value="{{old('employee_name') ?? ''}}"/>
                                    @if($errors->has('employee_name'))
                                            <div class="error">{{ $errors->first('employee_name') }}</div>
                                  @endif
                                </div>
                                 <div class="col-md-6">
                                    <label for="email" class="form-label">Designation<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select name="designation" class="form-control">
                                        <option value="">--- Select any one option ---</option>
                                        <option value="executive_directors" @if(old('designation') == 'executive_directors') selected @endif>Executive Directors</option>
                                        <option value="senior_wellness_coach" @if(old('designation') == 'senior_wellness_coach') selected @endif>Senior Wellness Coach</option>
                                        <option value="junior_wellness_coach" @if(old('designation') == 'junior_wellness_coach') selected @endif>Junior Wellness Coach</option>
                                    </select>
                                @if($errors->has('designation'))
                                            <div class="error">{{ $errors->first('designation') }}</div>
                                 @endif
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_of_joining" class="form-label">Date of Joining</label>
                                    <input type="date"class="form-control" name="date_of_joining" value="{{old('date_of_joining') ?? ''}}"/>
                                @if($errors->has('date_of_joining'))
                                    <div class="error">{{ $errors->first('date_of_joining') }}</div>
                                 @endif
                                </div>
                                              <div class="col-md-6">
                                    <label for="Email" class="form-label">Email<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="email" class="form-control" name="email" value="{{old('email') ?? ''}}"/>
                                @if($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                  @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">--- Select any one option ---</option>
                                        <option value="active" @if(old('status') == 'active') selected @endif>Active</option>
                                        <option value="inactive" @if(old('status') == 'inactive') selected @endif>In Active</option>
                                    </select>
                                @if($errors->has('status'))
                                    <div class="error">{{ $errors->first('status') }}</div>
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