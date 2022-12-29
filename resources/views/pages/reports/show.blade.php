@extends('layouts.app',[
    'activeName' => 'Reports'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                      <div class="row ">
                        <div class="col-md-3">
                         <h2>REPORTS</h2>
                        </div>
                        <div class="col-md-9 float-right">
                            <a href="{{ route('reports.index',)}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                   <div class="row">
              <nav class="nav mx-3">

  <a class=" nav-link btn btn-primary btn-sm text-white" id="client" onclick=handleNav('client') href="#">Client</a>
  <a class="nav-link" id="onboarding" onclick=handleNav('onboarding') href="#">Onboarding</a>
  <a class="nav-link" id="observation" onclick=handleNav('observation') href="#">Observation</a>
  <a class="nav-link" id="measurement" onclick=handleNav('measurement') href="#">Measurement</a>
  <a class="nav-link" id="uploadlab" onclick=handleNav('uploadlab') href="#">Upload Lab</a> 
  <a class="nav-link"  id="planning" onclick=handleNav('planning') href="#">Planning</a> 
  <a class="nav-link"  id="followup" onclick=handleNav('followup') aria-current="page" href="#">Follow Up</a>
<a class="nav-link"  id="reviews" onclick=handleNav('reviews') aria-current="page" href="#">Reviews</a>
</nav>
<div id="client_div" style="display:block">
    @include('include.client')
</div>
<div id="onboarding_div" style="display:none">
    @include('include.onboarding')
</div>
<div id="observation_div" style="display:none">
    @include('include.observations')
</div>
<div id="measurement_div" style="display:none" >
    @include('include.measurement')
</div>
<div id="upload_lab_div" style="display:none">
    @include('include.uploadlab')
</div>
<div id="planning_div" style="display:none">
    @include('include.planning')
</div>
<div id="follow_up_div" style="display:none">
    @include('include.followups')
</div>
<div id="reviews_div" style="display:none">
    @include('include.review')
</div>
                   </div>
                </div>
                <script>

                    function handleNav(value) {
                      
                       switch(value) {
                        case 'client': {
                            $('#client_div').css('display','block')
                            $('#onboarding_div').css('display','none')
                            $('#observation_div').css('display','none')
                            $('#measurement_div').css('display','none')
                            $('#upload_lab_div').css('display','none')
                            $('#planning_div').css('display','none')
                            $('#follow_up_div').css('display','none')
                            $('#client').addClass('btn btn-primary btn-sm text-white')
                            $('#onboarding').removeClass('btn btn-primary btn-sm text-white')
                            $('#observation').removeClass('btn btn-primary btn-sm text-white')
                            $('#measurement').removeClass('btn btn-primary btn-sm text-white')
                            $('#uploadlab').removeClass('btn btn-primary btn-sm text-white')
                            $('#planning').removeClass('btn btn-primary btn-sm text-white')
                            $('#followup').removeClass('btn btn-primary btn-sm text-white')
                            break;
                        }
                          case 'onboarding': {
                            $('#client_div').css('display','none')
                            $('#onboarding_div').css('display','block')
                            $('#observation_div').css('display','none')
                            $('#measurement_div').css('display','none')
                            $('#upload_lab_div').css('display','none')
                            $('#planning_div').css('display','none')
                            $('#follow_up_div').css('display','none')
                            $('#client').removeClass('btn btn-primary btn-sm text-white')
                            $('#onboarding').addClass('btn btn-primary btn-sm text-white')
                            $('#observation').removeClass('btn btn-primary btn-sm text-white')
                            $('#measurement').removeClass('btn btn-primary btn-sm text-white')
                            $('#uploadlab').removeClass('btn btn-primary btn-sm text-white')
                            $('#planning').removeClass('btn btn-primary btn-sm text-white')
                            $('#followup').removeClass('btn btn-primary btn-sm text-white')
                            break;
                        }
                          case 'observation': {
                            $('#client_div').css('display','none')
                            $('#onboarding_div').css('display','none')
                            $('#observation_div').css('display','block')
                            $('#measurement_div').css('display','none')
                            $('#upload_lab_div').css('display','none')
                            $('#planning_div').css('display','none')
                            $('#follow_up_div').css('display','none')
                            $('#client').removeClass('btn btn-primary btn-sm text-white')
                            $('#onboarding').removeClass('btn btn-primary btn-sm text-white')
                            $('#observation').addClass('btn btn-primary btn-sm text-white')
                            $('#measurement').removeClass('btn btn-primary btn-sm text-white')
                            $('#uploadlab').removeClass('btn btn-primary btn-sm text-white')
                            $('#planning').removeClass('btn btn-primary btn-sm text-white')
                            $('#followup').removeClass('btn btn-primary btn-sm text-white')
                            break;
                        }
                          case 'measurement': {
                            $('#client_div').css('display','none')
                            $('#onboarding_div').css('display','none')
                            $('#observation_div').css('display','none')
                            $('#measurement_div').css('display','block')
                            $('#upload_lab_div').css('display','none')
                            $('#planning_div').css('display','none')
                            $('#follow_up_div').css('display','none')
                            $('#client').removeClass('btn btn-primary btn-sm text-white')
                            $('#onboarding').removeClass('btn btn-primary btn-sm text-white')
                            $('#observation').removeClass('btn btn-primary btn-sm text-white')
                            $('#measurement').addClass('btn btn-primary btn-sm text-white')
                            $('#uploadlab').removeClass('btn btn-primary btn-sm text-white')
                            $('#planning').removeClass('btn btn-primary btn-sm text-white')
                            $('#followup').removeClass('btn btn-primary btn-sm text-white')
                            break;
                        }
                          case 'uploadlab': {
                            $('#client_div').css('display','none')
                            $('#onboarding_div').css('display','none')
                            $('#observation_div').css('display','none')
                            $('#measurement_div').css('display','none')
                            $('#upload_lab_div').css('display','block')
                            $('#planning_div').css('display','none')
                            $('#follow_up_div').css('display','none')
                            $('#client').removeClass('btn btn-primary btn-sm text-white')
                            $('#onboarding').removeClass('btn btn-primary btn-sm text-white')
                            $('#observation').removeClass('btn btn-primary btn-sm text-white')
                            $('#measurement').removeClass('btn btn-primary btn-sm text-white')
                            $('#uploadlab').addClass('btn btn-primary btn-sm text-white')
                            $('#planning').removeClass('btn btn-primary btn-sm text-white')
                            $('#followup').removeClass('btn btn-primary btn-sm text-white')
                            break;
                        }
                          case 'planning': {
                            $('#client_div').css('display','none')
                            $('#onboarding_div').css('display','none')
                            $('#observation_div').css('display','none')
                            $('#measurement_div').css('display','none')
                            $('#upload_lab_div').css('display','none')
                            $('#planning_div').css('display','block')
                            $('#follow_up_div').css('display','none')
                            $('#client').removeClass('btn btn-primary btn-sm text-white')
                            $('#onboarding').removeClass('btn btn-primary btn-sm text-white')
                            $('#observation').removeClass('btn btn-primary btn-sm text-white')
                            $('#measurement').removeClass('btn btn-primary btn-sm text-white')
                            $('#uploadlab').removeClass('btn btn-primary btn-sm text-white')
                            $('#planning').addClass('btn btn-primary btn-sm text-white')
                            $('#followup').removeClass('btn btn-primary btn-sm text-white')
                            break;
                        }
                          case 'followup': {
                            $('#client_div').css('display','none')
                            $('#onboarding_div').css('display','none')
                            $('#observation_div').css('display','none')
                            $('#measurement_div').css('display','none')
                            $('#upload_lab_div').css('display','none')
                            $('#planning_div').css('display','none')
                            $('#follow_up_div').css('display','block')
                            $('#client').removeClass('btn btn-primary btn-sm text-white')
                            $('#onboarding').removeClass('btn btn-primary btn-sm text-white')
                            $('#observation').removeClass('btn btn-primary btn-sm text-white')
                            $('#measurement').removeClass('btn btn-primary btn-sm text-white')
                            $('#uploadlab').removeClass('btn btn-primary btn-sm text-white')
                            $('#planning').removeClass('btn btn-primary btn-sm text-white')
                            $('#followup').addClass('btn btn-primary btn-sm text-white')
                            break;
                        }
                        case 'reviews': {
                            $('#client_div').css('display','none')
                            $('#onboarding_div').css('display','none')
                            $('#observation_div').css('display','none')
                            $('#measurement_div').css('display','none')
                            $('#upload_lab_div').css('display','none')
                            $('#planning_div').css('display','none')
                            $('#follow_up_div').css('display','none')
                            $('#reviews_div').css('display','block')
                            $('#client').removeClass('btn btn-primary btn-sm text-white')
                            $('#onboarding').removeClass('btn btn-primary btn-sm text-white')
                            $('#observation').removeClass('btn btn-primary btn-sm text-white')
                            $('#measurement').removeClass('btn btn-primary btn-sm text-white')
                            $('#uploadlab').removeClass('btn btn-primary btn-sm text-white')
                            $('#planning').removeClass('btn btn-primary btn-sm text-white')
                            $('#followup').removeClass('btn btn-primary btn-sm text-white')
                            $('#reviews').addClass('btn btn-primary btn-sm text-white')
                            break;
                        }
                        
                       }
                    }
                    </script>
            </div>
        
@endsection