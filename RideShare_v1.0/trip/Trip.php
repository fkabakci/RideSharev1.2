<?php

class Trip {
    var $id;
    var $driverId;
    var $from;
    var $to;
    var $time1;
    var $time2;
    var $date;
    var $mile;
    var $duration;
    var $cost;
    
    var $milesAway;
    
    function __construct($id, $driverId, $from, $to, $time1, $time2, $date, $mile, $duration, $cost, $milesAway) {
        $this->id = $id;
        $this->driverId = $driverId;
        $this->from = $from;
        $this->to = $to;
        $this->time1 = $time1;
        $this->time2 = $time2;
        $this->date = $date;
        $this->mile = $mile;
        $this->duration = $duration;
        $this->cost = $cost;
        $this->milesAway = $milesAway;
    }
    
    public static function getCoordinates($city) {   
        $row = RideShareDb::select("SELECT * FROM city WHERE city LIKE '%". $city. "%'");
        $lat = $row['lat'];
        $lon = $row['lon'];
        
        return array('lat' => $lat, 'lon' => $lon);
    }
    
    public static function getDistance($origin, $target) {
        $coordinates1 = Trip::getCoordinates($origin);
        $coordinates2 = Trip::getCoordinates($target);
        
        $lat1 = $coordinates1['lat'];
        $lat2 = $coordinates2['lat'];
        $long1 = $coordinates1['lon'];
        $long2 = $coordinates2['lon'];
                
        // convert from degrees to radians
        $theta = $long1 - $long2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $d = $dist * 60 * 1.1515;
        $t = ($d / 65) * 60;
        
        return array('distance' => $d, 'time' => $t);
    }
}
