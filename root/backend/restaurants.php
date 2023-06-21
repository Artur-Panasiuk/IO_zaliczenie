<?php
$city = $_POST['city'];

$data = array(
    array(
    'id' => '1',
    'name' => 'McDonalds',
    'address' => 'Szczecin'
    ),
    array(
    'id' => '2',
    'name' => 'KFC',
    'address' => 'Warszawa'
    ),
);
  
  // Encode the data as JSON
  $jsonData = json_encode($data);
  
  // Set the response header to indicate JSON content
  header('Content-Type: application/json');
  
  // Echo the JSON string
  echo $jsonData;
?>