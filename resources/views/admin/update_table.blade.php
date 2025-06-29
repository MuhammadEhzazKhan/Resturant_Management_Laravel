<!DOCTYPE html>
<html>
  <head> 
        <base href="/public">
        @include('admin.css')

        <style>
            .div_deg
            {
                padding:10px;
            }
            level
            {
                display:inline-block;
                width:200px;
            }
        </style>
  </head>
  <body>

    @include('admin.header')

    @include('admin.sidebar')

      <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
           
                <h1>Update Food</h1>
                <form action = "{{url('edit_table', $table->id)}}" method="post">
                    @csrf
                    <div class="div_deg">
                        <label for="">
                            Table Number
                        </label>
                        <input type="text" name="id" value = "{{$table->id}}">
                    </div>

                    <div class="div_deg">
                        <label for="">
                            Capacity
                        </label>
                        <input type="text" name="capacity" value = "{{$table->capacity}}">
                    </div>
                    
                    <div class="div_deg">
                        <label for="">
                            Details
                        </label>
                        <textarea name="details" id="">{{$table->details}}</textarea>
                    </div>

                    <div class="div_deg">
                        <label for="">
                            Status
                        </label>
                        <input type="text" name="status" value = "{{$table->status}}">
                    </div>

                    <div class="div_deg">
                        <input class = "btn btn-warning" type="submit" value="Update Food">
                    </div>
                </form>
                

            </div>    
        </div>
    </div>
    <!-- JavaScript files-->
        @include('admin.js')
  </body>
</html>