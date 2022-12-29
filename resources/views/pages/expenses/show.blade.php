@extends('layouts.app',[
    'activeName' => 'Expenses'
])

@section('content')
<div class="py-3" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>EXPENSES</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('expense.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                   <div class="row">
                    <div class="col-md-12">
                        @if($expense)
                        <form enctype="multipart/form-data" class="form-group" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expenses_date" >Expense Date</label>
                                    <p>{{dateFormat($expense->expenses_date ?? old('expenses_date'))}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="amount" >Amount</label>
                                    <p>{{ $expense->amount ?? old('amount')}}</p>
                                </div>
                                </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <label for="expenses_type" >Expense Type</label>
                                    <p>{{ ucfirst($expense->expenses_type ?? old('expenses_type'))}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="paid_to" >Paidto</label>
                                    <p>{{$expense->paid_to ?? old('paid_to')}}</p>
                                </div>
                            </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <label for="comments" >Comments</label>
                                    <p>{{ $expense->comments}}</p>
                                </div>
                               </div>
                            <hr/>
                        </form>
                        @endif
                    </div>
                   </div>
                </div>
            </div>
        </div>        
@endsection