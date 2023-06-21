<?php
$data = array(
    'name' => 'John Doe',
    'age' => 30,
    'email' => 'johndoe@example.com'
  );
  
  // Encode the data as JSON
  $jsonData = json_encode($data);
  
  // Set the response header to indicate JSON content
  header('Content-Type: application/json');
  
  // Echo the JSON string
  echo $jsonData;
?>