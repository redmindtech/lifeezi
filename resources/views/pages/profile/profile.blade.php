@extends('layouts.app',[
    'activeName' => 'Home'
])

@section('content')
<div class="py-3" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">

                <div class="card-body">
                   <div class="row">
                    <div class="col-md-3">
                        <?php $image = auth()->user()->image ?>
                     @if($image)
                        <img src="{{ url('assets/images/'. $image )}}" style="border-radius: 50%;border:1px solid #999;width:200px;height:200px" />
                      @else
                      <img src="{{ url('assets/images/default.jpg')}}" style="border-radius: 50%;border:1px solid #999;width:200px;height:200px" />
                      @endif
                    </div>
                    <div class="col-md-9">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('profile.store')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Name</label>
                                    <input type="text"class="form-control" value="{{auth()->user()->name}}" readonly/>
                                </div>
                                 <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{auth()->user()->email}}" readonly/>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Change Password</label>
                                    <input type="password" name="password" id="change_password" class="form-control" style="padding-left:40px;"/>
                                   <span style="position: relative" >
                                     <i class="fa fa-eye" id="password-eye" onclick=changeType() style="position: absolute;top:-26px;right:-30px"></i>
                                   </span>
                                </div>
                                <script type="text/javascript">
                                     function changeType() {
                                        let password = document.getElementById('change_password').type;
                                        let icon = document.getElementById('password-eye')
                                        console.log(password);
                                        if(password === 'password') {
                                          document.getElementById('change_password').type  = 'text';
                                            icon.style.color = 'blue'
                                        } else {
                                             document.getElementById('change_password').type= 'password';
                                            icon.style.color = 'black'
                                        }
                                        
                                     }
                                </script>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection