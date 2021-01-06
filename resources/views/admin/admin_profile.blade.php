@extends('layouts.admin_style')

@section('content')
<div class="col-md-2"></div>
<div class="col-md-5">
@if(Session::has('update_admin'))
<div class="alert alert-success">{{ Session::get('update_admin')}}</div>
@endif
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{ $error}}</div>
@endforeach
@if(Session::has('password'))
<div class="alert alert-danger">{{ Session::get('password')}}</div>
@endif
@if(Session::has('password_success'))
<div class="alert alert-success">{{ Session::get('password_success')}}</div>
@endif
<form action="{{route('update_admin_info')}}" method="post">
@csrf
<input type="hidden" name="id" value="{{ $data->id }}">
        <legend>Admin account</legend>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Your name" value="{{ $data->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Your email" value="{{ $data->email}}">
        </div>
        <a href="" data-toggle="modal" data-target="#mypassword">Change Password</a><br><br>
        <button type="submit" class="btn btn-info">Update Info</button>
        </form>
        <!-- for password -->
<div class="modal" id="mypassword">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('update_admin_password')}}" method="post">
        @csrf
            <div class="form-group">
                <label for="old_password">Old password</label>
                <input type="text" class="form-control" name="old_password" placeholder="Your old password">
            </div>
            <div class="form-group">
                <label for="new_password">New password</label>
                <input type="text" class="form-control" name="new_password" placeholder="Your new password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input type="text" class="form-control" name="confirm_password" placeholder="Retype New password">
            </div>
            
            <button type="submit" class="btn btn-info">Change Password</button>
        </form>
        <br>
      </div>


    </div>
  </div>
</div>
<!-- close password -->
</div>


@endsection