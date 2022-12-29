@extends('layouts.app',[
    'activeName' => "Home"
])

@section('content')
<div class="py-6" style="width: 100%;">
        <div class="col-md-12">
            <div class="card bg-card">

                <div class="card-body">
        
                        <div class="row ">
                        <div class="col-md-6">
                         <h2>DASHBOARD</h2>
                        </div>

                   <div class="row">
            <div class="card" style="margin: 5px 0px 0px 15px;width:48%;padding:10px;">
                <canvas id="canvas"></canvas>
            </div>
               <div class="card" style="margin: 5px 0px 0px 15px;width:48%;padding:10px;">
                <canvas id="canvas2"></canvas>
            </div>
                   </div>
            <br/>
            <div class="row">
                <div class="table-responsible">
                    <table class="table table-striped table-sm">
                        <thead >
                            <tr>
                                <th scope="col">NAME</th>
                                <th scope="col">PHONE</th>
                                <th scope="col">DUE DATE</th>
                                <th scope="col">STATUS</th>
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
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
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
    <script>
        var month = <?php echo json_encode($month); ?>;
        var client = <?php echo json_encode($client); ?>;
        var year = <?php echo json_encode($year); ?>;
        var yearUser = <?php echo json_encode($yearUser); ?>;
        var config = {
            type: 'line',
            data: {
                labels: month,
                datasets: [{
                    label: 'Enquiry Details',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: client,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Enquiry Details Month Bar'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 50
                        }
                    }]
                }
            }
        };
        var barChartData = {
            labels: year,
            datasets: [{
                label: 'Enquiry Details',
                backgroundColor: "#0ad",
                data: yearUser
            }
            ]
        };
        window.onload = function () {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
            var barchart = document.getElementById("canvas2").getContext("2d");
            window.myBar = new Chart(barchart, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Enquriy Details Year Bar'
                    }
                }
            });
        };
    </script>
@endsection


@endsection