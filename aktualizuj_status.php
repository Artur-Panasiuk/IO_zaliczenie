<?php
// Połączenie z bazą danych
$host = 'localhost'; // Adres hosta
$username = 'root'; // Nazwa użytkownika bazy danych
$password = ''; // Hasło bazy danych
$database = 'smaczne'; // Nazwa bazy danych

$conn = new mysqli($host, $username, $password, $database);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Aktualizacja statusu zamówienia na "Przyjęte" lub "Dostarczane"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];

    $sql = "SELECT status FROM zamowienie WHERE id = $orderId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row['status'];

        if ($status == "Nowe") {
            $newStatus = "Przyjęte";
        } elseif ($status == "Przygotowane") {
            $newStatus = "Dostarczane";
        }

        $updateSql = "UPDATE zamowienie SET status = '$newStatus' WHERE id = $orderId";

        if ($conn->query($updateSql) === TRUE) {
            echo "Status zamówienia został zaktualizowany.";
        } else {
            echo "Błąd podczas aktualizacji statusu zamówienia: " . $conn->error;
        }
    }
}

$conn->close();
header("Location: dostawca.php");
exit();
?>