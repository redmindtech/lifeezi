@extends('layouts.app',[
    'activeName' => 'Employee'
])

@section('content')
<div class="py-3" style="width: 100%;margin:0px;">
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
                        <form enctype="multipart/form-data" class="form-group" method="POST" action="{{ route('profile.store')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Name</label>
                                    <p>{{old('employee_name') ?? $employee->employee_name}}</p>
                                </div>
                                 <div class="col-md-6">
                                    <label for="email" class="form-label">Designation</label>
                                    <p>{{old('designation') ?? ucfirst(implode(' ', explode('_', $employee->designation)))}}</p>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_of_joining" class="form-label">Date of Joining</label>
                                    <p>{{old('date_of_joining') ?? Carbon\Carbon::parse($employee->date_of_joining)->format('d-M-Y')}}</p>
                                </div>
                                     <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    <p>{{old('email') ?? $employee->email}}</p>
                                </div>
                            </div>
                            <div class="row">
                           
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <p>{{old('status') ?? ucfirst($employee->status)}}</p>
                                </div>
                            </div>
                        </form>
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection