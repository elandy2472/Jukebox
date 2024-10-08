<?php

$apiUrl = "https://www.googleapis.com/youtube/v3/search";
$apiToken = "AIzaSyAzS5LK_3koqYQk8rsVpJRdiPWDNRTLIio";

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

// Verifica si hubo un error en la API
if (isset($songs['error'])) {
    echo "<p>Error: " . htmlspecialchars($songs['error']['message']) . "</p>";
} else if (empty($songs['items'])) {
    echo "<p>No se encontraron canciones.</p>";
} else {
    // Las canciones se procesan y muestran en fav_song.php
}

?>
