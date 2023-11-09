@extends('restaurant.admin.layouts.master')

@section('title')
    table-reservation
@endsection

@section('body') 
 <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-12 col-xl-11">
        <div class="card text-black border-0" >
            <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <!--==== Flash Message ====-->

                    @if (session('status'))

                    <!----(i have used bootstrap5 aleart to show our FLASH MESSAGE)---->
                    <!-----(tickmark icon)----->
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>                           
                    </svg>
                        
                        <!--(aleart)-->
                        <div class="auto-close alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2 text-success" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                {{ session('status') }}
                            </div>
                            
                            <button type="button" class="btn-close" style="margin-left: auto"  data-bs-dismiss="alert" aria-label="Close"></button>
                            
                        </div>
                    @endif
                  
                  <!--==== End Flash Message ====-->

                 <h2 class="text-center fw-bold h1 my-2 mx-1 mx-md-4  pb-3 text-light font">Table<span style="color: #ffb03b">Reservation</span></h2> 

                 <form  method="POST" action="{{ route('admin.store.user') }}" class=" mx-md-4" enctype="multipart/form-data">
                    @csrf

                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <span class="text-danger">
                            @error('customerName')
                                {{ $message }}
                            @enderror
                        </span>
                        <input type="text" id="form3Example1c" name="customerName" value="{{ old('customerName') }}" class="form-control text-warning" required/>
                        <label class="form-label text-light" for="form3Example1c">Customer Name</label>
                    </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <span class="text-danger">
                            @error('customerEmail')
                                {{ $message }}
                            @enderror
                        </span>
                        <input type="email" id="form3Example3c" name="customerEmail" value="{{ old('customerEmail') }}" class="form-control text-warning" required />
                        <label class="form-label text-light" for="form3Example3c">Customer Email</label>
                    </div>
                    </div>


                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('customerNumber')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" id="form3Example3c" name="customerNumber" value="{{ old('customerNumber') }}" class="form-control text-warning" required />
                            <label class="form-label text-light" for="form3Example3c">Customer Number</label>
                        </div>
                    </div>

                     
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('time')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="time" id="form3Example3c" name="time" value="{{ old('time') }}" class="form-control text-warning" required />
                            <label class="form-label text-light" for="form3Example3c">Time</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('nop')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" id="form3Example3c" name="nop" value="{{ old('nop') }}" class="form-control text-warning" required />
                            <label class="form-label text-light" for="form3Example3c">Number of People</label>
                        </div>
                    </div>

                    <!-- Dropdown input field -->
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-list fa-lg me-3 fa-fw "></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('avaliableTable')
                                    {{ $message }}
                                @enderror
                            </span>

                            
                            <select id="form3Example3c" name="avaliableTable" class="form-select text-warning form-control" required>  
                                <option value="">select table...</option>  

                                @foreach($tables as $data)                                                                       
                                    <option value="{{ $data->name }}">{{ $data->name }}(capacity:{{ $data->capacity }})</option>                                     
                                @endforeach                                       
                            </select>
                            
                            <label for="avaliableTable" class="form-label text-light" for="form3Example3c">Available Table</label>
                        </div>
                    </div>  
                    
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>                           
                            <textarea id="form3Example3c" name="description" class="form-control text-warning" required>{{ old('description') }}</textarea>
                            <label for="description" class="form-label text-light" for="form3Example3c">Description</label>
                        </div>
                    </div> 

                   
                    

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button  type="submit" style="background-color: #ffb03b; border-radius: 40px;" class="text-light p-2 px-3 btn-danger">Save</button>
                    </div>

                </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="admin/images/reservation1.png"
                    class="img-fluid" alt="Sample image">

                     

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
     
 

</div>
@endsection