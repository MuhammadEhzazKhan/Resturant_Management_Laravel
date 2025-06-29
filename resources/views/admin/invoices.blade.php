<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
        table {
            border: 1px solid skyblue;
            margin: auto;
            width: 1000px;
        }
        th {
            color: white;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            background-color: blue;
            padding: 10px;
        }
        td {
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }
    </style>
  </head>
  <body>

    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <h2 class="text-center text-light mb-4">All Invoices</h2>

                <table>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Amount (Rs.)</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>

                    @php $total_invoice = 0; @endphp

                    @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->order_id }}</td>
                        <td>{{ $invoice->user_id }}</td>
                        <td>{{ $invoice->amount }}</td>
                        <td>{{ $invoice->status }}</td>
                        <td>{{ $invoice->date }}</td>
                    </tr>
                    @php $total_invoice += $invoice->amount; @endphp
                    @endforeach
                </table>

                <h4 class="text-center text-light mt-4">Total Revenue: Rs.{{ $total_invoice }}</h4>

            </div>    
        </div>
    </div>

    @include('admin.js')
  </body>
</html>
