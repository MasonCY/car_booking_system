<?php

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
include "includes/defs.php";
use function PHPUnit\Framework\isEmpty;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * home page to get  all cars list  in (item/car) view
 */
Route::get('/', function () {
    $cars = get_all("car");
    return view('items/car')->with('cars', $cars);
});
/**
 * to list car detail(including booking information) according to the id in (item/car_detail) view
 */
Route::get('car_detail/{id}', function($id){
    $car = get_item("car",$id);
    $sql = "select * from client, booking where carID =? and clientID = ID";

    $bookings =DB::select($sql, array($id)); 
    // dump($bookings);
     return view('items/car_detail')->with('car', $car[0])->with('bookings',$bookings);
});
/***
 * add car page
 */
Route::get('car_add_interface', function(){
    return view('items/car_add_interface');
});
/**
 * add car and redirect to the (car_detail/$id) route
 */
Route::post('car_add',function(){
    $carAndErrorMsg= error_check();
    $errorMsg = $carAndErrorMsg[0];
    $car = $carAndErrorMsg[1];
    if(!empty($errorMsg)){
        return view("items/car_add_interface")->with("errorMsg", $errorMsg)->with("car",$car);
    }
    $id = add_car($car);
    return redirect("car_detail/$id");
});
/***
 * 
 */
Route::get('car_update_interface/{id}', function($id){
    $car = get_item('car',$id);
    $allCars = get_all('car');
    return view('items/car_update_interface')->with("car", $car[0])->with('allCars',$allCars);
});
/**
 * get all clients and list in (items/client) view
 */
Route::get('client', function(){
    $clients = get_all("client");
    // dump($clients);
    return view("items/client")->with('clients', $clients);
});
/**
 * display the book page where user can book a car
 */
Route::get('booking', function(){
    $clients = get_all("client");
    $cars = get_all("car");
    return view("items/booking")->with('clients',$clients)->with('cars', $cars);

});
/***
 * delete the car according to id
 */
Route::get('car_delete/{id}', function($id){
    car_delete($id);
    $cars = get_all("car");
    return view('items/car')->with('cars', $cars);

});
Route::post('car_update',function(){
    $id = request('ID');
    $carAndErrorMsg= error_check();
    $errorMsg = $carAndErrorMsg[0];
    $car = $carAndErrorMsg[1];
    if(!empty($errorMsg)){
        return view("items/car_update_interface")->with("errorMsg", $errorMsg)->with("car",$car)->with("id",$id);
    }
    update_car($id, $car);
    return redirect(url("car_detail/$id"));
});

Route::get("car_return_interface/{carID}/{rego}/{licenseNumber}/{name}/{clientID}", function($carID,$rego,$licenseNumber,$name,$clientID){
  
    return view("items/car_return_interface")->with('carID', $carID)->with('rego', $rego)->with('licenseNumber',$licenseNumber)->with('name',$name)->with('clientID', $clientID);
});
Route::post("car_return",function(){

    $carID=request("carID");
    $clientID=request("clientID");
    $odometer=request("odometer");
    $rego=request("rego");
    $licenseNumber=request("licenseNumber");
    $name=request("name");

    if( !is_numeric($odometer) or empty($odometer)){
        $errorMsg = "Odometer must the the number and canot be null please check! ";
        return view("items/car_return_interface")->with('carID', $carID)->with('rego', $rego)->with('licenseNumber',$licenseNumber)->with('name',$name)->with('clientID', $clientID)->with('errorMsg',$errorMsg)->with('odometer',$odometer);
    }
    update_odometer($carID,$odometer);
    delete_book($carID,$clientID);
    return redirect(url("car_detail/$carID"));

});

Route::post('add_booking',function(){
    $errorMsg = [];
    $start_date = request("start_date");
    if(empty($start_date)){ $errorMsg[] = "start date cannot be null!";}
    $start_time = request("start_time");
    if(empty($start_time)){ $errorMsg[] = "start time cannot be null!";}
    $return_date = request("return_date");
    if(empty($return_date)){ $errorMsg[] = "return date cannot be null!";}
    $return_time = request("return_time");
    if(empty($return_time)){ $errorMsg[] = "return time cannot be null!";}
    $error = error_check_datetime($start_date,$start_time,$return_date,$return_time);
    if(!empty($error)){$errorMsg[]=$error;} 
    $clientName = request("name");
    $licenseNumber = request("license_number");
    $rego = request('rego');
    $clientID = get_clientID($clientName, $licenseNumber);
    if(!$clientID){$errorMsg[] ="name does not match the license number";}
    $carID = get_carID($rego);
    if(empty($errorMsg)){
        add_booking($carID,$clientID,$start_date,$start_time,$return_date,$return_time);
        return redirect(url("car_detail/$carID"));
    }else{
        $clients = get_all("client");
        $cars = get_all("car");
        return view('items/booking')->with("errorMsg", $errorMsg)->with("clients",$clients)->with("cars",$cars)->with("start_date", $start_date)->with("start_time", $start_time)->with("return_date",$return_date)->with("return_time",$return_time);
    }
});
/**
 * group by the carID to get the booking times for that car, 
 * store the results in array, and sort the array in descding order
 *  by the build in function arsort which is sort the associative 
 * array according to value
 * get all keys in the array which is the carID by array_keys
 */
Route::get("searchForCar", function(){
    $sql="select id, count(*) as amount from booking, car where id=carID group by carID";
    $results = DB::select($sql);
    $carNumberArray = [];
    $cars=get_all('car');
    foreach($results as $result){
        $carNumberArray[$result->ID] = $result->amount;
    }
    //sort array(descending order) according to value
    arsort($carNumberArray);
    $keys=array_keys($carNumberArray);
    // dd($keys, $carNumberArray);
    return view("items/car_sorted_interface")->with('cars',$cars)->with('carNumberArray',$carNumberArray)->with('keys',$keys);
});
/**
 * test
 */
Route::get('test',function(){
    $cars=get_all('car');
    $carNumberArray = calculate_total_hours();
    arsort($carNumberArray);
    $keys=array_keys($carNumberArray);
    return view("items/car_sorted_hours_interface")->with('cars',$cars)->with('carNumberArray',$carNumberArray)->with('keys',$keys);
});