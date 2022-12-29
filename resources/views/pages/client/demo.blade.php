@extends('layouts.app',[
    'activeName' => 'Enquiries'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Enquiries</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('client.create')}}"
                            class="btn btn-primary" style="float:right">+ ADD</a>
                        </div>
                    </div>
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="customer_datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>SEX</th>
                                    <th>PLAN</th>
                                    <th>EMAIL</th>
                                    <th>JOURNEY</th>
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
    </script>
    <script>
        let dataTable = $('#customer_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('getClient') }}",
            },
            columns: [
                {data: 'id', name: 'id', searchable: false},
                {data: 'name', name: 'name', searchable: true},
                {data: 'sex', name: 'sex', searchable: true},
                {data: 'plan', name: 'plan', searchable: true},
                {data: 'email', name: 'email', searchable: false},
                {data: 'journey', name: 'journey', searchable: true},
                {data: 'show', name: 'show', searchable: false},
                {data: 'edit', name: 'edit', searchable: false},
                {data: 'delete', name: 'delete', searchable: false}
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