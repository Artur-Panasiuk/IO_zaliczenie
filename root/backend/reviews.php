<?php
// Pobranie danych wejściowych
$restaurantId = $_POST['restaurant_id'];
$userId = $_POST['user_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Sprawdzenie, czy ocena została podana
if (empty($rating)) {
    echo "Ocena jest wymagana.";
    exit;
}

// Połączenie z bazą danych (przykładowe dane - należy je dostosować do własnej konfiguracji)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia z bazą danych
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Wstawienie oceny do tabeli reviews
$sql = "INSERT INTO reviews (user_id, restaurant_id, rating, comment) VALUES ('$userId', '$restaurantId', '$rating', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Ocena została dodana.";
} else {
    echo "Błąd podczas dodawania oceny: " . $conn->error;
}

// Zamknięcie połączenia z bazą danych
$conn->close();
?>
