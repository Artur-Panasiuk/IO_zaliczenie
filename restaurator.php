<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo_temp.png" alt="logo">
    </header>

    <main>
        <form action="index.php">
            <input type="submit" value="Powrót">
        </form>

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

            // Pobieranie zamówień ze statusem "Przyjęte"
            $sql = "SELECT * FROM zamowienie WHERE status = 'Przyjęte'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Wyświetlanie zamówień
                while ($row = $result->fetch_assoc()) {
                    $orderId = $row['id'];
                    $productIds = $row['products_ids'];
                    $status = $row['status'];

                    echo "ID zamówienia: " . $orderId . "<br>";
                    echo "Produkty: " . $productIds . "<br>";
                    echo "Status: " . $status . "<br>";

                    // Przycisk "Drukuj" z formularzem do aktualizacji statusu
                    echo "<form action='aktualizuj_status2.php' method='post'>";
                    echo "<input type='hidden' name='order_id' value='" . $orderId . "'>";
                    echo "<input type='submit' value='Drukuj'>";
                    echo "</form>";
                    echo "<br>";
                }
            } else {
                echo "Brak zamówień ze statusem 'Przyjęte'";
            }

            $conn->close();
        ?>
    </main>
    <footer>
    </footer>
</body>
</html>