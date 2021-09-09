@extends('layouts/master')
@section('title')
  Car Return
@endsection
@section('home')
  Home
@endsection
@section('client')
  Client
@endsection
@section('body')
<form method="post" action="{{url("car_return")}}">
  {{ csrf_field() }}

    <table>
      <tr><td >Rego: </td><td><span style="color: red">{{ $rego }}</span></td></tr>
      <tr><td >Name: </td><td><span style="color: red">{{ $name }}</span></td></tr>
      <tr><td >Liencese Number: </td><td><span style="color: red">{{ $licenseNumber }}</span></td></tr>
      
      @if (!empty($errorMsg))
         <tr><td>please enter odometer you used: </td><td><input type="text" name="odometer" value={{ $odometer }}></td></tr>
         <tr><td colspan="2"><h6 style="color:#FF0000"> {{ $errorMsg }}</h6></td></tr>
      @else
          <tr><td>please enter odometer you used: </td><td><input type="text" name="odometer"></td></tr>
      @endif
      <tr><td colspan="2">Please check the information above and click on return: </td></tr>
      <tr><td colspan=2><input type="submit" value="Return" class="button_add_book"></td></tr> 
 
    </table>
      <input type="hidden" name="carID" value={{ $carID }}>
      <input type="hidden" name="clientID" value={{ $clientID }}>
      <input type="hidden" name="rego" value={{ $rego }}>
      <input type="hidden" name="name" value={{ $name }}>
      <input type="hidden" name="licenseNumber" value={{ $licenseNumber }}>
</form>
@endsection