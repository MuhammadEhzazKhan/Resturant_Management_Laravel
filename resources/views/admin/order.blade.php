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

                <table>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Food Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Change Status</th>
                    </tr>

                    @foreach($data as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>{{ $order->user->phone }}</td>
                        <td>{{ $order->user->address }}</td>
                        <td>{{ $order->food->title }}</td>
                        <td>{{ $order->quantity ?? 'N/A' }}</td>
                        <td>{{ $order->food->price }}</td>
                        <td>
                            <img width="100" src="{{ asset('food_img/' . $order->food->image) }}" alt="Food Image">
                        </td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a onclick="return confirm('Are you sure to mark this as On The Way?')" class="btn btn-info" href="{{ url('on_the_way', $order->id) }}">On The Way</a>
                            <a onclick="return confirm('Are you sure to mark this as Delivered?')" class="btn btn-warning" href="{{ url('delivered', $order->id) }}">Delivered</a>
                            <a onclick="return confirm('Are you sure to Cancel this order?')" class="btn btn-danger" href="{{ url('cancel', $order->id) }}">Cancel</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>    
        </div>
    </div>

    @include('admin.js')
  </body>
</html>
