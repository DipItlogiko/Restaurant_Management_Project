@extends('restaurant.user.layouts.master')

@section('title')
    show-table-reservation-history
@endsection

@section('body')
<div class="p-5">
    
    @if($specificUserReservations->isEmpty())
        
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
    
            <h1 class="mb-2 fw-bolder text-warning font">Booked Table Story</h1>                        
            

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-3 border-0">
                        <div class="table-responsive mt-md-5 pt-md-5">

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
                            <!---Pagination degine---->
                            <div class="row m-2 pt-3">
                                {{ $specificUserReservations->links('pagination::bootstrap-5') }}
                            </div>
                        
                        </div>
                    </div>
                </div>             
            </div>              
    
    @endif      
</div> 
@endsection