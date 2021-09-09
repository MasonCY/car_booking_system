<!DOCTYPE html>
<html>
  <head>
    <title> @yield('title')</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset("css/wp.css") }}">
  </head>
  
  <body> 
    <div class="container">
        <div class="row" id="navbar">
            <div class="col-md-4" ><a class="navLink" href='{{url('/')}}'> @yield('home')</a> </div>
            <div class="col-md-4 col-sm-3"> <a class="navLink" href="{{url('client')}}" >@yield('client') </a></div>
         

            {{-- <div class="col-md-2 col-sm-4" ><a class="navLink" href='http://192.168.64.4/Car/CarBookingSystem/public/booking'>@yield('add') </a></div>   --}}
            <div class="col-md-2 col-sm-3" >@yield('add')</div>  
            
            <div class="col-md-2 col-sm-3" >@yield('document')</div> 

        </div>
    </div> 
    @yield('body')
    @include('layouts/footer')
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>