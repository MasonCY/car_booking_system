@extends('layouts/master')
@section('title')
  Book
@endsection
@section('home')
  Home
@endsection
@section('client')
  Client
@endsection
@section('add')
  <a href="{{url("booking")}}"><span span style="color: red">Book</span> </a>
@endsection
@section('document')
  Document
@endsection
@section('body')
<h4>Book a car:</h4>
<form method="post" action="add_booking">
  {{ csrf_field() }}
  <table>
  <tr> <td> Name:</td> 
  <td><select name='name'>
      @foreach($clients as $client)
        <option>{{ $client->name }}</option>
      @endforeach
  </select></td>
  </tr>
  
  <tr><td> Licence Number: </td>
  <td><select name='license_number'>
    @foreach($clients as $client)
      <option>{{ $client->licenseNumber }}</option>
    @endforeach
  </select></td></tr>
    <tr><td>Rego: </td> 
    <td><select name='rego'>
      @foreach($cars as $car)
        <option>{{ $car->rego }}</option>
      @endforeach
    </select></td></tr>
      @if(!empty($errorMsg))
        <tr><td>Start Date:</td>
          <td><input type="date" name='start_date' value= {{$start_date}}></td></tr>
        <tr><td>Start Time:</td>
          <td><input type="time" name='start_time' value= {{ $start_time }}></td></tr>
    
        <tr><td>Return Date:</td>
        <td><input type="date" name='return_date' value= {{ $return_date }}></td></tr>
    
        <tr><td>Return Time:</td>
          <td><input type="time" name='return_time' value={{ $return_time }}></td></tr>
        @foreach ($errorMsg as $error )
        <tr><td colspan="2"><h6 style="color:#FF0000"> {{ $error }}</h6></td></tr>     
        @endforeach
      @else
        <tr><td>Start Date:</td>
          <td><input type="date" name='start_date'></td></tr>
        <tr><td>Start Time:</td>
          <td><input type="time" name='start_time'></td></tr>
    
        <tr><td>Return Date:</td>
        <td><input type="date" name='return_date'></td></tr>
    
        <tr><td>Return Time:</td>
          <td><input type="time" name='return_time'></td></tr>
      @endif
      <tr><td colspan="2">Please check the information above and click on add: </td></tr>
    <tr><td colspan="2"><input type="submit" value="Add" class="button_add_book"></td></tr>
  </table>
</form>






@endsection