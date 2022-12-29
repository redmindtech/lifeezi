@extends('layouts.app',[
    'activeName' => 'Onboarding'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>ONBOARDING</h2>
                        </div>
                    </div>
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>ONBOARDING DATE</th>   
                                    <th>SHOW</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>     
                                </tr>
                            </thead>
                            <tbody>
                                @if($onboardings)
                                @foreach ($onboardings as $onboarding )

                                    <tr>
                                        <td>{{ $onboarding->client->client_name }}</td>
                                        <td>{{ dateFormat($onboarding->onboarding_date) }}</td>
                                        <td><a href="{{route('onboarding.show', $onboarding)}}" class="btn btn-primary">
                                            <i class="fa fa-eye "></i>
                                        </a></td>  
                                        <td><a href="{{route('onboarding.edit', $onboarding)}}" class="btn btn-success">
                                            <i class="fa fa-user-pen"></i>
                                        </a></td>
                                        <td><form method="POST"  onsubmit="return confirm('Are you sure want to delete the onboarding?')" action="{{ route('onboarding.destroy', $onboarding) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <div class="form-group">
                                                  <button class="btn btn-danger" type="submit">
                                                  <i class="fa fa-trash "></i>
                                                  </a>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                         <span>{{$onboardings->links()}}</span>
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection