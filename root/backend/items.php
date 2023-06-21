<?php

$data = array(
    array(
        'id' => '1',
        'name' => 'borger',
        'price' => '7.99',
        'description' => 'Gąbka, kapeć, 2 sosy i 1 pikiel. Tylko tyle i aż tyle'
    ),
    array(
        'id' => '2',
        'name' => 'iceCream',
        'price' => '14.99',
        'description' => 'Czy wiedziałeś że maszyny do lodów w MC to scam?'
    ),
);

// Encode the data as JSON
$jsonData = json_encode($data);

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Echo the JSON string
echo $jsonData;
?>