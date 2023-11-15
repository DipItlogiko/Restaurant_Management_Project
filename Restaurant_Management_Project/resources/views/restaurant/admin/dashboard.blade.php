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
                
                <h3 class="mb-0">{{ $usersCount }}</h3>
                 
              </div>
            </div>

            <div class="col-3">
              <div class="icon icon-box-success">
                <a href="{{ route('admin.show.users') }}" style="color: #00d25b"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
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
                <h3 class="mb-0">{{ $foodsCount }}</h3>
                 
              </div>
            </div>

            <div class="col-3">
              <div class="icon icon-box-success">
                <a href="{{ route('admin.show.foods') }}" style="color: #00d25b"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
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
                <h3 class="mb-0">{{ $reservationsCount }}</h3>
                 
              </div>
            </div>

            <div class="col-3">
              <div class="icon icon-box-success">
                <a href="{{ route('admin.show.all.reserved.table') }}" style="color: #00d25b"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
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
                <h3 class="mb-0">{{ $chefsCount }}</h3>
                
              </div>
            </div>
            <div class="col-3">
              <div class="icon icon-box-success">
                <a href="{{ route('show.all.chefs') }}" style="color: #00d25b"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
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
          <h4 class="card-title text-customize">Transaction Summary</h4>
          <canvas id="transaction-history" class="mt-5 " height='10px' width='10px'></canvas>         
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
                   
                  <th> Customer Name </th>
                  <th> Order No </th>
                  <th> Food Cost </th>
                  <th> Food Name </th>
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

@section('custom_js')

<!--============= This script is for Transaction History canvas ==========--> 
<script>
 (function($) {
  'use strict';
  $.fn.andSelf = function() {
    return this.addBack.apply(this, arguments);
  }
  $(function() {
    if ($("#currentBalanceCircle").length) {
      var bar = new ProgressBar.Circle(currentBalanceCircle, {
        color: '#000',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 12,
        trailWidth: 12,
        trailColor: '#0d0d0d',
        easing: 'easeInOut',
        duration: 1400,
        text: {
          autoStyleContainer: false
        },
        from: { color: '#d53f3a', width: 12 },
        to: { color: '#d53f3a', width: 12 },
        // Set default step function for all animate calls
        step: function(state, circle) {
          circle.path.setAttribute('stroke', state.color);
          circle.path.setAttribute('stroke-width', state.width);
      
          var value = Math.round(circle.value() * 100);
          circle.setText('');
      
        }
      });

      bar.text.style.fontSize = '1.5rem';
      bar.animate(0.4);  // Number from 0.0 to 1.0
    }
    if($('#audience-map').length) {
      $('#audience-map').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        panOnDrag: true,
        focusOn: {
          x: 0.5,
          y: 0.5,
          scale: 1,
          animate: true
        },
        series: {
          regions: [{
            scale: ['#3d3c3c', '#f2f2f2'],
            normalizeFunction: 'polynomial',
            values: {

              "BZ": 75.00,
              "US": 56.25,
              "AU": 15.45,
              "GB": 25.00,
              "RO": 10.25,
              "GE": 33.25
            }
          }]
        }
      });
    }
    if ($("#transaction-history").length) {
      var receivedCash = {{ $receivedCash }};
      var pendingCash = {{ $pendingCash }};
      var processingCash = {{ $processingCash }};
      
      var areaData = {
        labels: ["CashReceived","CashPanding","CashProcessing"],
        datasets: [{
            data: [receivedCash,pendingCash,processingCash],
            backgroundColor: [
              "#1b3f46","#111111","#ad8632"
            ]
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 79,
        elements: {
          arc: {
              borderWidth: 0
          }
        },      
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        }
      }
      var transactionhistoryChartPlugins = {
        beforeDraw: function(chart) {
          var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;
      
          ctx.restore();
          var fontSize = 1.2;
          ctx.font = fontSize + "rem sans-serif";
          ctx.textAlign = 'left';
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#ffffff";
      
          var text ="${{$receivedCash}}", 
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2.1;
      
          ctx.fillText(text, textX, textY);

          ctx.restore();
          var fontSize = 1.2;
          ctx.font = fontSize + "rem sans-serif";
          ctx.textAlign = 'middle';
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#6c7293";

          var texts = "Total Earn", 
              textsX = Math.round((width - ctx.measureText(text).width) / 2.3),
              textsY = height / 1.9;
      
          ctx.fillText(texts, textsX, textsY);
          ctx.save();
        }
      }
      var transactionhistoryChartCanvas = $("#transaction-history").get(0).getContext("2d");
      var transactionhistoryChart = new Chart(transactionhistoryChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: transactionhistoryChartPlugins
      });
    }
    if ($("#transaction-history-arabic").length) {
      var areaData = {
        labels: ["Paypal", "Stripe","Cash"],
        datasets: [{
            data: [55, 25, 20],
            backgroundColor: [
              "#111111","#00d25b","#ffab00"
            ]
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 70,
        elements: {
          arc: {
              borderWidth: 0
          }
        },      
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        }
      }
      var transactionhistoryChartPlugins = {
        beforeDraw: function(chart) {
          var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;
      
          ctx.restore();
          var fontSize = 1;
          ctx.font = fontSize + "rem sans-serif";
          ctx.textAlign = 'left';
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#ffffff";
      
          var text = "$1200", 
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2.4;
      
          ctx.fillText(text, textX, textY);

          ctx.restore();
          var fontSize = 0.75;
          ctx.font = fontSize + "rem sans-serif";
          ctx.textAlign = 'left';
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#6c7293";

          var texts = "مجموع", 
              textsX = Math.round((width - ctx.measureText(text).width) / 1.93),
              textsY = height / 1.7;
      
          ctx.fillText(texts, textsX, textsY);
          ctx.save();
        }
      }
      var transactionhistoryChartCanvas = $("#transaction-history-arabic").get(0).getContext("2d");
      var transactionhistoryChart = new Chart(transactionhistoryChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: transactionhistoryChartPlugins
      });
    }
    if ($('#owl-carousel-basic').length) {
      $('#owl-carousel-basic').owlCarousel({
        loop: true,
        margin: 10,
        dots: false,
        nav: true,
        autoplay: true,
        autoplayTimeout: 4500,
        navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      });
    }
    var isrtl = $("body").hasClass("rtl");
    if ($('#owl-carousel-rtl').length) {
      $('#owl-carousel-rtl').owlCarousel({
        loop: true,
        margin: 10,
        dots: false,
        nav: true,
        rtl: isrtl,
        autoplay: true,
        autoplayTimeout: 4500,
        navText: ["<i class='mdi mdi-chevron-right'></i>", "<i class='mdi mdi-chevron-left'></i>"],
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      });
    }
    });
})(jQuery);
</script>
@endsection