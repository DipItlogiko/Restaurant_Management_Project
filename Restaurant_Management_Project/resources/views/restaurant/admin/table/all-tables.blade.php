@extends('restaurant.admin.layouts.master')

@section('title')
    all-tables
@endsection


@section('body')
<div class="p-5">

    @if ($tables->isEmpty())
        <div class="row text-center">
            <div class="col-lg-3"></div>             

            <div class="col-lg-5">
                <div class="card border-0">
                    <img src="admin/images/nodata-found.png" alt="Image" class="img-fluid">
                    <div class="card-body">
                        <h5 class="card-title font text-warning h2">No Data Found!!!</h5>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-warning">Go To Dashboard</a>
                        <p class="card-text"><small class="text-muted">McDonald's</small></p>
                    </div>
                </div>  
            </div>

            <div class="col-lg-3"></div>                     
                        
        </div>
    @else

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                <div class="card text-black border-0" >
                    <div class="card-body ">
                    <div class="row justify-content-center mt-lg-5">
                        <div class=" col-lg-6   order-2 order-lg-1 ">

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

                        <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2  pb-lg-2 text-light font">All<span style="color: #ffb03b">Table</span></h2> 

                        <!--===== Search bar start =====-->    
                            <div class="search-container">
                                <div class="input-box rounded-pill">
                                    <i class="mdi mdi-magnify"></i>
                                    <form action="{{ route('table.search') }}" method="get"> <!--search ar jonno amra get method ee use kori--->
                                        <input type="text" class="text-warning" name="search" placeholder="Search here..." required/>
                                        <button class="button border-0"><a type="submit" class="btn btn-outline-warning rounded-pill">Search</a></button>
                                    </form>
                                    
                                </div>
                            </div>  
                        <!--===== Search bar End =====-->

                        <div class="table-responsive mt-4">

                            <table class="table">
                            <thead>
                                <tr>
                                
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Table Name</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Capacity</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Created At</th>                       
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Status</th>                       
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Action</th>                       
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tables as $data)
                                <tr>                            

                                    <td>{{ $data->name }}</td>   
                                    <td>{{ $data->capacity }}</td>                                        
                                    <td>{{ $data->created_at }}</td>  

                                    @if ($data->deleted_at == '') <!-----jehetu ami softdelete freture ta use korchi book table ta handel korar jonno tai ami  akhane bolechi jodi amader deleted_at column ta empty ba null hoy tahole Avaliable dekhabe table ar status ta and jodi deleted_at column ar moddhe kono value thake tahole else ar moddhe chole jabe and table ar status ta dekhabe Booked --->
                                        <td>Available</td>    
                                    @else
                                        <td>Booked</td>                                 
                                    @endif

                                    <td>
                                        <a href="{{ route('admin.edit.tables.info', $data->id) }}" class="btn btn-info">Edit</a>
                                        <button class="btn btn-danger delete-table-button" data-table-id="{{ $data->id }}">Delete</button>
                                    </td>                                        
                                </tr>

                                @endforeach
                                                    
                                
                            </tbody>
                            </table>
                            <!--Pagination degine----> 
                            <div class="row m-2 pt-3">
                                {{ $tables->links('pagination::bootstrap-5') }}
                            </div>
                        
                        </div>

                        </div>
                        <div class="col-lg-4 col-md-6 align-items-center order-1 order-lg-2">

                        <img src="admin/images/all-table2.png"
                            class="img-fluid" alt="Sample image">

                            

                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <!--======= Delete Confirmation Pop Up Modal ========-->

            <div class="modal" id="confirmTableDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Delete Confirmation</h5>            
                        </div>
                        <div class="modal-body">
                        <span class="text-danger">Are you sure you want to Delete this table from your tables record?</span>

                            <div class="text-muted mt-4">
                                Once this Table is Deleted, all of it's resources and data will be permanently delete. Please press on Delete button to confirm you would like to permanently Delete this table from your table records. 
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                        <button id="cancelButton" type="button" class="btn btn-outline-light rounded-pill" data-dismiss="modal">Cancel</button>
                        <a  class="btn btn-outline-danger rounded-pill">Delete</a>
                        </div>
                    </div>
                    </div>
        </div>    
        <!--====== END Delete Confirmation Pop Up Modal ======-->

    @endif

</div>
@endsection

@section('custom_js')

<!--===== This script is for Delete confirmation Pop Up Modal =====-->
<script>
    $(document).ready(function() {
        $('.delete-table-button').on('click', function() {
            var tableId = $(this).data('table-id');
            var modal = $('#confirmTableDeletionModal');
            modal.find('a.btn-outline-danger').attr('href', '/deleteTable' + tableId); ///// jokhon kew amar delete confirmation model ar moddhe jei delete button ache oi button aaa click korbe tokhon amader oi user ar id ta akhan theke pass hoye jabe amader route/web.php file ar moddhe /deleteTable{id}
            modal.modal('show');
        });

        $('#cancelButton').on('click', function() {
            $('#confirmTableDeletionModal').modal('hide');
        });
    });
</script>

<!--====== This script is for Aleart auto close =======-->
<script>

    // Get all elements with class "auto-close"
    const autoCloseElements = document.querySelectorAll(".auto-close");

    // Define a function to handle the fading and sliding animation
    function fadeAndSlide(element) {
    const fadeDuration = 500;
    const slideDuration = 500;
 
    // Step 1: Fade out the element
    let opacity = 1;
    const fadeInterval = setInterval(function () {
        if (opacity > 0) {
        opacity -= 0.1;
        element.style.opacity = opacity;
        } else {
        clearInterval(fadeInterval);
     // Step 2: Slide up the element
     let height = element.offsetHeight;
     const slideInterval = setInterval(function () {
         if (height > 0) {
         height -= 10;
         element.style.height = height + "px";
         } else {
         clearInterval(slideInterval);
         // Step 3: Remove the element from the DOM
         element.parentNode.removeChild(element);
         }
     }, slideDuration / 10);
     }
 }, fadeDuration / 10);
 }

 // Set a timeout to execute the animation after 5000 milliseconds (5 seconds)
 setTimeout(function () {
 autoCloseElements.forEach(function (element) {
     fadeAndSlide(element);
 });
 }, 5000);

</script>
@endsection