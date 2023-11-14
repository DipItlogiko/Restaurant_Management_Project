<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" />
    <title>Monthly Expenses PDF!</title>     
    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add custom styles for the PDF as needed */
        body {
            font-size: 14px;
        }
        /* Add any additional styles for your PDF here */
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Monthly Expense Report</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Expense Type</th>
            <th scope="col">Description</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($monthlyExpenses as $expense)
            <tr>
                <td>{{ $expense->expense_type }}</td>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->total_amount }}</td>
                <td>{{ $expense->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>Total Amount: {{ $totalAmount }}</p>
</div>

<!-- Bootstrap JS and Popper.js from CDN (required for Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
