<!DOCTYPE html>
<html>
  <head> 
        @include('admin.css')

        <style>
            table
            {
                border:1px solid skyblue;
                margin: auto;
                width: 800px;
            }
            th
            {
                background: skyblue;
                color: white;
                padding: 10px;
                margin: 10px;
            }
            td
            {
                color: white;
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

                <h1>All Foods</h1>
                <div>
                    <table>
                        <tr>
                            <th>Food Title</th>
                            <th>Food Details</th>
                            <th>Food Price</th>
                            <th>Food Image</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        
                        @foreach($data as $food)
                        <tr>
                            <td>{{$food->title}}</td>
                            <td>{{$food->detail}}</td>
                            <td>{{$food->price}}</td>
                            <td>
                                <img width = "150" src="food_img/{{$food->image}}" alt="">
                            </td>
                            <td>
                                <a class = "btn btn-danger" onclick = "return confirm('Are you sure to delele this')"href="{{url('delete_food', $food->id)}}">Delete</a>
                            </td>
                            <td>
                                <a class = "btn btn-warning" href="{{url('update_food', $food->id)}}">Update</a>
                            </td>
                        </tr>

                        @endforeach
                    </table>
                </div>

            </div>    
        </div>
    </div>
    <!-- JavaScript files-->
        @include('admin.js')
  </body>
</html>