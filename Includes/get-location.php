<?php

// This PHP file lets the system to automatically display the user’s location tag in the admin dashboard

// Get user's IP address
// $ip = $_SERVER['REMOTE_ADDR'];

// $ip = '8.8.8.8'; // Google's public IP
$ip = '112.204.174.220'; // or put your Public IP, just for demo

// Get geolocation info from ip-api
$geoData = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));

// Fallback if the request fails
$location = "Unknown Location";

if ($geoData && $geoData->status === "success") {
    $city = $geoData->city;
    $region = $geoData->regionName;
    $country = $geoData->country;
    $location = "$city, $country";
}
?>