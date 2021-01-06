@extends('layouts.bootstrap_style')

@section('content')
<div class="jumbotron text-center">
  <h1>Home Page</h1>
</div>

<div class="container">
@if(Session::has('delete'))
<div class="alert alert-success">{{Session::get('delete')}}</div>
@endif
@if(Session::has('admin_error'))
<div class="alert alert-danger">{{Session::get('admin_error')}}</div>
@endif
@if(Session::has('premium_error'))
<div class="alert alert-danger">{{Session::get('premium_error')}}</div>
@endif
  <div class="row">
    <div class="col-sm-4">
      @foreach($data as $item)
      <img src="{{asset('photos/'.$item->new_photo)}}" width="300px" height="200px" style="margin-top:30px">
      <h3>{{ $item->new_title}}</h3>
      <a href="{{url('look_newInfo/'.$item->id)}}"><button type="button" class="btn btn-info">See More</button></a>
      
    </div>
    @endforeach
    </div>
</div>
<br><br><br>
@endsection
