<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="{{secure_asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')}}">
  <link rel="icon" href="{{secure_asset('https://s5.postimg.cc/tctkvpmbb/Picture1.png')}}">
  <!-- jQuery library -->
  <script src="{{secure_asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
  <!-- Latest compiled JavaScript -->
  <script src="{{secure_asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>
</head>
<!-- Body containing Bootstrap's Inverse Colour Collapsable Navbar -->
<body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <!-- UX review logo is a link to home page -->
     <a class="navbar-brand" href="{{url("/")}}"><img src="https://s5.postimg.cc/4l35fq6yv/NEW1.png" height = 50></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="padding-top: 30px;">
        <!-- Navbar contents, with links to different pages -->
        <li><a href="{{url("/")}}">Home</a></li>
        <li><a href="{{url("designers")}}">Designers</a></li>
        <li><a href="{{url("ux_byviews")}}">By Reviews</a></li> 
        <li><a href="{{url("ux_byrating")}}">By Rating</a></li>
        <li><a href="{{url("user_bykarma")}}">Top Reviewers</a></li>
        <li><a href="{{url("documentation")}}">Assignment Documentation</a></li>
      </ul>
    </div>
  </div>
  </nav>
  <div class="container">
    @yield('content')
  </div>
</body>
</html>
