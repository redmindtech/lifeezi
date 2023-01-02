@extends('layouts.app',[
    'activeName' => "Home"
])

@section('content')
<div class="py-6" style="width: 100%;">
    <style>
        .glow {
    color:#fff;
    text-align: center;
    position: absolute;
    top:12px;
    right:20px;
    padding:15px 20px;
    border:2px solid #0ad;
    border-radius:48%;
    box-shadow:2px 2px 50px #999;
    background: linear-gradient(to left,#0ad,rgb(27, 27, 168));
}
dialog{
   
    width: 1000px;
    outline: none;
    border: none;
    border-radius: 8px;
    box-shadow: 2px -7px 15px #999;
    border: 2px solid #0af;
    
}
    </style>
        <div class="col-md-12">
            <div class="card bg-card" style="height: 90vh;">

                <div class="card-body">
        
                       <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="padding:20px 0 0 20px;">Dashboard</h1>
                </div>
            </div>
            <div class="row" style="padding:20px;">
                <div class="col-md-4">
                    <div class="card hover" onclick=handlePayment('open') style="height:100px;padding:10px;box-shadow:5px 5px 15px #999;width:90%;cursor: pointer;">
                        <h5>Payment</h5>
                        <span class="glow">
        <i class="fas fa-credit-card fa-3x"></i>
        </span>
                        <h1 style="margin: 2px 10px;">{{count($clientPayments)}}</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card hover" onclick=handleDilemma('open') style="height:100px;padding:10px;box-shadow:5px 5px 15px #999;width:90%;cursor: pointer;">
                        <h5>Dilemma</h5>
                        <span class="glow">
        <i class="fas fa-book fa-3x"></i>
        </span>
                        <h1 style="margin: 2px 10px;">{{count($InDilemma)}}</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card hover" onclick=handleFollowUp('open') style="height:100px;padding:10px;box-shadow:5px 5px 15px #999;width:90%;cursor: pointer;">
                        <h5>Follow-up</h5>
                        <span class="glow">
        <i class="fas fa-layer-group fa-3x"></i>
        </span>
                        <h1 style="margin: 2px 10px;">{{count($followUps)}}</h1>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="card hover" style="height:100px;padding:10px;box-shadow:5px 5px 15px #999;width:90%">
                        <h5>Comments</h5>
                        <span class="glow">
        <i class="fas fa-comment fa-3x "></i>
        </span>
                        <h1 style="margin: 10px;"></h1>
                    </div>
                </div> --}}
            </div>
        </div>

                        </div>

                        <dialog  id="dilemma_modal">
                            @if(count($futureClients) > 0)
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span onclick=handleDilemma('close') style="float: right;background:red;padding:2px 8px;border-radius:50%;cursor: pointer;">
                                      <i class="fa fa-xmark"></i>
                                        </span>
                                    </div>
                                </div>
                                <h4>IN DILEMMA</h4>
                                <div class="table-responsible">
                                 <table class="table table-striped">
                                     <thead>
                                       <tr>
                                       <th scope="col">NAME</th>
                                        <th scope="col">SEX</th>
                                        <th scope="col">PRIMARY COMPLIANT</th>
                                        <th scope="col">PHONE</th>
                                        <th scope="col">EDIT</th>
                                        </tr>
                                      </thead> 
                                      @foreach($futureClients as $client)
                                      @if(($client->summary->summary_status ?? null) == 'InDilemma')
                                      <tbody>
                                        <tr>
                                            <td>{{$client->client_name}}</td>
                                            <td>{{ucfirst($client->sex)}}</td>
                                            <td>{{ucfirst(implode(' ', explode('_', $client->transformation_plan)))}}</td>
                                            <td>{{$client->mobile}}</td>
                                            <td><a href="{{ route('summary.edit', $client->summary->id) }}" class="btn btn-success"> <i class="fa fa-user-pen "></i></a></td>
                                        </tr>
                                      </tbody>
                                      @endif
                                      @endforeach
                                    </table>
                                </div>
                            </div>
                            @endif
                        </dialog>

                        <dialog  id="follow_up_modal">
                            @if(count($followUps) > 0)
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span onclick=handleFollowUp('close') style="float: right;background:red;padding:2px 8px;border-radius:50%;cursor: pointer;">
                                      <i class="fa fa-xmark"></i>
                                        </span>
                                    </div>
                                </div>
                                <h4>FOLLOW UP REMINDER</h4>
                                <div class="table-responsible">
                                 <table class="table table-striped">
                                     <thead>
                                       <tr>
                                       <th scope="col">NAME</th>
                                        <th scope="col">SEX</th>
                                        <th scope="col">PRIMARY COMPLIANT</th>
                                        <th scope="col">FOLLOWUP DATE</th>
                                        <th scope="col">EDIT</th>
                                        </tr>
                                      </thead> 
                                      @foreach($followUps as $followup)
                                      <tbody>
                                        <tr>
                                            <td>{{$followup->client->client_name}}</td>
                                            <td>{{ucfirst($followup->client->sex)}}</td>
                                            <td>{{ucfirst(implode(' ', explode('_', $followup->client->transformation_plan)))}}</td>
                                            <td>{{$followup->follow_date}}</td>
                                            <td><a href="{{ route('followup.edit', $followup)}}" class="btn btn-success"> <i class="fa fa-user-pen "></i></a></td>
                                        </tr>
                                      </tbody>
                                      @endforeach
                                    </table>
                                </div>
                            </div>
                            @endif
                        </dialog>
                        <script type="text/javascript">
                        function handleDilemma(val){
                          let dilemma_modal = document.getElementById('dilemma_modal');
                           if(val == 'open'){
                            dilemma_modal.open = true;
                           } else {
                            dilemma_modal.open = false;
                           }
                        }
                        function handlePayment(val){
                          let dilemma_modal = document.getElementById('payment_dialog');
                           if(val == 'open'){
                            dilemma_modal.open = true;
                           } else {
                            dilemma_modal.open = false;
                           }
                        }

                        function handleFollowUp(val){
                           let dilemma_modal = document.getElementById('follow_up_modal');
                           if(val == 'open'){
                            dilemma_modal.open = true;
                           } else {
                            dilemma_modal.open = false;
                           }
                        }
                        </script>
            <br/>
            <dialog  id="payment_dialog">
            <div class="container">
                   <div class="row">
                                    <div class="col-md-12">
                                        <span onclick=handlePayment('close') style="float: right;background:red;padding:2px 8px;border-radius:50%;cursor: pointer;">
                                      <i class="fa fa-xmark"></i>
                                        </span>
                                    </div>
                                </div>
                                <h4>CLIENT FEE REMAINDER</h4>
                <div class="table-responsible">
                    <table class="table table-striped table-sm">
                        <thead >
                            <tr>
                                <th scope="col">NAME</th>
                                <th scope="col">PHONE</th>
                                <th scope="col">DUE DATE</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">PAYMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($clientPayments) ?? null)
                            @foreach($clientPayments as $clientPayment)
                            <tr>
                            <th scope="row">{{$clientPayment->client->client_name}}</th>
                            <td>{{$clientPayment->client->mobile}}</td>
                            <td>{{$clientPayment->payment_date}}</td>
                            <td>{{$clientPayment->payment_status}}</td>
                            <td><a href="{{ route('payment.edit', $clientPayment->client) }}" class="btn btn-primary"><i class="fa fa-user-pen "></i> </a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            </dialog>
                   </div>
                </div>
            </div>
        @section('js_user_page')
    <script>
        $(document).ready(function () {
            $("#dashboard").addClass("active-li");
            $("#dash-span").addClass("icons");
        });
    </script>
    <script src="{{url('/js/admin/chart.min.js')}}"></script>
    <script src="{{ url('/js/admin/utils.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    
@endsection
@endsection