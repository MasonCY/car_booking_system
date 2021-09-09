@extends('layouts/master')
@section('title')
  Client
@endsection
@section('home')
  Home
@endsection
@section('client')
  <label class="client">Client</label> 
@endsection
@section('add')
  <a class="navLink" href="{{url("booking")}}">Book </a>
@endsection
@section('document')
<a class="navLink" href="#">Document</a>
@endsection
@section('body')
  <h4>Client information: </h4>
  <table>
      <tr><th>Name</th><th>Age</th><th>License_Number</th><th>License_type</th><th>Email</th></tr>
      @foreach ($clients as $client)
        <tr><td>{{ $client->name }}</td><td>{{ $client->age }}</td><td>{{ $client->licenseNumber }}</td><td>{{ $client->licenceType }}</td><td>{{ $client->email }}</td></tr>
          
      @endforeach
  </table>
  <a href="searchForCar">Search</a>
  <a href="test">Test</a>
@endsection