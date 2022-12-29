@extends('layouts.app',[
    'activeName' => 'Measurement'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                        <div class="row ">
                     <div class="col-md-6">
                         <h2>Measurement</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('measurement.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="customer_datatable">
                            <thead>
                                <tr>
                                    <th>MEASUREMENT DATE</th>
                                    <th>NEXT MEASUREMENT DATE</th>
                                    <th>COMMENTS</th>
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

        function deleteMeasurement(id){
        if(confirm('Are you want to remove the Measurement Details?')) {
            var url = '{{ route("measurement.destroy", ":id") }}';
            let apiUrl = url.replace(':id', id);
            $.ajax({
               method:'DELETE',
               url: apiUrl ,
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
                url: "{{ route('getClientMeasurement', $data['client']['id']) }}",
            },
            columns: [
                {data: 'measurement_date', name: 'measurement_date', searchable: true},
                {data: 'next_measurement_date', name: 'next_measurement_date', searchable: true},
                {data: 'comments', name: 'comments', searchable: true},
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
        $('.dataTables_filter input').attr("placeholder", "Enter measurement here");
        $('.dataTables_filter input').css("border", '2px solid #999');
        $('.dataTables_filter input').css("padding", '4px');


    </script>


@endsection