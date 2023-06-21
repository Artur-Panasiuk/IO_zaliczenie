<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "nazwa_uzytkownika";
$password = "haslo";
$dbname = "nazwa_bazy_danych";

// Utworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Nieudane połączenie: " . $conn->connect_error);
}

// Sprawdzenie czy przekazano ID restauracji
if (isset($_GET['restaurant_id'])) {
    $restaurantId = $_GET['restaurant_id'];

    // Zapytanie SQL
    $sql = "SELECT * FROM items WHERE restaurant_id = $restaurantId";

    // Wykonanie zapytania i pobranie wyników
    $result = $conn->query($sql);

    // Tablica na produkty
    $products = array();

    // Przetwarzanie wyników
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Dodanie produktu do tablicy
            $product = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price']
            );
            $products[] = $product;
        }
    }

    // Zamknięcie połączenia
    $conn->close();

    // Ustawienie nagłówka odpowiedzi jako JSON
    header('Content-Type: application/json');

    // Wyświetlenie wyników jako JSON
    echo json_encode($products);
} else {
    // Brak przekazanego ID restauracji
    echo "Brak przekazanego ID restauracji.";
}
?>
