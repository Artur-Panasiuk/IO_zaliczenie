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
            $host = 'localhost'; // Adres hosta
            $username = 'root'; // Nazwa użytkownika bazy danych
            $password = ''; // Hasło bazy danych
            $database = 'smaczne'; // Nazwa bazy danych

            $conn = new mysqli($host, $username, $password, $database);

            // Sprawdzenie połączenia
            if ($conn->connect_error) {
                die("Błąd połączenia: " . $conn->connect_error);
            }

            // Pobranie wszystkich zamówień
            $sql = "SELECT * FROM zamowienie";
            $result = $conn->query($sql);

            // Wyświetlanie zamówień
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $orderId = $row['id'];
                    $productIds = $row['products_ids'];
                    $status = $row['status'];

                    echo "Zamówienie ID: " . $orderId . "<br>";
                    echo "Produkty ID: " . $productIds . "<br>";
                    echo "Status: " . $status . "<br>";

                    // Wyświetlanie przycisku tylko dla zamówień o statusie "Nowe"
                    if ($status == "Nowe") {
                        echo "<form method='post' action='aktualizuj_status.php'>";
                        echo "<input type='hidden' name='orderId' value='$orderId'>";
                        echo "<input type='submit' name='submit' value='Przyjmij'>";
                        echo "</form>";
                    } elseif ($status == "Przygotowane") {
                        echo "<form method='post' action='aktualizuj_status.php'>";
                        echo "<input type='hidden' name='orderId' value='$orderId'>";
                        echo "<input type='submit' name='submit' value='Wydaj'>";
                        echo "</form>";
                    }

                    echo "<br>";
                }
            } else {
                echo "Brak zamówień.";
            }

            $conn->close();
        ?>
    </main>
    <footer>
    </footer>
</body>
</html>