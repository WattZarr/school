@extends('layouts.bootstrap_style')

@section('content')
<div class="container">
    <div class="col-md-5">
    <img src="{{asset('photos/'.$data[0]->new_photo)}}" width="100%" height="370px">
    @foreach($errors->all() as $error)
      <div class="alert alert-danger" style="margin-botton:10px">{{ $error}}</div>
    @endforeach
    </div>

    <div class="col-md-5">
    <h1>{{ $data[0]->new_title}}</h1>
    <h3>(Posted by {{ $data[0]->name }})</h3>
    <legend></legend>
    <p style="font-size:20px">{{$data[0]->new_content}}</p>
    </div>
    @if(Session::has('update'))
    <div class="alert alert-success">{{Session::get('update')}}</div>
    @endif

    
    <div class="col-md-1">
    <button class="btn btn-info" data-toggle="modal" data-target="#myUpdate">Edit</button><br><br>
  <button class="btn btn-danger" data-toggle="modal" data-target="#myDelete">Delete</button><br><br>
    <a href="{{route('user_homepage')}}"><button class="btn btn-warning">Back</button></a>
    </div>
   
</div>

<!-- for delete -->
<div class="modal" id="myDelete">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Are you sure to delete?</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <button class="btn btn-primary" style="width:100px; font-size:20px" data-dismiss="modal">No</button>
        <a href="{{ url('delete_news/'.$data[0]->id)}}"><button class="btn btn-success" style="width:100px; font-size:20px">Yes</button></a> 
      </div>


    </div>
  </div>
</div>
<!-- close delete -->

<!-- for edit -->
<div class="modal" id="myUpdate">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <img src="{{asset('photos/'.$data[0]->new_photo)}}" style="width:100px">
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('update_news') }}" method="post" enctype="multipart/form-data">
        @csrf
            <input type="hidden" value="{{$data[0]->id}}" name="id">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" value="{{$data[0]->new_title}}" name="new_title">
            </div>
            <div class="form-group">
                <label>Photo</label>
                <input type="file" class="form-control" value="{{$data[0]->new_photo}}" name="new_photo">
            </div>
            <div class="form-group">
                <label>Content</label>
                <input type="text" class="form-control" value="{{$data[0]->new_content}}" name="new_content">
            </div>
            
            <button type="submit" class="btn btn-info">Save</button>
        </form>
        <br>
      </div>


    </div>
  </div>
</div>
<!-- close edit -->
@endsection
