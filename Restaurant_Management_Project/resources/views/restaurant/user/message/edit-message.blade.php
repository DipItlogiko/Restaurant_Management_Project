@extends('restaurant.user.layouts.master')


@section('title')
    edit-message
@endsection


@section('body')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
        <div class="card text-black border-0" >
            <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 pt-md-4 mt-md-5">                   
 
                    <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 mt-md-5 pt-md-5 text-light font">Edit<span style="color: #ffb03b">Message</span></h2> 
                

                 <form  method="POST" action="{{ route('message.edit',$specificMessage->id) }}" class=" mx-md-4" enctype="multipart/form-data">
                    @csrf
                    @method('patch') <!-------amra jokhon kono datake update korbo tokhon amra ai patch method ta use korbo ai patch method ta use korle laravel autometically bujhe jai je amader ai data ta update korte hobe tai amra kono data update korar jonno patch method ta use korbo--->
  
                    <span class="text-danger">
                        @error('message')
                          {{ $message }}
                        @enderror
                    </span>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">                                                       
                            <textarea id="form3Example3c" name="message" class="form-control bg-dark text-warning"  required>{{ old('message', $specificMessage->message) }}</textarea>
                            <label class="form-label text-light" for="form3Example3c">Message</label>
                        </div>
                    </div>      

              
                    

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button  type="submit" style="background-color: #ffb03b; border-radius: 40px;" class="text-light p-2 px-3 btn-danger">Re-Send</button>
                    </div>

                </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="assets/img/re-send-message.png"
                    class="img-fluid" alt="Sample image">  

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div> 
@endsection