
<!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      </head>
      <body class="px-3"> 
          
     <div class="text-center"><h1>INVOICE TABLE</h1></div>
     <a href="{{URL('invoice/create')}}" class="btn btn-primary">Add New</a><br><br>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Customer Name</th>
      <th scope="col">Customer Email</th>
      <th scope="col">Invoice Amount</th>
      <th scope="col">Invoice Date</th>
      <th scope="col">Product name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Amount</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Tax Percentage</th>
      <th scope="col">Tax Amount</th>
      <th scope="col">Net Amount</th>
      <th scope="col">Grand Total</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
   
    @foreach($master as $master)
    <tr>
      <td>{{$master->customer_name}}</td>
      <td>{{$master->customer_email}}</td>
      <td>{{$master->invoice_amount}}</td>
      <td>{{$master->invoice_date}}</td>
      <td>
            @php
                $productNames = [];
                foreach($master->detail as $detailed) {
                    $productNames[] = $detailed->product_name;
                }
                echo implode(', ', $productNames);
            @endphp
        </td>

        <td>
            @php
                $quantity = [];
                foreach($master->detail as $detailed) {
                    $quantity[] = $detailed->quantity;
                }
                echo implode(', ', $quantity);
            @endphp
        </td>

        <td>
            @php
                $amount = [];
                foreach($master->detail as $detailed) {
                    $amount[] = $detailed->amount;
                }
                echo implode(', ', $amount);
            @endphp
        </td>

        <td>
            @php
                $total_amount = [];
                foreach($master->detail as $detailed) {
                    $total_amount[] = $detailed->total_amount;
                }
                echo implode(', ', $total_amount);
            @endphp
        </td>

        <td>
            @php
                $tax_percentage = [];
                foreach($master->detail as $detailed) {
                    $tax_percentage[] = $detailed->tax_percentage;
                }
                echo implode(', ', $tax_percentage);
            @endphp
        </td>
    
        <td>
            @php
                $tax_amount = [];
                foreach($master->detail as $detailed) {
                    $tax_amount[] = $detailed->tax_amount;
                }
                echo implode(', ', $tax_amount);
            @endphp
        </td>

        <td>
            @php
                $net_amount = [];
                foreach($master->detail as $detailed) {
                    $net_amount[] = $detailed->net_amount;
                }
                echo implode(', ', $net_amount);
            @endphp
        </td>
        <td>{{$master->invoice_amount}}</td>
      <td><a href="{{URL('invoice/edit/'.$master->id)}}" class="btn btn-primary">Edit</a></td>
      <td><a href="{{URL('invoice/delete/'.$master->id)}}" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

</body>
      </html>
