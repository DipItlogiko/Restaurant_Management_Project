@extends('restaurant.admin.layouts.master')

@section('title')
    edit-worker
@endsection

@section('body')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-lg-12 col-xl-11">
        <div class="card text-light border-0 mt-lg-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">                    

                 <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 profile-edit" style="color: #ffb03b" >Worker Edit</h2> 
                  <p class="text-center mb-2 mx-1 mx-md-4 mt-2 text-muted">Update Worker  information</p>
                 
                   
                 
                   
                 <form method="post" action="{{ route('worker.update',$specificWorker->id) }}" class="mx-1 mx-md-4" enctype="multipart/form-data">
                    @csrf
                    @method('patch')  <!--method 'patch' use korechi karon jokhon amra patch use korbo tokhon laravel autometically buje jabe je ai information gulo update korte hobe--->
                    
                        
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            
                            <div class="text-center pb-2">
                               <img class="rounded-circle border border-warning" width="120" height="120" src="Worker_images/{{ $specificWorker->image }}" alt="admin image">
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
                            <input type="text" id="form3Example3c" name="name" value="{{ old('name', $specificWorker->name) }}" class="form-control text-warning" required/>
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
                            <input type="text" name="position" value="{{ old('position', $specificWorker->position) }}" id="form3Example4c" class="form-control text-warning" required/>
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
                                <input type="text" name="number" value="{{ old('number', $specificWorker->number) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">Number</label>
                            </div>
                            </div> 
                        
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="email" name="email" value="{{ old('email', $specificWorker->email) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">Email</label>
                            </div>
                        </div> 


                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" name="address" value="{{ old('address', $specificWorker->address) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">Address</label>
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