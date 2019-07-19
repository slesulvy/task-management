<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task Manager | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="{{ asset('css/interface.css') }}" rel="stylesheet">

</head>

<body class="white-bg flat-bg">
    <div style="padding:20px 0">
        <div class="white-bg shadow-box" style="padding:10px 0;">
            <img src="{{ asset('img/pca_logo.png') }}" class="logo animated fadeIn"/>
        </div>
    </div>
    <div class="middle-box text-center loginscreen animated fadeInDown ">
        <div style="padding:10px;" class="white-bg shadow-box">
            <h3>Welcome to Task Manager</h3>
            <p>Login in. To see it in action.</p>
            {!! session('message') !!}
            <form class="m-t" method="post" role="form" action="{{route('authenticate')}}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Username" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="">Create an account</a>
            </form>
            <p class="m-t"> <small>Task Manager &copy; 2019</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
