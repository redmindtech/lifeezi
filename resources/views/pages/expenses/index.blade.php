@extends('layouts.app',[
    'activeName' => 'Expenses'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>EXPENSES</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('expense.create')}}"
                            class="btn btn-primary" style="float:right">+ ADD</a>
                        </div>
                    </div>
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="customer_datatable">
                            <thead>
                                <tr>
                                    <th>EXPENSES DATE</th>
                                    <th>AMOUNT</th>
                                    <th>EXPENSES TYPE</th>
                                    <th>PAID TO</th>
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
  

         function deleteExpenses(id){
        if(confirm('Are you want to remove the Expenses Details?')) {
            var url = '{{ route("expense.destroy", ":id") }}';
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
                url: "{{ route('getExpenses') }}",
            },
            columns: [
                {data: 'expense_date', name: 'expense_date', searchable: true},
                {data: 'amount', name: 'amount', searchable: true},
                {data: 'expense_type', name: 'expense_type', searchable: true},
                {data: 'paid_to', name: 'paid_to', searchable: true},
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
        $('.dataTables_filter input').attr("placeholder", "Enter expenses here");
        $('.dataTables_filter input').css("border", '2px solid #999');
        $('.dataTables_filter input').css("padding", '4px');



    </script>




@endsection