<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admin/img/avatar-6 (2).jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Saad Amjad</h1>
            <p>Web Designer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="{{url('home')}}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Food</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('add_food')}}">Add Food</a></li>
                    <li><a href="{{url('view_food')}}">View Food</a></li>
                  </ul>
                </li>
                <li>
                  <a href="{{url('orders')}}"> <i class="icon-logout"></i>Orders</a>
                </li>

                <li>
                  <a href="{{url('invoices')}}"> <i class="icon-page"></i>Invoices</a>
                </li>


                <li>
                  <a href="{{url('reservations')}}"> <i class="icon-logout"></i>Reservations</a>
                </li>

                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Tables</a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('add_table')}}">Add Table</a></li>
                    <li><a href="{{url('view_table')}}">View Tables</a></li>
                  </ul>
                </li>

                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Employee</a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('add_employee')}}">Add Employee</a></li>
                    <li><a href="{{url('view_employee')}}">View Employee</a></li>
                  </ul>
                </li>

        </ul><span class="heading">Extras</span>
        
      </nav>
      <!-- Sidebar Navigation end-->
    