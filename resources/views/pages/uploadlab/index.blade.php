@extends('layouts.app',[
    'activeName' => 'UploadLab'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Upload Lab Reports</h2>
                        </div>
                    </div>
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="customer_datatable">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>SEX</th>
                                    <th>PHONE</th>
                                    <th>OBJECTIVES</th>
                                    <th>UPLOAD LAB</th>
                                    <th>VIEW</th>
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

    </script>
    <script>
        let dataTable = $('#customer_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('getUploadData') }}",
            },
            columns: [
                {data: 'name', name: 'name', searchable: true},
                {data: 'sex', name: 'sex', searchable: true},
                {data: 'phone', name: 'phone', searchable: true},
                {data: 'plan', name: 'plan', searchable: true},
                {data: 'uploadlab', name: 'uploadlab', searchable: true},
                {data: 'view', name: 'view', searchable: false},
            ],
            order: [[0, 'desc']],
            "oLanguage": {
                "sSearch": "<span>Search:</span> _INPUT_", //search
            },
        });

        $('#customer_datatable_wrapper').css("padding-right", "30px");
        $('.dataTables_filter input').attr("placeholder", "Enter customer here");
        $('.dataTables_filter input').css("border", '2px solid #999');
        $('.dataTables_filter input').css("padding", '4px');


    </script>


@endsection