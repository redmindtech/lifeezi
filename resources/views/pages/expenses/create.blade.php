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
                            <a href="{{ route('expense.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                   <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" onsubmit=handleSubmit() class="form-group" method="POST" action="{{ route('expense.store')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expenses_date" class="form-label">Expense Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="date" class="form-control" name="expenses_date" value="{{old('expenses_date') ?? \Carbon\Carbon::today()->format('Y-m-d')}}"/>
                                    @if($errors->has('expenses_date'))
                                            <div class="error">{{ $errors->first('expenses_date') }}</div>
                                  @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="amount" class="form-label">Amount<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="number"class="form-control" name="amount" value="{{old('amount') ?? ''}}"/>
                                @if($errors->has('amount'))
                                    <div class="error">{{ $errors->first('amount') }}</div>
                                 @endif
                                </div>
                            </div>
                                 
                
                            <div class="row">
                               
                                <div class="col-md-6">
                                    <label for="expenses_type" class="form-label">Expense Type<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select name="expenses_type" id="expenses_type" class="form-control" onchange=onChangeOthers()>
                                      <option value =''>--- Select any one option ---</option>
                                      <option @if(old('expenses_type') == 'salary') selected @endif value ="salary">Salary</option> 
                                    </select>
                                
                                 @if($errors->has('expenses_type'))
                                    <div class="error">{{ $errors->first('expenses_type') }}</div>
                                 @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="paid_to" class="form-label">Paid To<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text" class="form-control" name="paid_to" value="{{old('paid_to') ?? ''}}"/>
                                @if($errors->has('paid_to'))
                                            <div class="error">{{ $errors->first('paid_to') }}</div>
                                  @endif
                                </div>
                            </div>
                                

                               <div class="row">
                                <div class="col-md-12">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea name="comments" class="form-control">{{old('comments') ?? ''}}</textarea>
                                </div>
                               </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                         <script type="text/javascript">
           function handleSubmit(){
             $('#button').attr('disabled',true)
           }
           </script>
                    </div>
                   </div>
                </div>
            </div>
    
        </div>
@endsection