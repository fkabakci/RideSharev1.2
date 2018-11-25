<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DistanceMatrix
 *
 * @author fkabakci
 */
class DistanceMatrix {
    
    public static $API_KEY = "AIzaSyCnzR-kc9lTpfzedJwcGlC--QGDqe7EIng";  
    
    public static function getCoordinates($city, $street, $province) {
        $address = urlencode($city.','.$street.','.$province);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=". DistanceMatrix::$API_KEY;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        $status = $response_a->status;

        if ( $status == 'OK' )
        {
            return array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
        }
        else {
            echo "An error has occured. Please try again later.<br>";
            echo "Error Code:". $status. "<br>";
            return FALSE;
        }
    }
    
    final public static function getTripInfo($lat1, $lat2, $long1, $long2) {
        
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1.
        "&destinations=".$lat2.",".$long2."&units=imperial&mode=driving&key=".DistanceMatrix::$API_KEY;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        ini_set('max_execution_time', 300);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);
        $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
        $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

        return array('distance' => $dist, 'time' => $time);
    }
    
    final public static function getTripInfoByHaversine($lat1, $lat2, $long1, $long2) {
        // convert from degrees to radians
        $theta = $long1 - $long2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $d = $dist * 60 * 1.1515;
        $t = ($d / 65) * 60;
        
        return array('distance' => $d, 'time' => $t);
    }
    
    function getDist($origin, $target) {
        $coordinates1 = DistanceMatrix::getCoordinates($origin, "", "");
        $coordinates2 = DistanceMatrix::getCoordinates($target, "", "");
        
        if (!$coordinates1 || !$coordinates2)
        {
           return 0;
        }
        else
        {
            return DistanceMatrix::getTripInfo($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
        }
    }

}
