<?php
// Pobierz wartość zmiennej city przesłanej ze strony
$city = $_POST['city'];

// Przygotuj dane o restauracjach dla danego miasta
$restaurants = array(
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
    // Dodaj więcej restauracji według potrzeb
);

// Filtruj restauracje na podstawie podanego miasta
$filteredRestaurants = array();
foreach ($restaurants as $restaurant) {
    if ($restaurant['address'] == $city) {
        $filteredRestaurants[] = $restaurant;
    }
}

// Ustaw nagłówek odpowiedzi na format JSON
header('Content-Type: application/json');

// Zwróć dane JSON zawierające restauracje w podanym mieście
echo json_encode($filteredRestaurants);
?>