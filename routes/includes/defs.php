<?php
use Illuminate\Support\Facades\DB;
/**
 * add booking
 */
function add_booking($carID,$clientID,$start_date,$start_time,$return_date,$return_time){
    $sql = "insert into booking (carID,clientID,startDate,startTime,returnDate,returnTime) values(?,?,?,?,?,?)";
    DB::insert($sql, array($carID,$clientID,$start_date,$start_time,$return_date,$return_time));
    
}

/**
 * add car, all car information will be stored in an array, and get the id of the added car and return  
 */
function add_car($car){
    $sql = "insert into car (rego,make,model,year,odometer,color) values(?,?,?,?,?,?)";
    DB::insert($sql, array($car[0],$car[1],$car[2],$car[3],$car[4],$car[5]));
    $id = DB::getPdo()->lastInsertID();
    return ($id);
}
/**
 * update car
 */
function update_car($id, $car)
{
    $sql="update car set rego =?,make=?,model=?,year=?,odometer=?,color=? where id=?";
    DB::update($sql, array($car[0],$car[1],$car[2],$car[3],$car[4],$car[5],$id));
}
function update_odometer($carID,$odometer){
    $sql="update car set odometer=odometer+? where ID=?";
    DB::update($sql, array($odometer,$carID));
}
/**
 * function to get all data according to the table name
 */
function get_all($tableName){
    $sql = "select * from $tableName";
    $allData = DB::select($sql);
    return $allData;
}
/**
 * function to get a specific data 
 */
function get_item($tableName, $id){
    $sql = "select * from $tableName where ID =?";
    $item = DB::select($sql, array($id));
    return $item;
}
/**
 * get client id by licenceNumber 
 */
function get_clientID($clientName,$licenseNumber){
    $sql = "select ID, name from client where licenseNumber =?";
    $ID = DB::select($sql, array($licenseNumber));

    if($ID[0]->name == $clientName){
        return $ID[0]->ID;
    }else{
        return false;
    }
}
function get_carID($rego){
    $sql = "select ID from car where rego =?";
    $ID = DB::select($sql, array($rego));
    return $ID[0]->ID;
}
/**
 * delete the car and related booking 
 */
function car_delete($ID){
    $sql = "delete from booking where carID =?";
    DB::delete($sql,array($ID));
    $sql = "delete from car where ID =?";
    DB::delete($sql, array($ID));
}
/***
 * delete booking
 */
function delete_book($carID,$clientID){
    $sql = "delete from booking where carID=? and clientID=?";
    DB::delete($sql,array($carID,$clientID));

}
/**
 * input validation for updata and add car check
*/
function error_check(){
    $errorMsg=[];
    // dump(request());
    $car = [];
    $rego = request('rego');
    if(strlen($rego) != 6 or !ctype_alnum($rego) or empty($rego)){
        $errorMsg[] = "Rego must be 6 nomal characters and cannot be null please check! ";
    }
    
     $make = request('make');
    if(empty($make)){
       $errorMsg[] = "Make cannot be null please check! ";
     }
    $model = request('model');
    if(empty($model)){
        $errorMsg[] = "Model cannot be null please check! ";
      }
     $year = request('year');
    if(strlen($year) != 4 or !is_numeric($year) or empty($year)){
        $errorMsg[] = "Year must be 4-digit numbers and cannot be null please check! ";
    }
     $odometer = request('odometer');
     if( !is_numeric($odometer) or empty($odometer)){
        $errorMsg[] = "Odometer must the the number and canot be null please check! ";
    }
    $color = request('color');
     if(empty($color)){
        $errorMsg[] = "color can not be null! ";
     }

    $car[] = $rego;
    $car[] = $make;
    $car[] = $model;
    $car[] = $year;
    $car[] = $odometer;
    $car[] = $color;
    $carAndErrorMsg = [];
    $carAndErrorMsg[] = $errorMsg;
    $carAndErrorMsg[] = $car;
    return $carAndErrorMsg;
}
/***
 * check error for data and time 
 */
function error_check_datetime($start_date,$start_time,$return_date,$return_time){
    $errorMsg="";
    if($start_date > $return_date){
        $errorMsg="The return date must be later than the start date please check";
    }elseif($startDate = $return_date){
        if($start_time >= $return_time){
            $errorMsg = "The return time must be later that the start time when booking and return on the same day please check!";
        }
    }
    return $errorMsg;

}
/**
 * to calculate the total time in hours use strtotime() funtion, 
 * join date and time by .=
 * search all car ids firstly, search dates by the car id from booking table 
 * add all dates into hours stored into the map $totalHousrMpa and return it  
 */
function calculate_total_hours(){
    $totalHoursMap=[];
    $hours = 0;
 
    $sql="select id from car";
    $ids = DB::select($sql);
    $sql="select startDate, startTime, returnDate, returnTime from booking where carID=?";
    foreach($ids as $id){
        $dates = DB::select($sql,array($id->ID));
       
        foreach($dates as $date){
            $startNumber = strtotime($date->startDate .= $date->startTime);
            $endNumber = strtotime($date->returnDate .= $date->returnTime);
            $diff = abs($startNumber-$endNumber)/60/60/24;
            $hours = $hours + $diff;
        }
        
        $totalHoursMap[$id->ID] = $hours; 
        $hours = 0;
    }
    return $totalHoursMap;
}
?>