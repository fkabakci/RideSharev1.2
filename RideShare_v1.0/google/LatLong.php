<?php


class LatLong {
    public static function getVals($address) {
    $address = str_replace(" ", "+", $address);

    $json = json_decode(file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address"));

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    return $lat.','.$long;
    }
}

