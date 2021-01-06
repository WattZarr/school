@extends('layouts.admin_style')

@section('content')
<div class="col-md-2"></div>
<div class="col-md-5">
 @foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach 
@if(Session::has('validation_error'))
<div class="alert alert-danger">{{ Session::get('validation_error')}}</div>
@endif
<form action="{{ route('update_user') }}" method="post">
@csrf
<input type="hidden" name="user_id" value="{{ $data->id}}">
        <legend>Update Premium User</legend>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $data->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $data->email}}">
        </div>
        <div class="form-group">
            <label for="isAdmin">isAdmin</label>
            <input type="text" name="isAdmin" class="form-control" value="{{ $data->isAdmin}}">
        </div>
        <div class="form-group">
            <label for="isPremium">isPremium</label>
            <input type="text" name="isPremium" class="form-control" value="{{ $data->isPremium}}">
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
        
</form>
<a href="{{ route('manage_premium') }}"><button type="submit" class="btn btn-warning">Back</button></a>
</div>
<div class="col-md-5"></div>
@endsection