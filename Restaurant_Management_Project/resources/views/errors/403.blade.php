@extends('errors.layout')

@section('title')
 Forbidden
@endsection

@section('body')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center pt-md-5 mt-md-5">
      <div class="card border-0">
        <img src="403-Error.png" alt="Image" class="img-fluid">   <!----amader ai 403-Error.png image ta amader laravel application ar moddhe Public directory ar moddhe ache...--->
        <div class="card-body">            
            <h5 class="card-title font text-warning h2">This Action Is Unauthorized!!!</h5>
            <a href="{{ url('/') }}" class="btn btn-outline-warning">Go Back</a>
            <p class="card-text"><small class="text-muted">McDonald's</small></p>
        </div>
    </div> 
    </div>
    <div class="col-md-3"></div>
  </div>
@endsection
 
 
