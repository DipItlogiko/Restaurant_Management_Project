@extends('restaurant.layouts.master')

@section('title')
McDonald's-Register
@endsection

@section('body')

 
    <section class="vh-90 " style="background-image: url(assets/img/background.png)">
        <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
    
                     <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2">Sign<span style="color: #ffb03b">Up</span></h2> 
    
                     <form  method="POST" action="{{ route('register') }}" class=" mx-md-4" enctype="multipart/form-data">
                        @csrf
    
                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" id="form3Example1c" name="name" value="{{ old('name') }}" class="form-control text-warning" required/>
                            <label class="form-label" for="form3Example1c">Your Name</label>
                        </div>
                        </div>
    
                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="email" id="form3Example3c" name="email" value="{{ old('email') }}" class="form-control text-warning" required />
                            <label class="form-label" for="form3Example3c">Your Email</label>
                        </div>
                        </div>


                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="file" id="form3Example3c" name="image"  class="form-control text-warning"/>
                                <label for="image" class="form-label" for="form3Example3c">Image</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" id="form3Example3c" name="address" value="{{ old('address') }}" class="form-control text-warning" required/>
                                <label for="address" class="form-label" for="form3Example3c">Address</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('number')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" id="form3Example3c" name="number" value="{{ old('number') }}"  class="form-control text-warning" required/>
                                <label for="number" class="form-label" for="form3Example3c">Phon Number</label>
                            </div>
                        </div>
    
                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="password" id="form3Example4c"  
                            name="password" class="form-control text-warning" required/>
                            <label class="form-label" for="form3Example4c">Password</label>
                        </div>
                        </div>
    
                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('password_confirmation')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="password" name="password_confirmation" required autocomplete="new-password" id="form3Example4cd" class="form-control text-warning" />
                            <label class="form-label" for="form3Example4cd">Confirm password</label>
                        </div>
                        </div>
    
                        <div class="form-check d-flex justify-content-center mb-5">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                        <label class="form-check-label" for="form2Example3">
                            I agree all statements in <a href="#!">Terms of service</a>
                        </label>
                        </div>

                       
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <a  href="{{ route('login') }}" class="text-mute">Already registered?</a>
                        </div>
    
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button  type="submit" class="book-a-table-btn scrollto border-0">Register</button>
                        </div>
    
                    </form>
    
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
    
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                        class="img-fluid" alt="Sample image">

                         
    
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

   
@endsection
