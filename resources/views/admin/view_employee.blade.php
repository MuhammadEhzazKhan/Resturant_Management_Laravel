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

                <h1>All Employees</h1>
                <div>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Salary</th>
                            <th>Duty Timing</th>
                            <th>Date Of Joining</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        
                        @foreach($data as $employee)
                        <tr>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->role}}</td>
                            <td>{{$employee->phone}}</td>
                            <td>{{$employee->salary}}</td>
                            <td>{{$employee->shift_timing}}</td>
                            <td>{{$employee->date_of_joining}}</td>
                            <td>
                                <a class = "btn btn-danger" onclick = "return confirm('Are you sure to delele this')"href="{{url('delete_employee', $employee->id)}}">Delete</a>
                            </td>
                            <td>
                                <a class = "btn btn-warning" href="{{url('update_employee', $employee->id)}}">Update</a>
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