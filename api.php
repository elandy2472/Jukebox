<?php

$apiUrl = "https://api.ejemplo.com/songs";


$apiToken = "Api_token";

function getSongsFromAPI($url, $token) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}


$songs = getSongsFromAPI($apiUrl, $apiToken);
?>
