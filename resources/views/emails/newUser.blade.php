<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
<h2>This is the invoice mail</h2>
<h2>Hello {{$invoicedata->customer_name}}</h2>
<h2>Invoice date:{{$invoicedata->invoice_date}}</h2>
<h2>Invoice Total Tax Amount:{{$total_tax}}</h2>
<h2>Invoice Amount:{{$invoicedata->invoice_amount}}</h2>
</body>
</html>
