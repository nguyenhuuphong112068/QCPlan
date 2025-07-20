  <aside class="main-sidebar sidebar-light-primary elevation-4" style="height: 100vh;";>

    <!-- Brand Logo -->
    <a href="{{ route ('pages.general.home')}}" class="brand-link container d-flex justify-content-center align-items-center">
      <img src="{{ asset('img/iconstella.svg') }}"
           alt="AdminLTE Logo"
           style="opacity: .8 ; max-width:43px; hight: auto">
    </a>

   <!-- Sidebar user (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 container d-flex justify-content-center align-items-center">
      
    </div> --}}

    <!-- Sidebar -->
    <div class="sidebar" >

      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Droplist Menu Dữ Liệu Gốc  -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dữ Liệu Gốc
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route ('pages.materData.productName.list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tên Sản Phẩm</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route ('pages.materData.Testing.list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chỉ Tiêu Kiểm</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route ('pages.materData.Instrument.list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết Bị Kiểm Nghiêm</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route ('pages.materData.Groups.list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tổ Kiểm Nghiêm</p>
                </a>
              </li> 

              <li class="nav-item">
                <a href="{{ route ('pages.materData.Testing.list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kiểm Nghiêm Viên</p>
                </a>
              </li>   

            </ul>
          </li>


            <!-- Droplist Menu Danh Muc  -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Danh Mục Sản Phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Sản Phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Thiết Bị</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dánh Sách Kiểm Nghiệm Viên</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Định Mức Kiểm Nghiệm</p>
                </a>
              </li>
            </ul>
          </li>




            <!-- User-->
          <li class="nav-item">
            <a href="{{ route ('pages.User.list') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quản Lý User
              </p>
            </a>
          </li>

          <!-- One Menu -->
          {{-- <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Audit Trail
                {{-- <span class="right badge badge-danger">New</span> 
              </p>
            </a>
          </li> --}}
          
        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>