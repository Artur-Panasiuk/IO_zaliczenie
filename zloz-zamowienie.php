<?php
// Pobieranie danych z żądania AJAX
if (isset($_POST['products_ids'])) {
    $productsIds = json_decode($_POST['products_ids']);

    // Połączenie z bazą danych
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smaczne";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Tworzenie zamówienia w bazie danych
    $productsIdsString = implode(',', $productsIds);
    $status = "Nowe"; // Ustawienie początkowego statusu zamówienia

    $sql = "INSERT INTO zamowienie (products_ids, status) VALUES ('$productsIdsString', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "Zamówienie zostało złożone.";
    } else {
        echo "Błąd przy zapisywaniu zamówienia: " . $conn->error;
    }

    // Zamykanie połączenia z bazą danych
    $conn->close();
}
?>