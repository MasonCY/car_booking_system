@extends('layouts/master')
@section('title')
  Car
@endsection
@section('home')
  <label class="home">Home</label> 
@endsection
@section('client')
  Client
@endsection
@section('add')
  <a class="navLink" href="{{url("booking")}}">Book </a>
@endsection
@section('document')
<a class="navLink" href="#">Document</a>
@endsection
@section('body')
    <h4 class="home_h4">Car information:</h4>
    <form method="get" action="car_add_interface">
    <table>
      <tr><th>Redo</th> <th>Make</th> <th>Model</th> <th>Year</th> <th>Odometer</th><th>Color</th></tr>
    
     <ul>
    @foreach ($cars as $car )
      
      <tr><td><a href="{{url("car_detail")}}/{{ $car->ID}}">{{ $car->rego }}</a></td><td>{{ $car->make }}</td><td>{{ $car->model }}</td><td>{{ $car->year }}  </td><td>{{ $car->odometer }}  </td><td>{{ $car->color }} </td></tr>
      
   
    @endforeach
    <tr><td colspan="6">Please check the information above and click on add: </td></tr>
      <tr><td colspan="6"><input type="submit" value="Add" class="button_add_book"></td></tr>  
    </table>

    </form>
    {{-- <a href="add_car_interface"><h4 class="button_add_car">Add Car</h4></a> --}}
@endsection