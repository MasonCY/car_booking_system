@extends('layouts/master')
@section('title')
  update car
@endsection
@section('home')
  Home
@endsection
@section('body')
<h4>Update car:</h4>
  <form method="post" action="{{url("car_update")}}">
    {{ csrf_field() }}
    @if(empty($errorMsg))
      <table>
        <tr><td >Rego: </td><td><span style="color: red">{{ $car->rego }}</span></td></tr>
        <tr><td>Make: </td><td><input type="text" name="make" value={{ $car->make }}></td></tr>
        <tr><td>Model: </td><td><input type="text" name="model" value={{ $car->model }}></td></tr>
        <tr><td>Year: </td><td><input type="text" name="year" value={{ $car->year }}></td></tr>
        <tr><td>Odometer: </td><td><input type="text" name="odometer" value={{ $car->odometer }}></td></tr>
        <tr><td>Color: </td><td><input type="text" name="color" value={{ $car->color }}></td></tr>
        <tr><td colspan="2">Please check the information above and click on add: </td></tr>
        <tr><td colspan=2><input type="submit" value="Update" class="button_add_book"></td></tr>
      </table>
      <input type="hidden" name="rego" value={{ $car->rego }}>
      <input type="hidden" name="ID" value={{ $car->ID }}>
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
      <input type="hidden" name="rego" value={{ $car[0] }}>
      <input type="hidden" name="ID" value={{ $id }}>
    @endif


  </form>
    
@endsection