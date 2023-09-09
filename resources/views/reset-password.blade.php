<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    
   <style>
    .form-control:focus {
      border-color: #ddca5d;
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(219, 189, 18, 0.6);
    }
    </style>
</head>
<body>
  <main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"style="margin-top: 50px">
                    <div class="card-header bg-warning text-light" style="font-size: 18px"><b>Reset Password</b></div>
                    <div class="card-body" style="background-color: rgb(243, 239, 239)">
  @if (Session::has('status'))
  <div class="alert alert-success" role="alert">
     {{ Session::get('status') }}
 </div>
  @endif
  @if ($errors->any())
  @foreach ($errors->all() as $error)
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Danger!</strong> {{$error}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endforeach
  @endif
    <form method="POST" action="{{route('resetPassword')}}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">New Password</label>
          <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Enter New Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirmed Password</label>
            <input type="password" class="form-control" name="confirmed_password" value="{{old('confirmed_password')}}" placeholder="Enter Confirmed Password">
          </div>
        <button type="submit" class="btn btn-warning text-light">Reset Password</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</main>
</body>
</html>