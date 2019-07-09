
    <!DOCTYPE html>
    <html>

     <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Taskmanager</title>

        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

        <!-- Toastr style -->
        <link href="{{ asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

        <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('css/style.css')}}" rel="stylesheet">
         <link href="{{asset('css/progress.css')}}" rel="stylesheet">
         <link href="{{asset('css/interface.css')}}" rel="stylesheet">

         @yield('customCss')

        

    </head>

    <body>
        <div id="wrapper">

