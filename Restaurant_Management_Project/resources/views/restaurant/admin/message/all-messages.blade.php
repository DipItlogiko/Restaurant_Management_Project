@extends('restaurant.admin.layouts.master')

@section('title')
    customer-messages
@endsection


@section('body')
    <div class="m-5">
        @if ($allMessages->isEmpty()) 

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

            <h1 class="mb-2 fw-bolder text-warning font">Customer Messages</h1>   

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
                    <div class="auto-close alert alert-success d-flex align-items-center" role="alert" class="mx-auto">
                        <svg class="bi flex-shrink-0 me-2 text-success" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>
                            {{ session('status') }}
                        </div>
                        
                        <button type="button" class="btn-close" style="margin-left: auto"  data-bs-dismiss="alert" aria-label="Close"></button>
                        
                    </div>
                @endif

            <!--==== End Flash Message ====-->
            
            <!--===== Search bar start =====-->    
            <div class="search-container">
                <div class="input-box rounded-pill">
                    <i class="mdi mdi-magnify"></i>
                    <form action="{{ route('search.message') }}" method="get"> <!--search ar jonno amra get method ee use kori--->
                        <input type="text" class="text-warning" name="search" placeholder="Search here..." required/>
                        <button class="button border-0"><a type="submit" class="btn btn-outline-warning rounded-pill">Search</a></button>
                    </form>
                    
                </div>
            </div>  
            <!--===== Search bar End =====-->              
            

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-3 border-0">
                        <div class="table-responsive mt-4">

                            <table class="table">
                            <thead>
                                <tr>
                                
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Image</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Name</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Email</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Message</th>                          
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Send At</th>                          
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem"></th>                          
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Action</th>                        
                                
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($allMessages as $message)
                                <tr>
                                    <td>
                                        <img src="Users_images/{{ $message->image }}" alt="">
                                    </td> 

                                    <td>{{ $message->name }}</td>   
                                    <td>{{ $message->email }}</td>                                        
                                    <td>{{ $message->message }}</td>                                                                                                       
                                    <td>{{ $message->created_at }}</td>
                                    <td>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td> <!--akhane amader created at column ar value ta 10 min ago 5 min ago eemon dekhabe jar jonno amra laravel ar akta package install korechi go to Readme.md file-------->
                                    <td>                                        
                                        <button class="btn btn-danger delete-message-button" data-message-id="{{ $message->id }}">Delete</button>
                                    </td>                                        
                                </tr>

                                @endforeach
                                                    
                                
                            </tbody>
                            </table>
                            <!--Pagination degine-->
                            <div class="row m-2 pt-3">
                                {{ $allMessages->links('pagination::bootstrap-5') }}
                            </div>
                        
                        </div>
                    </div>
                </div>             
            </div>


            <!--======= Delete Confirmation Pop Up Modal ========-->

            <div class="modal" id="confirmMessageDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Delete Confirmation</h5>            
                        </div>
                        <div class="modal-body">
                        <span class="text-danger">Are you sure you want to Delete this Message from your Message records?</span>

                            <div class="text-muted mt-4">
                                Once this Message is Deleted, all of it's resources and data will be permanently delete. Please press on Delete button to confirm you would like to permanently Delete this Message from your Message records. 
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
            $('.delete-message-button').on('click', function() {
                var messageId = $(this).data('message-id');
                var modal = $('#confirmMessageDeletionModal');
                modal.find('a.btn-outline-danger').attr('href', '/deleteMessage' + messageId); ///// jokhon kew amar delete confirmation model ar moddhe jei delete button ache oi button aaa click korbe tokhon amader oi user ar id ta akhan theke pass hoye jabe amader route/web.php file ar moddhe /deleteMessage{id}
                modal.modal('show');
            });

            $('#cancelButton').on('click', function() {
                $('#confirmMessageDeletionModal').modal('hide');
            });
        });
    </script>



    <!--======= This script is for Aleart auto close ======-->
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