<!DOCTYPE html>
<html lang="en">

<head>

  <title>Login</title>
  @include('elements.head')

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">
        @if (session('status'))
        <div class="alert alert-danger text-left" style="margin-top: 10px">
            {{ session('status') }}
        </div>
        @endif
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post" action="/login">
                    {{ csrf_field() }}
                    @if ($errors->has('message'))
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                    @endif
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="user-name" name="name" placeholder="Enter Your Username...">
                      @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="user-password" name="password" placeholder="Password">
                      @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <div class="text-center">

                    <a class="small" href="/register">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  @include('elements.foot')

</body>

</html>
