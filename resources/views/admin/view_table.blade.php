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

                <h1>All Tables</h1>
                <div>
                    <table>
                        <tr>
                            <th>Table Number</th>
                            <th>Table Capcity</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        
                        @foreach($data as $table)
                        <tr>
                            <td>{{$table->id}}</td>
                            <td>{{$table->capacity}}</td>
                            <td>{{$table->details}}</td>
                            <td>{{$table->status}}</td>
                            <td>
                                <a class = "btn btn-danger" onclick = "return confirm('Are you sure to delele this')"href="{{url('delete_table', $table->id)}}">Delete</a>
                            </td>
                            <td>
                                <a class = "btn btn-warning" href="{{url('update_table', $table->id)}}">Update</a>
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