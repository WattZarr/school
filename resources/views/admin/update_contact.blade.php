@extends('layouts.admin_style')

@section('content')
<div class="col-md-2"></div>
<div class="col-md-5">
@foreach($errors->all() as $error)
<div class="btn btn-danger">{{$error}}</div>
@endforeach
<form action="{{route('update_contact')}}" method="post">
@csrf
<input type="hidden" name="user_id" value="{{ $info->id}}">
        <legend>Update Contact</legend>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $info->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $info->email}}">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <input type="text" name="message" class="form-control" value="{{ $info->message}}">
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
        
</form>
<a href="{{ route('admin_contact') }}"><button type="submit" class="btn btn-warning">Back</button></a>
</div>
<div class="col-md-5"></div>
@endsection