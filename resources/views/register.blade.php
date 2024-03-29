<!DOCTYPE html>
<html lang="en">

<head>

  <title>Register</title>
  @include('elements.head')

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" action="/register">
              {{ csrf_field() }}
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="User Name">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address">
                  @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>

                <div class="form-group" style="display:none">
                  <input value="staff" class="form-control form-control-user" id="role" name="role">
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password-comfirm" name="password-comfirm" placeholder="Repeat Password">
                    @if ($errors->has('password-comfirm'))
                    <span class="text-danger">{{ $errors->first('password-comfirm') }}</span>
                    @endif
                  </div>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <div class="text-center">
                <a class="small" href="/login">Already have an account? Login!</a>
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
