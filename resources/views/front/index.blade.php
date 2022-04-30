<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Kourosh gharehdaghi</title>
  @yield('meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{asset('front/css/app.css')}}" rel="stylesheet">
  <!-- Favicons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Google recaptcha -->
    {!! htmlScriptTagJsApi(['lang'=>'fa']) !!}
</head>
<body>
      @yield('content')

  <script src="{{url('front/js/app.js')}}"></script>
  @yield('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
</body>
</html>
