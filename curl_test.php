<?php
$ch = curl_init('https://www.google.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 🔥 Force the CA file directly here:
curl_setopt($ch, CURLOPT_CAINFO, 'C:/ApiFiles/cacert.pem');

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch) . PHP_EOL;
} else {
    echo 'Curl executed successfully' . PHP_EOL;
}
curl_close($ch);
