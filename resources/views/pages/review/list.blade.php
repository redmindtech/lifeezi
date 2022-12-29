@extends('layouts.app',[
    'activeName' => 'Review'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>REVIEW</h2>
                        </div>
                                <div class="col-md-6 float-right">
                            <a href="{{ route('review.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                    @include('include.client')
                    @include('include.onboarding')
                    @include('include.measurement')
                    @include('include.observations')
                    @include('include.uploadlab')
                    @include('include.planning')
                    @include('include.followups')
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="customer_datatable">
                            <thead>
                                <tr>
                                    <th>REVIEW DATE</th>
                                    <th>NEXT REVIEW DATE</th>
                                    <th>CLIENT PROGRESS</th>
                                    <th>DOWNLOAD</th>
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

        function deleteReview(id){
        if(confirm('Are you want to remove the Review Details?')) {
            var url = '{{ route("review.destroy", ":id") }}';
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
                url: "{{ route('getClientReview', $data['client']['id']) }}",
            },
            columns: [
                {data: 'review_date', name: 'review_date', searchable: true},
                {data: 'next_review_date', name: 'next_review_date', searchable: true},
                {data: 'client_progress', name: 'client_progress', searchable: true},
                {data: 'download', name: 'download', searchable: true},
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
        $('.dataTables_filter input').attr("placeholder", "Enter planning here");
        $('.dataTables_filter input').css("border", '2px solid #999');
        $('.dataTables_filter input').css("padding", '4px');
    </script>


@endsection