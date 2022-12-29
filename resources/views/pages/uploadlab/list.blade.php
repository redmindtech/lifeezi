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
                         <h2>UPLOAD LAB REPORTS</h2>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="customer_datatable">
                            <thead>
                                <tr>
                                    <th>TEST DATE</th>
                                    <th>NEXT TEST DATE</th>
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

        function deleteUpload(id){
        if(confirm('Are you want to remove the Upload Lab Details?')) {
            var url = '{{ route("upload.destroy", ":id") }}';
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
                url: "{{ route('getClientUpload', $data['client']['id']) }}",
            },
            columns: [
                {data: 'test_date', name: 'test_date', searchable: true},
                {data: 'next_test_date', name: 'next_test_date', searchable: true},
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
        $('.dataTables_filter input').attr("placeholder", "Enter uploadlab reports here");
        $('.dataTables_filter input').css("border", '2px solid #999');
        $('.dataTables_filter input').css("padding", '4px');


    </script>


@endsection