@extends('restaurant.admin.layouts.master')

@section('title')
    edit-table-info
@endsection

@section('body') 
    <div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
        <div class="card text-black border-0" >
            <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 pt-lg-5 mt-lg-5">                  

                 <h2 class="text-center fw-bold h1  mx-1 mx-md-4  mb-lg-4 pt-3  text-light font">Edit<span style="color: #ffb03b">Table</span>Info</h2> 

                 <form  method="POST" action="{{ route('admin.updated.table.info.store' , $tables->id ) }}" class=" mx-md-4" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

 

                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                        <input type="text" id="form3Example1c" name="tableName" value="{{ old('name',$tables->name) }}" class="form-control text-warning" required/>
                        <label class="form-label text-light" for="form3Example1c">Table Name</label>
                    </div>
                    </div>                       

                   

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('capacity')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" id="form3Example1c" name="capacity" value="{{ old('capacity',$tables->capacity) }}" class="form-control text-warning" required/>
                            <label class="form-label text-light" for="form3Example1c">Capacity</label>
                        </div>
                        </div>       

                   
                    

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button  type="submit" style="background-color: #ffb03b; border-radius: 40px;" class="text-light p-2 px-3 btn-danger">Update</button>
                    </div>

                </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="admin/images/editFood.png"
                    class="img-fluid" alt="Sample image">  

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
     
 

</div>
@endsection