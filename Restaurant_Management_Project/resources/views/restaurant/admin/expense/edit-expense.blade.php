@extends('restaurant.admin.layouts.master')

@section('title')
    edit-expense
@endsection

@section('body')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-lg-12 col-xl-11">
        <div class="card text-light border-0 mt-lg-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 mt-lg-5">                    

                 <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 profile-edit" style="color: #ffb03b" >Expense Edit</h2> 
                  <p class="text-center mb-2 mx-1 mx-md-4 mt-2 text-muted">Update Expense  information</p>
                   
                 
                   
                 <form method="post" action="{{ route('update.expense',$specificExpense->id) }}" class="mx-1 mx-md-4" enctype="multipart/form-data">
                    @csrf
                    @method('patch')  <!--method 'patch' use korechi karon jokhon amra patch use korbo tokhon laravel autometically buje jabe je ai information gulo update korte hobe--->                   
                                          

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('expense_type')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" id="form3Example3c" name="expense_type" value="{{ old('expense_type', $specificExpense->expense_type) }}" class="form-control text-warning" required/>
                            <label class="form-label" for="form3Example3c">Expense Type</label>
                            
                        </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                            <textarea type="text" name="description"   id="form3Example4c" class="form-control text-warning" required> {{ old('description', $specificExpense->description) }} </textarea>
                            <label class="form-label" for="form3Example4c">Description</label>
                        </div>
                        </div>  

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('total_price')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" name="total_price" value="{{ old('total_price', $specificExpense->total_amount) }}" id="form3Example4c" class="form-control text-warning" required/>
                                <label class="form-label" for="form3Example4c">Total Price</label>
                            </div>
                        </div>                         

                         <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            
                            <button type="submit" style="background-color: #ffb03b; border-radius: 40px;" class="text-light p-2">Update</button>

                            
                         </div>

                </form>

               </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="admin/images/updateExpense.png"
                    class="img-fluid" alt="Sample image">
                     

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection