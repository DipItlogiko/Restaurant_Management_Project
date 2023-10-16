@extends('restaurant.admin.layouts.master')

@section('title')
    Admin Dashboard 
@endsection



@section('body')

<div class="content-wrapper" >
  <div class="row">
     
  </div>
  <div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center  text-center">
                         
                 <i class="mdi mdi-account-group-outline p-2" style="font-size: 5em; color:#ffb03b"></i>
                
                <h3 class="mb-0">12</h3>
                 
              </div>
            </div>

            <div class="col-3">
              <div class="icon icon-box-success">
                <a href="#" style="color: #00d25b"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
              </div>
            </div>
           
          </div>
          <h6 class="text-muted font-weight-normal text-customize">Total Users</h6>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">

                <i class="mdi mdi-food p-2" style="font-size: 5em; color:#ffb03b"></i>
                <h3 class="mb-0">17</h3>
                 
              </div>
            </div>

            <div class="col-3">
              <div class="icon icon-box-success">
                <a href="#" style="color: #00d25b"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
              </div>
            </div>

          </div>
          <h6 class="text-muted font-weight-normal text-customize">Total Foods</h6>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">

                <i class="mdi mdi-table-edit p-2" style="font-size: 5em; color:#ffb03b"></i>
                <h3 class="mb-0">10</h3>
                 
              </div>
            </div>

            <div class="col-3">
              <div class="icon icon-box-success">
                <a href="#" style="color: #00d25b"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
              </div>
            </div>

          </div>
          <h6 class="text-muted font-weight-normal text-customize">Total Reservation</h6>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">

                <i class="mdi mdi-chef-hat p-2" style="font-size: 5em; color:#ffb03b"></i>
                <h3 class="mb-0">13</h3>
                
              </div>
            </div>
            <div class="col-3">
              <div class="icon icon-box-success">
                <a href="#" style="color: #00d25b"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
              </div>
            </div>
          <h6 class="text-muted font-weight-normal text-customize">Total Chefs</h6>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-customize">Transaction History</h4>
          <canvas id="transaction-history" class="transaction-chart"></canvas>
          <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
            <div class="text-md-center text-xl-left">
              <h6 class="mb-1">Transfer to Paypal</h6>
              <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
            </div>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
              <h6 class="font-weight-bold mb-0">$236</h6>
            </div>
          </div>
          <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
            <div class="text-md-center text-xl-left">
              <h6 class="mb-1">Tranfer to Stripe</h6>
              <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
            </div>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
              <h6 class="font-weight-bold mb-0">$593</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
       
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-customize">Sales Chart</h4>
          <canvas id="barChart" style="height:230px"></canvas>
        </div>
      </div>

    </div>
  </div>
   
  <div class="row ">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-customize">Order Status</h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                   
                  <th> Client Name </th>
                  <th> Order No </th>
                  <th> Food Cost </th>
                  <th> Project </th>
                  <th> Payment Mode </th>
                  <th> Order Date </th>
                  <th> Payment Status </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                   
                  <td>
                    <img src="admin/assets/images/faces/face1.jpg" alt="image" />
                    <span class="ps-2">Henry Klein</span>
                  </td>
                  <td> 02312 </td>
                  <td> $14,500 </td>
                  <td> potato </td>
                  <td> Credit card </td>
                  <td> 04 Dec 2019 </td>
                  <td>Approved</td>
                </tr>
                <tr>
                   
                  <td>
                    <img src="admin/assets/images/faces/face2.jpg" alt="image" />
                    <span class="ps-2">Estella Bryan</span>
                  </td>
                  <td> 02312 </td>
                  <td> $14,500 </td>
                  <td> shup </td>
                  <td> Cash on delivered </td>
                  <td> 04 Dec 2019 </td>
                  <td> Pending </td>
                </tr>
                <tr>
                   
                  <td>
                    <img src="admin/assets/images/faces/face5.jpg" alt="image" />
                    <span class="ps-2">Lucy Abbott</span>
                  </td>
                  <td> 02312 </td>
                  <td> $14,500 </td>
                  <td> french fry </td>
                  <td> Credit card </td>
                  <td> 04 Dec 2019 </td>
                  <td> Rejected </td>
                </tr>
                <tr>
                   
                  <td>
                    <img src="admin/assets/images/faces/face3.jpg" alt="image" />
                    <span class="ps-2">Peter Gill</span>
                  </td>
                  <td> 02312 </td>
                  <td> $14,500 </td>
                  <td> barbeque </td>
                  <td> Online Payment </td>
                  <td> 04 Dec 2019 </td>
                  <td> Approved </td>
                </tr>
                <tr>
                   
                  <td>
                    <img src="admin/assets/images/faces/face4.jpg" alt="image" />
                    <span class="ps-2">Sallie Reyes</span>
                  </td>
                  <td> 02312 </td>
                  <td> $14,500 </td>
                  <td> french fry </td>
                  <td> Credit card </td>
                  <td> 04 Dec 2019 </td>
                  <td> Approved </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-xl-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row justify-content-between">
            <h4 class="card-title text-customize">Messages</h4>
            <p class="text-muted mb-1 small">View all</p>
          </div>
          <div class="preview-list">
            <div class="preview-item border-bottom">
              <div class="preview-thumbnail">
                <img src="admin/assets/images/faces/face6.jpg" alt="image" class="rounded-circle" />
              </div>
              <div class="preview-item-content d-flex flex-grow">
                <div class="flex-grow">
                  <div class="d-flex d-md-block d-xl-flex justify-content-between">
                    <h6 class="preview-subject">Leonard</h6>
                    <p class="text-muted text-small">5 minutes ago</p>
                  </div>
                  <p class="text-muted">Food was good.</p>
                </div>
              </div>
            </div>
            <div class="preview-item border-bottom">
              <div class="preview-thumbnail">
                <img src="admin/assets/images/faces/face8.jpg" alt="image" class="rounded-circle" />
              </div>
              <div class="preview-item-content d-flex flex-grow">
                <div class="flex-grow">
                  <div class="d-flex d-md-block d-xl-flex justify-content-between">
                    <h6 class="preview-subject">Luella Mills</h6>
                    <p class="text-muted text-small">10 Minutes Ago</p>
                  </div>
                  <p class="text-muted">Well, wonderful.</p>
                </div>
              </div>
            </div>
            <div class="preview-item border-bottom">
              <div class="preview-thumbnail">
                <img src="admin/assets/images/faces/face9.jpg" alt="image" class="rounded-circle" />
              </div>
              <div class="preview-item-content d-flex flex-grow">
                <div class="flex-grow">
                  <div class="d-flex d-md-block d-xl-flex justify-content-between">
                    <h6 class="preview-subject">Ethel Kelly</h6>
                    <p class="text-muted text-small">2 Hours Ago</p>
                  </div>
                  <p class="text-muted">Food was bad</p>
                </div>
              </div>
            </div>
            <div class="preview-item border-bottom">
              <div class="preview-thumbnail">
                <img src="admin/assets/images/faces/face11.jpg" alt="image" class="rounded-circle" />
              </div>
              <div class="preview-item-content d-flex flex-grow">
                <div class="flex-grow">
                  <div class="d-flex d-md-block d-xl-flex justify-content-between">
                    <h6 class="preview-subject">Herman May</h6>
                    <p class="text-muted text-small">4 Hours Ago</p>
                  </div>
                  <p class="text-muted">i enjoied the food</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     
    <div class="col-md-12 col-xl-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-customize">To do list</h4>
          <div class="add-items d-flex">
            <input type="text" class="form-control todo-list-input text-light" placeholder="enter task..">
            <button class="add btn btn-primary todo-list-add-btn">Add</button>
          </div>
          <div class="list-wrapper">
            <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
              <li>
                <div class="form-check form-check-primary">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox"> Create invoice </label>
                </div>
                <i class="remove mdi mdi-close-box"></i>
              </li>
              <li>
                <div class="form-check form-check-primary">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox"> Meeting with Alita </label>
                </div>
                <i class="remove mdi mdi-close-box"></i>
              </li>
               
              <li>
                <div class="form-check form-check-primary">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox"> Plan weekend outing </label>
                </div>
                <i class="remove mdi mdi-close-box"></i>
              </li>
              <li>
                <div class="form-check form-check-primary">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                </div>
                <i class="remove mdi mdi-close-box"></i>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
   
</div>
<!-- content-wrapper ends -->

@endsection