@extends('layouts.app',[
    'activeName' => 'ClientPaymentFee'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>CLIENT PAYMENT FEE</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('payment.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>
                     @include('include.client')
                    @include('include.onboarding')
                   <div class="row">
                    <div class="col-md-12">
                        @if($clientPayment)
                        <form enctype="multipart/form-data" class="form-group" method="POST"  action="{{ route('payment.update', ($clientPayment ?? null))}}" >
                            @method('PATCH')
                            @csrf
                            <input type="hidden" style="display: none" name="client_id" value="{{ $clientPayment->client->id}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Payment Date<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <input type="text" class="form-control" name="payment_date" readonly value="{{old('payment_date') ?? $clientPayment->payment_date}}"/>
                                    @if($errors->has('payment_date'))
                                            <div class="error">{{ $errors->first('payment_date') }}</div>
                                  @endif
                                </div>
                                         <div class="col-md-6">
                                    <label for="mobile" class="form-label">Status<a
                                                    style="text-decoration: none;color:red">*</a></label>
                                    <select class="form-control" name="payment_status">
                                        <option value="pending" @if((old('payment_status') ?? $clientPayment->payment_status) === 'pending') selected @endif>Pending</option>
                                         <option value="completed" @if((old('payment_status') ?? $clientPayment->payment_status) === 'completed') selected @endif>Completed</option>
                                    </select>
                                @if($errors->has('payment_status'))
                                    <div class="error">{{ $errors->first('payment_status') }}</div>
                                 @endif
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="button"  class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection