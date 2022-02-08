


<div class="container">
    <div class="container-fluid">

@if(Session::has('update'))

       <div class="alert alert-success">{{Session::get('update')}}</div>
@endif

<div class="shop_name" style="text-align: center;">
  <h3 style="text-align: center;"><i>Nino Ecommerce</i></h3>
  <span>Address: <i>Dhaka,Bangladesh</i></span> <br>
  <span>Mobile: 0000000000<i></i></span>
</div>

@php
  $grandtotal = 0;
@endphp



  <h3>Purchase Daily Report:</h3>
    <table id="copy-print-csv" width="100%" border="1">

      <thead>
        <tr>
          {{-- <td>Supliar Name</td> --}}
          <td>Category Name</td>
          <td>Product Name</td>
          <td>Date</td>
           <td>Product Qty</td>
           <td>Product Price</td>
          <td>Total</td>
        </tr>
      </thead>

      <tbody>
        @foreach ($all as $it)
          <tr>

           {{-- <td>{{ $it->supliars['name'] }}</td> --}}
           <td>{{@$it->categorys['category_name'] }}</td>
           <td>{{@$it->products['product_name'] }}</td>
           <td>{{@$it->date }}</td>
             <td>{{@$it->bying_qty }}</td>
             <td>{{@$it->bying_price }}</td>
           <td>{{@$it->subtotal }}</td>

          </tr>

          @php
            $grandtotal +=$it->subtotal;
          @endphp
        @endforeach

        <tr>
          <td colspan="5" style="text-align: right;">GrandTotal</td>
          <td style="text-align: center;">{{ $grandtotal }}</td>
        </tr>
      </tbody>
    </table>


     <hr style="margin: 0px">

     <span><i>Printing Time : {{ date('d-m-Y H:i:s') }}</i></span>

  </div>

  <div>

<table width="100%">
  <tr>
    <td width="70%"><i style="text-decoration: underline;">OWnar Signature:</i></td>
    <td width="30%"><i style="text-decoration: underline;">Customers Signature:</i></td>
  </tr>
</table>

  </div>





   </div>

</body>
</html>

</div>
</div>

