<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Route Not Found!!!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container ">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6 text-center pt-md-5 mt-md-5">
            <div class="card border-0">
              <img src="{{ asset('404-Error.png') }}" alt="Image" class="img-fluid">  <!--amader ai 404-Error.png file ta amader laravel application ar public directory ar moddhe ache and akhane ami amader ai 404-Error.png file take asset() helper function ar moddhe rekhechi karon amader jei fallback route ta ache jokhon ami eemon kono url diye browser korbo jei url ta amadre routes/web.php ar moddhe amra define kori nai tokhon amader oi fallback route ta kaj korbe kintu akhane akta problem chilo je jodi kew emon url diye browse kore jemon http://127.0.0.1:8000/dip tokhon amader fallback route ar error page ta thik thak vabe kaj korchilo but jokhon ami ai vabe http://127.0.0.1:8000/dip/asdfasdfasdfa browse korchilam tokhon amader fallback route ar error pager ar image ta dekhachilo na tai amra ai problem take solve korar jonno laravel application ar asset() helper method ta use korechi....amader asset() helper method ar moddhe image ar name ta jodi ta dei tahole amader  http://127.0.0.1:8000/dip ai vabe browse korle amader oi fallback route ar error page ar image ta thik thak vabe show korbe but jokon amra http://127.0.0.1:8000/dip/asdfasdfasdfa ai vabe browse korbo tokhon amader fallback route ar error page ar oi image ta dekhabe na karon amar jokhon ai vabe http://127.0.0.1:8000/dip/asdfasdfasdfa browse korbo tokhon base URL ta change hoye jabe tai amader oi image ta dekhabe na ai jonno amader ai asset() helper method ta use korechi -->
              <div class="card-body">                  
                  <h5 class="card-title font text-warning h2">Page Not Found!!!</h5>
                  <a href="{{ url('/') }}" class="btn btn-outline-warning">Go Back</a>
                  <p class="card-text"><small class="text-muted">McDonald's</small></p>
              </div>
          </div> 
          </div>
          <div class="col-md-3"></div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
