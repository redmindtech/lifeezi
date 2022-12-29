@extends('layouts.app',[
    'activeName' => 'Observation'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-3">
                         <h2>OBSERVATION</h2>
                        </div>
                            <div class="col-md-9 float-right">
                            <a href="{{ route('observation.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                    @if(count($observations) >= 7)
                    <div class="row py-3">
                        
                        <div class="col-md-9 float-right">
                            <span>For Observation for 7 days or more</span>
                            <a href="{{ route('observation.observationList',$data['client']['id']) }}" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                    @endif
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="customer_datatable">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>DAY OF OBSERVATION</th>
                                    <th>WAKEUPTIME</th>
                                    <th>BEDTIME</th>
                                    <th>SHOW</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                   </div>
                </div>
            </div>
        </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

                function deleteObservation(id){
        if(confirm('Are you want to remove the Observation Details?')) {
            $.ajax({
               method:'DELETE',
               url: `observation/${id}`,
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                  alert(data);
                    window.location.reload();
               }
            });
        }
        }
    </script>
    <script>
        let dataTable = $('#customer_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('getClientObservation', $data['client']['id']) }}",
            },
            columns: [
                {data: 'date', name: 'date', searchable: true},
                {data: 'day_of_observation', name: 'day_of_observation', searchable: true},
                {data: 'wake_up_time', name: 'wake_up_time', searchable: true},
                {data: 'bed_time', name: 'wake_up_time', searchable: true},
                {data: 'show', name: 'show', searchable: true},
                {data: 'edit', name: 'edit', searchable: false},
                {data: 'delete', name: 'delete', searchable: false},
            ],
            order: [[0, 'desc']],
            "oLanguage": {
                "sSearch": "<span>Search:</span> _INPUT_", //search
            },
        });

        $('#customer_datatable_wrapper').css("padding-right", "30px");
        $('.dataTables_filter input').attr("placeholder", "Enter observstion here");
        $('.dataTables_filter input').css("border", '2px solid #999');
        $('.dataTables_filter input').css("padding", '4px');


    </script>


@endsection