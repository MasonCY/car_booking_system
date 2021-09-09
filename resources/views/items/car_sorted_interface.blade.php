@extends('layouts/master')
@section('title')
  Car
@endsection
@section('home')
  Home
@endsection
@section('client')
  Client
@endsection
@section('document')
<a class="navLink" href="#">Document</a>
@endsection
@section('body')
<table>
  <tr><th>Redo</th> <th>Make</th> <th>Model</th> <th>Year</th> <th>Odometer</th><th>Color</th><th>Booking Times</th></tr>

 <ul>
  @foreach($keys as $key)
    @foreach ($cars as $car )
      @if($key == $car->ID)
        <tr><td><a href="{{url("car_detail")}}/{{ $car->ID}}">{{ $car->rego }}</a></td><td>{{ $car->make }}</td><td>{{ $car->model }}</td><td>{{ $car->year }}  </td><td>{{ $car->odometer }}  </td><td>{{ $car->color }} </td><td>{{ $carNumberArray[$key] }} </td></tr>
        @break
      @endif    
   @endforeach
  @endforeach

  @foreach($cars as $car)
      <?php $mode = true; ?> 
    @foreach ($keys as $key )
      @if($car->ID == $key)
        <?php $mode = false; ?> 
       @break
      @endif    
    @endforeach
    @if($mode)
      <tr><td><a href="{{url("car_detail")}}/{{ $car->ID}}">{{ $car->rego }}</a></td><td>{{ $car->make }}</td><td>{{ $car->model }}</td><td>{{ $car->year }}  </td><td>{{ $car->odometer }}  </td><td>{{ $car->color }} </td><td>0 </td></tr>
    @endif
  @endforeach
</table>



@endsection