<!DOCTYPE html>
<html>
  <head> 
        @include('admin.css')

        <style>
            label
            {
                display:inline-block;
                width: 200px;
                color:white;
            }

            .div_deg
            {
                padding:10px;

            }
        </style>
  </head>
  <body>

    @include('admin.header')

    @include('admin.sidebar')

      <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
           
                <form action="{{url('upload_employee')}}" method = "post">
                    @csrf

                    <div class = "div_deg">
                        <label for="">Name</label>
                        <input type="string" name="name" required>

                    </div>
                    <div class = "div_deg">
                        <label for="">Role</label>
                        <input type="string" name="role" required>

                    </div>
                    <div class = "div_deg">
                        <label for="">Phone</label>
                        <input type="string" name="phone" required>

                    </div>
                    <div class = "div_deg">
                        <label for="">Salary</label>
                        <input type="string" name="salary" required>

                    </div>
                    <div class = "div_deg">
                        <label for="">Duty Time</label>
                        <input type="string" name="shift_timing">

                    </div>
                    <div class = "div_deg">
                        <label for="">Date Of Joining</label>
                        <input type="string" name="date_of_joining">

                    </div>
                    <div class = "div_deg">
                        <input type="submit" value="Add Employee" class="btn btn-warning">
                    </div>
                </form>

            </div>    
        </div>
    </div>
    <!-- JavaScript files-->
        @include('admin.js')
  </body>
</html>