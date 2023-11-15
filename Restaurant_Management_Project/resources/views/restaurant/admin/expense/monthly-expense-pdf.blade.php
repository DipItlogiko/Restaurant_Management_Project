<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/favicon.png" />
    <title>Monthly Expenses PDF!</title>     
    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts  (aita hocche amader pdf file mane pdf file ar sob degien aikhane kora and amra pdf ar jonno laravel ar akta packeg use korchi jar nam DomPdf jokhon amra DomPdf use korbo and aivabe kono font add korbo tokhon amader error ashte pare jodi ai font ta amader DomPdf ar moddhe na thake to kono font add kote hole amader ai jinish gulo korte hobe jemon ami aikhae ai font ta add korar pore amar akta error ashechilo oi error aa bola chilo amader laravel application ar moddhe storage ar moddhe kono fonts name directory khuje pai ni and oi directory ar moddhe kono font khuje pai ni..tokon amader akata kaj kote hobe amader DomPdf package ta install korar pore amader vendor ar moddhe giye dompdf directory ar moddhe jete hobe and dompdf directory ar moddhe je lib name directory ta ache kor moddhe giye fonts directoy ar moddhe jete hobe and jei font ta amra ai page use korte cacchi oi font ta aage google theke download korte hobe and download korar pore amader oi download kora font ar directory ar moddhe je .ttf extension soho jei file gulo ache oi file gulo copy kore amader vendor/dompdf/fonts ar moddhe pest kore dite hobe and amader storage directory ar moddhe akta directory create korte hobe fonts name taholei hoye jabe..tar pore jokhon amra amader application ta run korbo and pdf file ta show korbo tokhon amra dekhte pabo amader storage directory ar moddhe amra jei fonts name directory ta create korechilam oi fonts directory ar moddhe amader font ar file gulo autometically chole ashbe...and amader ai view page ar modde $monthlyExpenses and $totalAmount ai 2 ta variable ashche amader MonthlyExpenseController.php theke)-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">
    <style>
        /* Custom css for the PDF  */
        body {
            font-size: 14px;
            
        }        

        .brand-name{
            font-family: "Satisfy", sans-serif;
            font-size: 1.9em;            
            
        }

        hr.style1{
	     border-top: 1px solid #8c8b8b;
        }

        /* Custom styling for table borders */
        .table-bordered {
            border: 1px solid #ebf0f4;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ebf0f4;
        }

        .bg{
            background-color: black;
        }

        .color{
            color: white;
        }

         
        /* end  */
    </style>
</head>
<body>

<div class="m-2">     
        
    <img src="macdonald'sPDF.png" height="80px" width="80px" alt="img" class="img-fluid">  <!---ai image ta ashche amader laravel application ar public directory theke oi directory ar moddhe macdonald'sPDF.png ai name akta image ache--->
    <p class="brand-name p-0 m-0">McDonald's</p> 
    <p class="text-muted p-0 m-0">Monthly Expenses Report</p><hr class="style1">
        
        
    <div class="text-end pt-2">
        <p class="p-0 m-0"><strong>Address:</strong>110 Retreat Avenue,Birmingham</p>
        <p class="p-0 m-0"><strong>Email:</strong>mcdonald'srestaurant@gmail.com</p>
        <p class="pb-5 m-0"><strong>Number:</strong>0156568485455</p>
    </div>
   

    <table class="table table-bordered table-striped text-center">
        <thead class="bg color">
        <tr>
            <th scope="col">Expense Type</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Date/Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($monthlyExpenses as $expense)
            <tr>
                <td>{{ $expense->expense_type }}</td>
                <td>{{ $expense->description }}</td>
                <td>${{ $expense->total_amount }}</td>
                <td>{{ $expense->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="text-end"><strong>Total Expenses Amount:</strong> ${{ $totalAmount }}</p>
</div>

<!-- Bootstrap JS and Popper.js from CDN (required for Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


 
