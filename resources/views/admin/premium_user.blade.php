@extends('layouts.admin_style')

@section('content')
<div class="col-md-2"></div>
<div class="col-md-6">
@if(Session::has('delete_user'))
<div class="alert alert-danger">{{ Session::get('delete_user')}}</div>
@endif
@if(Session::has('update_user'))
<div class="alert alert-success">{{ Session::get('update_user')}}</div>
@endif
<table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Admin</th>
        <th>Premium</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
      <tr>
        <td>{{ $item->name}}</td>
        <td>{{ $item->email}}</td>
        <td>{{ $item->isAdmin}}</td>
        <td>{{ $item->isPremium}}</td>
        <td>
        <a href="{{ url('update_user_page/'.$item->id)}}"><button type="button" class="btn btn-info">Update</button></a>
        <a href="{{ url('delete_user/'.$item->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
        </td>
      </tr>
  @endforeach
    </tbody>
  </table>

</div>


@endsection