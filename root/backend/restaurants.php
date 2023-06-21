<?php
// Pobierz wartość zmiennej city przesłanej ze strony
$city = 'Warszawa';

// Przygotuj dane o restauracjach dla danego miasta
$restaurants = array(
    array(
        'id' => '1',
        'name' => 'McDonalds',
        'city' => 'Szczecin'
    ),
    array(
        'id' => '2',
        'name' => 'KFC',
        'city' => 'Warszawa'
    ),
    // Dodaj więcej restauracji według potrzeb
);

// Filtruj restauracje na podstawie podanego miasta
$filteredRestaurants = array();
foreach ($restaurants as $restaurant) {
    if ($restaurant['city'] == $city) {
        $filteredRestaurants[] = $restaurant;
    }
}

// Ustaw nagłówek odpowiedzi na format JSON
header('Content-Type: application/json');

// Zwróć dane JSON zawierające restauracje w podanym mieście
echo json_encode($filteredRestaurants);
?>