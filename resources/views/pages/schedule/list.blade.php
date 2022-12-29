@extends('layouts.app',[
    'activeName' => 'Schedule Assessment'
])

@section('content')
<div class="py-6" style="width: 100%;margin:0px;">
        <div class="col-md-12">
            <div class="card bg-card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                         <h2>Schedule Assessment</h2>
                        </div>
                        <div class="col-md-6 float-right">
                            <a href="{{ route('schedule.index')}}"
                            class="btn btn-primary" style="float:right">BACK</a>
                        </div>
                    </div>

                    
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>SCHEDULE</th>
                                    <th>SHOW</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($clients)
                                @foreach ($clients as $client )
                                    <tr>
                                        <td>{{$client->id}}</td>
                                        <td>{{$client->client_name}}</td>
                                        <td>{{dateFormat($client->schedule_assement->schedule_date_time)}}</td>
                                        <td><a href="{{route('schedule.show', $client->schedule_assement->id)}}" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a></td>  

                                        <td><a href="{{route('schedule.edit', $client->schedule_assement->id)}}" class="btn btn-success">
                                            <i class="fa fa-user-pen "></i>
                                        </a></td>
                                        <td><form method="POST"  onsubmit="return confirm('Are you sure want to delete the schedule?')" action="{{ route('schedule.destroy',$client->schedule_assement->id) }}">
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
                         <span>{{$clients->links()}}</span>
                    </div>
                   </div>
                </div>
            </div>
        </div>
@endsection