@extends('restaurant.user.layouts.master')

@section('title')
    show-table-reservation-history
@endsection

@section('body')
<div class="p-5">
    
    @if($specificUserReservations == '[]')
        
        <div class="row text-center">
            <div class="col-lg-3"></div>             

            <div class="col-lg-5">
                <div class="card border-0">
                    <img src="admin/images/nodata-found.png" alt="Image" class="img-fluid">
                    <div class="card-body">
                        <h5 class="card-title font text-warning h2">No Data Found!!!</h5>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-warning">Go Back</a>
                        <p class="card-text"><small class="text-muted">McDonald's</small></p>
                    </div>
                </div>  
            </div>

            <div class="col-lg-3"></div>                     
                        
        </div>

    @else
    
            <h1 class="mb-2 fw-bolder text-warning font">Booked Table Story</h1>                        
            

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-3 border-0">
                        <div class="table-responsive mt-4">

                            <table class="table">
                            <thead>
                                <tr>
                                
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Your Name</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Your Email</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Your Number</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Time From</th>                          
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Time To</th>                          
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Number Of Peoples</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Table Name</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Status</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Message</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($specificUserReservations as $data)
                                <tr>
                                    <td>{{ $data->customer_name }}</td>   
                                    <td>{{ $data->customer_email }}</td>                                        
                                    <td>{{ $data->customer_number }}</td>                                        
                                    <td>{{ $data->time_from }}</td>                                        
                                    <td>{{ $data->time_to}}</td>                                        
                                    <td>{{ $data->number_of_people}}</td>                                        
                                    <td>{{ $data->table_name}}</td> 

                                    @if( $data->deleted_at)                                       
                                     <td>Booked</td> 
                                    @else
                                      <td>Available</td> 
                                    @endif

                                    <td>{{ $data->description}}</td>                                                                                                   
                                                                           
                                </tr>

                                @endforeach
                                                    
                                
                            </tbody>
                            </table>
                        
                        </div>
                    </div>
                </div>             
            </div>             

            <!--======= Delete Confirmation Pop Up Modal ========-->

            <div class="modal" id="confirmBookedTableDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Delete Confirmation</h5>            
                        </div>
                        <div class="modal-body">
                        <span class="text-danger">Are you sure you want to Delete this reservation from your table reservation record?</span>

                            <div class="text-muted mt-4">
                                Once this reservation is Deleted, all of it's resources and data will be permanently delete.Before deleting this please make sure you have clicked on free button for free your table.Please press on Delete button to confirm you would like to permanently Delete this reservation from your table reservation records. 
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