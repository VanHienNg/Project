<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin</title>

  <!-- Custom fonts for this template -->
  <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('template/css/sb-admin-2.css') }}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Staffs</a>
            <a class="collapse-item" href="cards.html">Products</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
            @if(auth() -> check())
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline" id="user-login-name" style="font-size:20px; color:#5a5d6a">{{ auth()->user()->name }}</span>
                <img class="img-profile" style="height:40px;width:40px" src="{{ asset('template/img/user-icon.jpg')}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
              @endif
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Staffs</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="row">
                <h6 class="col-6 m-0 font-weight-bold text-primary">DataTables Example</h6>
                <div class="col-6 text-right">
                  <button class="btn btn-primary" id="create-new-user">Add Staff</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody id="users-latest">
                    @foreach ($users as $user)
                      <tr id="user_id_{{ $user->id }}">
                        <td>1</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><button id="edit-user" data-id="{{ $user->id }}" class="btn btn-primary">Edit</button></td>
                        <td><button id="delete-user" data-id="{{ $user->id }}" class="btn btn-danger">Delete</button>
                        <td><button id="show-pruduct" data-id="{{ $user->id }}" class="btn btn-primary">Show product</button></td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                {{ $users -> links() }}
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Edit and Register Modal -->
  <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="userForm" name="userForm" method="post" class="form-horizontal">
        {{ csrf_field() }}
          <div class="modal-header">
              <h4 class="modal-title" id="userCrudModal"></h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="user_id" id="user_id">
              <div class="form-group" style="margin-top:10px">
                  <label for="name" class="col-sm-6 control-label">Name:</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                    <p class="error" style="display:none"></p>
                  </div>
              </div>

              <div class="form-group" style="margin-top:10px">
                  <label class="col-sm-6 control-label">Email:</label>
                  <div class="col-sm-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="">
                    <p class="error" style="display:none"></p>
                  </div>
              </div>

              <div class="form-group" style="margin-top:10px">
                  <label class="col-sm-6 control-label">Email:</label>
                  <div class="col-sm-12">
                      <select class="col-sm-4 form-control" name="role" id="role" name="role" value="" require="">
                        <option>-- Role --</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                      </select>
                  </div>
              </div>

              <div class="form-group" style="margin-top:10px">
                  <label class="col-sm-6 control-label">Password:</label>
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required="">
                    <p class="error" style="display:none"></p>
                  </div>
              </div>

              <div class="form-group" style="margin-top:10px">
                  <label class="col-sm-6 control-label">Password Confirm:</label>
                  <div class="col-sm-12">
                    <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Refill Password" value="" required="">
                    <p class="error" style="display:none"></p>
                  </div>
              </div>         
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
  
  <!-- Page level ajax scripts -->
  <script src="{{ asset('template/js/ajax.js') }}"></script>
</body>

</html>
