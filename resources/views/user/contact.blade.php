@extends('layouts.bootstrap_style')

@section('content')
<div class="col-md-7">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118427.04428149297!2d96.00578310360139!3d21.940504298280747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb6d23f0d27411%3A0x24146be01e4e5646!2sMandalay!5e0!3m2!1sen!2smm!4v1601008302739!5m2!1sen!2smm" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<div class="col-md-4">
<form action="{{ route('insert_contact')}}" method="post">
@csrf
@if(Session::has('success'))
<div class="alert alert-success">
<strong>{{Session::get('success')}}</strong>
</div>
@endif

@foreach($errors->all() as $error)
  <div class="alert alert-danger">{{$error}}</div>
@endforeach
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Your name" name="name">
  </div>
  <div class="form-group">
    <input type="email" class="form-control" placeholder="Your email" name="email">
  </div>
  <div class="form-group">
    <textarea class="form-control" rows="5" placeholder="Your message" name="message"></textarea>
  </div>
  
  <button type="submit" class="btn btn-info">Submit</button>
</form>
</div>
@endsection