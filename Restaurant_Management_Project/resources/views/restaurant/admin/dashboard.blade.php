@extends('restaurant.admin.layouts.master')

@section('title')
    Admin Dashboard 
@endsection



@section('body')

<div class="content-wrapper" >

  <div class="row">
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
    <!--========== transaction-history Canvas ============--->
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-customize">Transaction Summary</h4>
          <canvas id="transaction-history" class="mt-5 " height='10px' width='10px'></canvas>   <!--Canvas hocche amader html ar akta tag jar maddhome amra amader application ar moddhe graphic ar kaj korte pari canvas tag ta use kore ai canvas ar akta id dite hobe and ai id dhore amader js mane javascript file ar moddhe degine korte hobe amra ai canvas tar degien ta amader ai file ar niche korechi script tag ar moddhe----->      
        </div>
      </div>
    </div>

    <!--========== Sales Chart Canvas ============--->
    <div class="col-md-8 grid-margin stretch-card">       
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-customize">Sales Chart</h4>
          <canvas id="barChart" style="height:230px"></canvas>    <!--Canvas hocche amader html ar akta tag jar maddhome amra amader application ar moddhe graphic ar kaj korte pari canvas tag ta use kore ai canvas ar akta id dite hobe and ai id dhore amader js mane javascript file ar moddhe degine korte hobe amra ai canvas tar degien ta amader ai page ar niche korechi script tag ar moddhe----->
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
                  <th> Food Cost </th>
                  <th> Food Name </th>
                  <th> Payment Mode </th>
                  <th> Order Date </th>
                  <th> Payment Status </th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                  <tr>
                    
                      <td>
                        <img src="Users_images/{{$order->image}}" alt="image" />
                        <span class="ps-2">{{ $order->name }}</span>
                      </td>                     
                      <td> ${{ $order->price * $order->quantity }} </td>
                      <td> {{ $order->food_name }} </td>
                      <td> {{ $order->payment }} </td>
                      <td> {{ $order->created_at }} </td>

                      @if($order->order_status == 'placed')
                        <td>Paid</td>
                      @elseif($order->order_status == 'on the way')
                        <td>Processing</td> 
                      @else
                        <td>Pending</td>
                      @endif   
                  
                  </tr>  
                @endforeach              
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
            <a href="{{ route('customser.messages') }}" class="text-muted mb-1 small" style="text-decoration: none"><p>View all</p></a>
          </div>
          <div class="preview-list">

            @foreach($messages as $message)

              <div class="preview-item border-bottom">
                <div class="preview-thumbnail">
                  <img src="Users_images/{{ $message->image }}" alt="image" class="rounded-circle" />
                </div>
                <div class="preview-item-content d-flex flex-grow">
                  <div class="flex-grow">
                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                      <h6 class="preview-subject">{{ $message->name }}</h6>
                      <p class="text-muted text-small">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>  <!--\Carbon\Carbon::parse($message->created_at)->diffForHumans() it will generate 10 min ago 5 min ago this functionality from our $message->created_at before using it i have installed Laravel-10 package nesbot/carbon-------->
                    </div>
                    <p class="text-muted">{{ $message->message }}</p>
                  </div>
                </div>
              </div> 

            @endforeach                  
             
          </div>
        </div>
      </div>
    </div>
     
    <div class="col-md-12 col-xl-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-customize">To do list</h4>
          <form action="{{ route('add.task') }}" method="POST">
            @csrf

              <span class="text-danger">
                @error('task')
                    {{ $message }}
                @enderror
              </span>  
              <div class="d-flex">                
                <input type="text" name="task" class="form-control text-light" placeholder="enter task..">                 
                <button type="submit" class=" btn btn-primary bg-primary">Add</button>
              </div>
          </form>
         
          <div class="list-wrapper">
            <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
              
              @foreach($tasks as $task)
              
                <li>
                  <div class="form-check form-check-primary">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox"> {{ $task->description }} </label>
                  </div>
                  <a href="{{ route('delete.task',$task->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete task permanently" class="remove"><i class="mdi mdi-close-box"></i></a>
                </li>  
               
              @endforeach
                  
              
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
    if ($("#transaction-history").length) {
      var receivedCash = {{ $receivedCash }}; ///// amader RedirectUsersController.php theke amader ai variable gulo string aakara ashche tai amra ai variable guloke json_encode() ar moddhe rap kore dei ni jodi amader ai variable tar moddhe kono array ashto tahole amra amader ai variable take json_encode() ar moddhe rap kore ditam  
      var pendingCash = {{ $pendingCash }};
      var processingCash = {{ $processingCash }};
      
      var areaData = {
        labels: ["CashReceived($)","CashPanding($)","CashProcessing($)"],
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
    });
})(jQuery);
</script>



<!--============= This script is for Sales Chart Canvas ==========--> 
<script>

$(function() {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  var data = {
    labels: {{ json_encode($years) }},  ////akhane amder $years variable ar moddhe theke jei koita year ar nam pabe oi koita year ar nam ee amader sales chart ar niche show korbe.....and amader RedirectUsersController.php ar moddhe theke jehetu ai variable ta ashche and ai variable ar value hishebe amra akta array pacchi and oi PHP array take amra json object a convart kore niyechi amader variable take json_encode() ar moddhe rap kore...aita amader oi PHP array take json object aa convart kore nebe...json object niye javascript sohoje kaj korte pare..and aita amader script injection attacks theke rokkha kore  
    datasets: [{
      label: '# of Sales($)',
      data:  {{ json_encode($yearlySales) }}, ////akhane amder $yearlySales variable ar moddhe theke protita specific year ar sale ar taker poriman ta ashbe....and amader RedirectUsersController.php ar moddhe theke jehetu ai variable ta ashche and ai variable ar value hishebe amra akta array pacchi and oi PHP array take amra json object a convart kore niyechi amader variable take json_encode() ar moddhe rap kore...aita amader oi PHP array take json object aa convart kore nebe...json object niye javascript sohoje kaj korte pare..and aita amader script injection attacks theke rokkha kore  
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,   ///// aikhane beginAtZero:true, diye ami bole diyechi amader YAxes ar man ta akdom 0 theke shuru hobe..
          max: {{ $maximumSellingAmount }},   // akhane ami max: diye bole diyechi amader YAxes ar number ta max $maximumSellingAmount ai variable ar value ta ja hobe toto porjonto hobe
          stepSize: 20,  //// akhane stepSize diye ami bole diyechi amader YAxes ar number ta koi ghor por por hobe
        },
        gridLines: {
          color: "rgba(204, 204, 204,0.1)"
        }
      }],
      xAxes: [{
        gridLines: {
          color: "rgba(204, 204, 204,0.1)"
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }
  };   
  // Get context with jQuery - using jQuery's .get() method.
  if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
  }   
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