<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smaczne";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Nieudane połączenie: " . $conn->connect_error);
}

// Pobranie ID zamówienia z przesłanego formularza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST['order_id'];

    // Aktualizacja statusu zamówienia na "Przygotowane"
    $sql = "UPDATE zamowienie SET status = 'Przygotowane' WHERE id = $orderId";
    if ($conn->query($sql) === TRUE) {
        echo "Status zamówienia został zaktualizowany.";
    } else {
        echo "Błąd podczas aktualizacji statusu zamówienia: " . $conn->error;
    }
}

$conn->close();
header("Location: restaurator.php");
exit();
?>