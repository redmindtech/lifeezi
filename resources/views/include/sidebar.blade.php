<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark bg-sidebar" style="width: 250px;height:95vh;overflow:hidden;transition:.5s
 cubic-bezier(0.215, 0.610, 0.355, 1)">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{route('home')}}" class="nav-link bg-sidebar-link @if($activeName == 'Home') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-home"></i></span>
         <span class="bg-nav-p"> Home</span>    
        </a>
      </li>
      <details @if(in_array($activeName, MENUENQUIRY )) open @endif>
        <summary class="bg-nav-p summary md-3">
          <li class="nav-item">
          <a class="nav-link bg-sidebar-link @if(in_array($activeName, MENUENQUIRY )) active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-check-to-slot"></i></span>
          <span class="bg-nav-p">Enquiries<span>
          </li></a>
          </summary>
        <li class="nav-item">
        <a href="{{ route('client.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Enquiries') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-user-plus"></i></span>
         <span class="bg-nav-p">Enquiry Details</span>  
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('schedule.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Schedule Assessment') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-clock"></i></span>
         <span class="bg-nav-p">Schedule Assessment</span>  
        </a>
      </li>
          <li class="nav-item">
        <a href="{{ route('summary.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Summary') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-book"></i></span>
         <span class="bg-nav-p">Assessment Summary</span>  
        </a>
      </li>
      </details>

      <details @if(in_array($activeName, ENROLLMENT )) open @endif>
        <summary class="bg-nav-p summary md-3">
          <li class="nav-item">
          <a class="nav-link bg-sidebar-link @if(in_array($activeName, ENROLLMENT )) active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-scale-balanced"></i></span>
          <span class="bg-nav-p">Enrollment<span>
          </li></a>
          </summary>

      <li class="nav-item">
        <a href="{{ route('onboarding.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Onboarding') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-plane"></i></span>
         <span class="bg-nav-p">Onboarding</span>  
        </a>
      </li>
            <li class="nav-item">
        <a href="{{ route('observation.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Observation') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-tower-observation"></i></span>
         <span class="bg-nav-p">Observation</span>  
        </a>
      </li>
              <li class="nav-item">
        <a href="{{ route('planning.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Planning') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-ruler"></i></span>
         <span class="bg-nav-p">Planning</span>  
        </a>
      </li>
      </details>
      <details @if(in_array($activeName, FOLLOWUP )) open @endif>
        <summary class="bg-nav-p summary md-3">
          <li class="nav-item">
          <a class="nav-link bg-sidebar-link @if(in_array($activeName, FOLLOWUP )) active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-layer-group"></i></span>
          <span class="bg-nav-p"> Follow Up<span>
          </li></a>
          </summary>
                <li class="nav-item">
        <a href="{{ route('followup.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'FollowUp') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-layer-group"></i></span>
         <span class="bg-nav-p">Daily Follow Up</span>  
        </a>
      </li>
        <li class="nav-item">
        <a href="{{ route('upload.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'UploadLab') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-file"></i></span>
         <span class="bg-nav-p">Upload Lab Report</span>  
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('measurement.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Measurement') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-weight-scale"></i></span>
         <span class="bg-nav-p">Measurements</span>  
        </a>
      </li>
            <li class="nav-item">
        <a href="{{ route('disengagement.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Disengagement') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-thumbs-down"></i></span>
         <span class="bg-nav-p">Disengagement</span>  
        </a>
      </li>
                  <li class="nav-item">
        <a href="{{ route('reports.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Reports') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-file-code"></i></span>
         <span class="bg-nav-p">Reports</span>  
        </a>
      </li>
             <li class="nav-item">
        <a href="{{ route('review.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Review') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa  fa-magnifying-glass"></i></span>
         <span class="bg-nav-p">Reviews</span>  
        </a>
      </li>
      </details>

           <details @if(in_array($activeName, HR )) open @endif>
        <summary class="bg-nav-p summary md-3">
          <li class="nav-item">
          <a class="nav-link bg-sidebar-link @if(in_array($activeName, HR )) active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-mug-hot"></i></span>
          <span class="bg-nav-p">HR<span>
          </li></a>
          </summary>

        <li class="nav-item">
        <a href="{{ route('employee.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Employee') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-people-group"></i></span>
         <span class="bg-nav-p"> Employee</span>  
        </a>
      </li>
        <li class="nav-item">
        <a href="{{ route('payment.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'ClientPaymentFee') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-credit-card"></i></span>
         <span class="bg-nav-p"> Client Payment Fee</span>  
        </a>
      </li>
        <li class="nav-item">
        <a href="{{ route('expense.index')}}" class="nav-link details bg-sidebar-link @if($activeName == 'Expenses') active @endif" aria-current="page">
          <span class="ml-3">
          <i class="fa fa-money-bill"></i></span>
         <span class="bg-nav-p">Expenses</span>  
        </a>
      </li>
    </details>
    </ul>
    <div style="font-size:13px">Powered by <a href="https://redmindtechnologies.com/"  target="_blank" style="text-decoration: none;color:red" target="_blank">{{__("RedMind Technologies")}}</a>
</div>
  </div>