@extends('layouts.admin_style')

@section('content')
<div class="col-md-2"></div>
<div class="col-md-6">
@if(Session::has('delete_success'))
<div class="alert alert-success">{{Session::get('delete_success')}}</div>
@endif
@if(Session::has('update_success'))
<div class="alert alert-success">{{Session::get('update_success')}}</div>
@endif

<table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $item)
      <tr>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->message}}</td>
        <td>
        <a href="{{url('update_contact_page/'.$item->id)}}"><button type="button" class="btn btn-info">Update</button></a>
        <a href="{{ url('delete_contact/'.$item->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
        </td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
</
</div>


@endsection