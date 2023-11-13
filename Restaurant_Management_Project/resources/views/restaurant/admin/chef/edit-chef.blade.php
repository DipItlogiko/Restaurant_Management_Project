@extends('restaurant.admin.layouts.master')

@section('title')
    edit-chef
@endsection

@section('body')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-lg-12 col-xl-11">
        <div class="card text-light border-0 mt-lg-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">                    

                 <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 profile-edit" style="color: #ffb03b" >Chef Edit</h2> 
                  <p class="text-center mb-2 mx-1 mx-md-4 mt-2 text-muted">Update Chefs  information</p>
                 
                   
                 
                   
                 <form method="post" action="{{ route('admin.chef.update',$chef->id) }}" class="mx-1 mx-md-4" enctype="multipart/form-data">
                    @csrf
                    @method('patch')  <!--method 'patch' use korechi karon jokhon amra patch use korbo tokhon laravel autometically buje jabe je ai information gulo update korte hobe--->
                    
                        
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            
                            <div class="text-center pb-2">
                               <img class="rounded-circle border border-warning" width="120" height="120" src="Chefs_images/{{ $chef->image }}" alt="admin image">
                            </div>
                            <span class="text-danger">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="file" id="form3Example3c" name="image" class="form-control text-warning" />
                            <label class="form-label" for="form3Example3c">Image</label>
                            
                        </div>
                        </div>
                       

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" id="form3Example3c" name="name" value="{{ old('name', $chef->name) }}" class="form-control text-warning" required/>
                            <label class="form-label" for="form3Example3c">Name</label>
                            
                        </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('position')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" name="position" value="{{ old('position', $chef->position) }}" id="form3Example4c" class="form-control text-warning" required/>
                            <label class="form-label" for="form3Example4c">Position</label>
                        </div>
                        </div>  

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('number')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" name="number" value="{{ old('number', $chef->number) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">Number</label>
                            </div>
                            </div> 
                        
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('twitter')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" name="twitter" value="{{ old('twitter', $chef->twitter) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">Twitter</label>
                            </div>
                        </div> 


                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('fb')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" name="fb" value="{{ old('fb', $chef->facebook) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">Facebook</label>
                            </div>
                        </div> 

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('linkedin')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" name="linkedin" value="{{ old('linkedin', $chef->linkedin) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">LinkedIn</label>
                            </div>
                        </div> 

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('instagram')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" name="instagram" value="{{ old('instagram', $chef->instagraam) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">Instagram</label>
                            </div>
                        </div> 

                         

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            
                            <button type="submit" style="background-color: #ffb03b; border-radius: 40px;" class="text-light p-2">Update</button>

                            
                        </div>

                </form>

               </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="admin/images/edit2.png"
                    class="img-fluid" alt="Sample image">
                     

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection