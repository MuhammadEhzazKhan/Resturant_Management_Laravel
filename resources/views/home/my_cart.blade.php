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

    <div id="gallary" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <table>
            <tr>
                <th>Food Title</th>
                <th>Food Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Remove</th>
            </tr>

            @php $total_price = 0; @endphp

            @foreach($data as $item)
                <tr>
                    <td>{{ $item->food->title ?? 'N/A' }}</td>
                    <td>Rs.{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        @if($item->food && $item->food->image)
                            <img width="120" src="{{ asset('food_img/' . $item->food->image) }}" alt="Food Image">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td>
                        <a onclick="return confirm('Are you sure to remove this?')" class="btn btn-danger" href="{{ url('remove_cart', $item->id) }}">
                            Remove
                        </a>
                    </td>
                </tr>
                @php $total_price += $item->price; @endphp
            @endforeach
        </table>

        <h3>Total Cart Price: Rs.{{ $total_price }}</h3>
    </div>

    @auth
    <div class="div_center">
    <form method="POST" action="{{ url('generate_invoice') }}">
        @csrf
        <div class="div_deg">
            <input type="submit" value="Generate Invoice" class="btn btn-success">
        </div>
    </form>
</div>

    @endauth

</body>
</html>
