<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')

    <style>
        table {
            margin: 40px auto;
            border: 1px solid skyblue;
            padding: 40px;
            width: 90%;
            background-color: #343a40;
        }

        th {
            padding: 10px;
            text-align: center;
            background-color: red;
            color: white;
            font-weight: bold;
        }

        td {
            padding: 10px;
            color: white;
            text-align: center;
        }

        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .div_deg {
            padding: 10px;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    @include('home.navbar')

    <br><br><br><br>

    <div class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <h2 class="mb-4">Invoice Summary</h2>

        <table>
            <tr>
                <th>Invoice ID</th>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            @php $total_invoice = 0; @endphp

            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->order_id }}</td>
                    <td>{{ $invoice->user_id }}</td>
                    <td>Rs.{{ $invoice->amount }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td>{{ $invoice->date }}</td>
                </tr>
                @php $total_invoice += $invoice->amount; @endphp
            @endforeach
        </table>

        <h3>Total Amount Billed: Rs.{{ $total_invoice }}</h3>
    </div>

</body>
</html>
