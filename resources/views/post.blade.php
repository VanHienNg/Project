<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post Manager</title>
    @include('elements.head')
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
                <div class="sidebar-brand-text mx-3">SB User</div>
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="#">Staffs</a>
                        <a class="collapse-item" href="#">Products</a>
                    </div>
                </div>
            </li>
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

                    @include('elements.header-navbar')

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="container-fluid">
                                    <!-- Page Heading -->
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">Posts</h1>
                                        
                                        <button class="btn btn-sm btn-primary" id="create-new-post">Add new
                                            Post</button>
                                    </div>
                                    <div class="form-group">
                                        <label for="search">Search: </label>
                                        <input type="text" class="form-controller" id="search-post" name="search">
                                    </div>
                                    <!-- Content Row -->
                                    <div class="row" id="post-latest">
                                        
                                        @include('elements.post-paragraph', $posts)

                                    </div>
                                    {{ $posts -> links() }}
                                </div>
                            </div>
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

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="/logout">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit post and Add new post Modal -->
                <div class="modal fade" id="ajax-post-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="postForm" name="postForm" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h4 class="modal-title" id="postCrudModal"></h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="user_id" id="user_id">
                                    <div class="form-group" style="margin-top:10px">
                                        <label for="title" class="col-sm-6 control-label">Title:</label>
                                        <div class="col-sm-12">
                                            <input style="word-break: break-all" type="text" class="form-control"
                                                id="title" name="title" placeholder="Enter post title" value=""
                                                maxlength="15" required="">
                                            <p class="error" style="display:none"></p>
                                        </div>
                                    </div>

                                    <div class="form-group" style="display:none">
                                        <div class="col-sm-12">
                                            <input id="postId" name="post_id" value="">
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top:10px">
                                        <label for="slug" class="col-sm-6 control-label">Slug:</label>
                                        <div class="col-sm-12">
                                            <textarea style="word-break: break-all" type="text" class="form-control"
                                                id="slug" name="slug" placeholder="Enter slug" value="" maxlength="15"
                                                required=""></textarea>
                                            <p class="error" style="display:none"></p>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top:10px">
                                        <label for="body" class="col-sm-6 control-label">Body:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" rows="4" cols="50" id="body" name="body"
                                                placeholder="Enter body" value="" required=""></textarea>
                                            <p class="error" style="display:none"></p>
                                        </div>
                                    </div>

                                    <div class="form-group" style="display:none">
                                        <div class="col-sm-12">
                                            <input id="userIdPost" name="user_id" value="{{ auth()->user()->id }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="btn-post" value="create">Save
                                        changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

    @include('elements.foot')

</body>

</html>
