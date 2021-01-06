@extends('layouts.bootstrap_style')

@section('content')

<div class="col-md-7">
        <form action="{{route('update_account')}}" method="post">
        @csrf
        <legend>User account</legend>
        @if(Session::has('success'))
        <div class="alert alert-success">
        <strong>{{Session::get('success')}}</strong>
        </div>
        @endif

        @if(Session::has('update_success'))
        <div class="alert alert-success">
        <strong>{{Session::get('update_success')}}</strong>
        </div>
        @endif

        @if(Session::has('password'))
        <div class="alert alert-danger">
        <strong>{{Session::get('password')}}</strong>
        </div>
        @endif

        @if(Session::has('password_success'))
        <div class="alert alert-success">
        <strong>{{Session::get('password_success')}}</strong>
        </div>
        @endif

        @foreach($errors->all() as $error)
          <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        <div class="form-group">
        <input type="hidden" name="user_id" value="{{ $data->id }}">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Your name" value="{{ $data->name }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Your email" value="{{ $data->email }}">
        </div>
        <a href="" data-toggle="modal" data-target="#mypassword">Change Password</a><br><br>
        <button type="submit" class="btn btn-info">Change Account Info</button>
        </form>
</div>
<div class="col md-3">


<div class="col md-2">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Add new
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create News</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{route('insert_news')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Your title" name="new_title">
            </div>
            <div class="form-group">
                <label>Photo</label>
                <input type="file" class="form-control" placeholder="Your photo" name="new_photo">
            </div>
            <div class="form-group">
                <label>Content</label>
                <input type="text" class="form-control" placeholder="Your content" name="new_content">
            </div>
            
            <button type="submit" class="btn btn-info">Create</button>
        </form>
        <br>
      </div>


    </div>
  </div>
</div>
</div><!-- close col md 2 -->
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
        <form action="{{ route('change_password') }}" method="post">
        @csrf
            <div class="form-group">
                <label for="old_password">Old password</label>
                <input type="password" class="form-control" name="old_password" placeholder="Your old password">
            </div>
            <div class="form-group">
                <label for="new_password">New password</label>
                <input type="password" class="form-control" name="new_password" placeholder="Your new password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Your confirm password">
            </div>
            
            <button type="submit" class="btn btn-info">Save</button>
        </form>
        <br>
      </div>


    </div>
  </div>
</div>
<!-- close password -->
</div>
@endsection
