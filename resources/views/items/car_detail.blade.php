@extends('layouts/master')
@section('title')
  Car Details
@endsection
@section('home')
  Home
@endsection
@section('client')
  Client
@endsection
@section('add')
  <a class="navLink" href="{{url("car_update_interface")}}/{{ $car->ID }}">Update </a>

@endsection
@section('document')
  <a class="navLink" href="{{ url("car_delete")}}/{{ $car->ID }}"> Delete</a>

@endsection
@section('body')
  <h4>Car detail:</h4>
  <table>
    <tr><th>Rego</th><th>Make</th><th>Model</th><th>Year</th><th>Odometer</th><th>Color</th></tr>
    <tr><td>{{ $car->rego }}</td> <td> {{ $car->make }}</td><td> {{ $car->model }}</td><td> {{ $car->year }}</td><td> {{ $car->odometer }}</td><td> {{ $car->color }}</td></tr> 

  </table>
  <h4>Booking information for this car:</h4>
  <table>
    <tr><th>Client Name</th><th>License Number</th><th>Start Date</th><th>Start Time</th><th>Return Date</th><th>Return Time</th><th>Return</th></tr>
  @foreach ($bookings as $booking )
      <td>{{ $booking->name }}</td><td>{{ $booking->licenseNumber }}</td><td> {{ $booking->startDate }}</td><td> {{ $booking->startTime }}</td><td> {{ $booking->returnDate }}</td><td> {{ $booking->returnTime }}</td><td><a href="{{url("car_return_interface")}}/{{ $car->ID }}/{{  $car->rego }}/{{ $booking->licenseNumber }}/{{ $booking->name }}/{{ $booking->ID }}">Return</a></td></tr>
   @endforeach
    </table>
  
@endsection