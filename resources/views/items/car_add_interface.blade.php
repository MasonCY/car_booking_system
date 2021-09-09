@extends('layouts/master')
@section('title')
  add car
@endsection
@section('home')
  Home
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
<h4>Add a new car:</h4>
  <form method="post" action="{{url("car_add")}}">
    {{ csrf_field() }}
    @if(empty($errorMsg))
      <table>
        <tr><td>Rego: </td><td><input type="text" name="rego"></td></tr>
        <tr><td>Make: </td><td><input type="text" name="make"></td></tr>
        <tr><td>Model: </td><td><input type="text" name="model"></td></tr>
        <tr><td>Year: </td><td><input type="text" name="year"></td></tr>
        <tr><td>Odometer: </td><td><input type="text" name="odometer"></td></tr>
        <tr><td>Color: </td><td><input type="text" name="color"></td></tr>
        <tr><td colspan="2">Please check the information above and click on add: </td></tr>
        <tr><td colspan=2><input type="submit" value="Add" class="button_add_book">
      </table>
    @else
    <table>
      <tr><td >Rego: </td><td><input type="text" name="rego" value={{ $car[0] }}></td></tr>
      <tr><td>Make: </td><td><input type="text" name="make" value={{ $car[1] }}></td></tr>
      <tr><td>Model: </td><td><input type="text" name="model" value={{ $car[2] }}></td></tr>
      <tr><td>Year: </td><td><input type="text" name="year" value={{ $car[3] }}></td></tr>
      <tr><td>Odometer: </td><td><input type="text" name="odometer" value={{ $car[4] }}></td></tr>
      <tr><td>Color: </td><td><input type="text" name="color" value={{ $car[5] }}></td></tr>
      @foreach ($errorMsg as $error )
        <tr><td colspan="2"><h6 style="color:#FF0000"> {{ $error }}</h6></td></tr>     
      @endforeach
      <tr><td colspan="2">Please check the information above and click on add: </td></tr>
      <tr><td colspan=2><input type="submit" value="Add" class="button_add_book">
    </table>
    @endif
  </form>
  
@endsection