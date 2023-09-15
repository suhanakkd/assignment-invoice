<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>

<div class="text-center fw-bold mb-2"><h1>INVOICE FORM</h1></div>
        

        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div><br />
            @endif
            
          </div>
        <div class="container">
            <a href="{{URL('invoice/index')}}" class="btn btn-primary px-5">View Invoice</a><br><br>
            <form class="form-sample"  action="{{url('invoice/store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                   
            <div>
             
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="alphaInput" aria-describedby="emailHelp" name="customer_name">
                       <p id="validationResult" style="color: black"></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Customer Email</label>
                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="customer_email">
                        <label id="error_email" style="color: red;"></label>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">File Upload</label>
                        <input type="file" name="file" accept=".jpg, .png, .pdf" class="form-control" id="fileInput">
                        <div id="message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Invoice Date</label>
                        <input type="text" class="form-control" id="datepicker" aria-describedby="emailHelp" name="invoice_date">
                    </div>
            </div>
    <!-- add row dynamically -->
    <table class="table table-bordered mytable" id="myTable">                <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Total Amount</th>
                <th>Tax Percentage</th>
                <th>Tax Amount</th>
                <th>Net Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be added dynamically here -->
        </tbody>
    </table>

    <button type="button" class="btn btn-primary text-dark" id="addRow">Add Row</button><br><br>
    <input type="text" class="form-control float-end" name="sub_total" id="sub_total" placeholder="Grand Total" readonly><br>
    <button type="submit" class="form-control btn btn-primary text-dark">Submit</button>
</form>
    </div>

    <!-- script -->

    <script>
$(document).ready(function(){
    // Add Row
    $("#addRow").click(function(){
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input type="text" class="form-control productname" name="product_name[]"/></td>';
        cols += '<td><input type="text" class="form-control quantity" name="quantity[]"/></td>';
        cols += '<td><input type="text" class="form-control amount"  name="amount[]"></td>';
        cols += '<td><input type="text" class="form-control total_amount" value="0" readonly  name="total_amount[]"/></td>';
        cols += '<td><select class="form-control selectpicker tax" name="gst[]" data-live-search="true"><option value="" selected>select GST</option><option value="0">Gst0%</option><option value="5">Gst5%</option><option value="12">Gst12%</option><option value="18">Gst18%</option><option value="24">Gst24%</option></select></td>';
        cols += '<td><input type="text" class="form-control tax_amount" value="0" name="tax_amount[]"/></td>';
        cols += '<td><input type="text" class="form-control net_amount" value="0" name="net_amount[]"/></td>';
        cols += '<td><button class="btn btn-danger delete-row">Delete</button></td>';
        newRow.append(cols);
        $("#myTable").append(newRow);
    });
 
    // Delete Row
    $("#myTable").on("click", ".delete-row", fun*ction(){
        $(this).closest("tr").remove();
    });
    // multiply
    $(document).on('keyup','.quantity',function(){
        
        var mrp=$(this).parent().parent().find('.amount').val();
        var payable=$(this).parent().parent().find('.total_amount');
        var qty=$(this).val();
        var amount = qty*mrp;
        payable.val(amount.toFixed(2));
        grand_total();
        });
        $(document).on('keyup','.amount',function(){
        var mrp=$(this).parent().parent().find('.quantity').val();
        var payable=$(this).parent().parent().find('.total_amount');
        var qty=$(this).val();
        var amount = qty*mrp;
        payable.val(amount.toFixed(2));
        grand_total();
        });
        // tax and net amount
        $(document).on('change','.tax',function(){
        var tax=$(this).val();
        var payable=$(this).parent().parent().find('.total_amount').val();
        var tax_amt=payable*tax/100;
        var tax_amount=$(this).parent().parent().find('.tax_amount');
        var net_amount=$(this).parent().parent().find('.net_amount');
        var net_amt=parseFloat(payable)+parseFloat(tax_amt);
        tax_amount.val(tax_amt.toFixed(2));
        net_amount.val(net_amt.toFixed(2));
        grand_total();
        });
});

  $( function() {
    $( "#datepicker" ).datepicker();
  } );
//  file validation

$(document).ready(function() {
    $('#fileInput').on('change', function() {
        var fileInput = document.getElementById('fileInput');
        var file = fileInput.files[0];
        
        if (file) {
            // Check file size (max 3MB)
            if (file.size > 3 * 1024 * 1024) {
                $('#message').html('File size exceeds the maximum limit (3MB).');
                fileInput.value = ''; // Clear the file input to allow reselection
                return;
            }
            
            // Check file type
            var allowedTypes = ["image/jpeg", "image/png", "application/pdf"];
            if (allowedTypes.indexOf(file.type) === -1) {
                $('#message').html('Invalid file type. Supported formats: JPG, PNG, PDF.');
                fileInput.value = ''; // Clear the file input to allow reselection
                return;
            }
            
            $('#message').html('File is valid and can be uploaded.');
        } else {
            $('#message').html('Please select a file.');
        }
    });
});


// email validation
$("#email").keyup(function(){

var email = $("#email").val();
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

if (!filter.test(email)) {
  //alert('Please provide a valid email address');
  $("#error_email").text(email+" is not a valid email");
  email.focus;
  //return false;
} else {
   $("#error_email").text("");
}

});

// name validation
$(document).ready(function() {
    $('#alphaInput').on('input', function() {
        var inputValue = $(this).val();

        // Define a regular expression to match alphabetic characters
        var alphaRegex = /^[a-zA-Z\s'-]+$/;

        // Check if the input matches the regular expression
        if (alphaRegex.test(inputValue)) {
            $('#validationResult').text('Valid alpha character');
        } else {
            $('#validationResult').text('Not a valid alpha character');
        }
    });
});
function grand_total(){
    var total = 0.00;
        $('.net_amount').each(function(){
            total+= parseFloat($(this).val());
        });
        $('#sub_total').val(total.toFixed(2));
}


</script>

</div>
</x-app-layout>

<!-- </body>
</html> -->