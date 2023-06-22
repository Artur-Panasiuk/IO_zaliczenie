<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smaczne";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sprawdzenie, czy przekazano identyfikator restauracji
if(isset($_GET['id_rest'])) {
    $id_rest = $_GET['id_rest'];
    
    // Zapytanie do bazy danych
    $sql = "SELECT * FROM produkty WHERE id_rest = '$id_rest'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista produktów</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo_temp.png" alt="logo">
    </header>

    <main>
        <form action="uzytkownik.php">
            <input type="submit" value="Powrót">
        </form>
        <h1>Lista produktów w restauracji</h1>

        <?php
        // Wyświetlanie wyników
        if(isset($result) && $result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nazwa</th><th>Cena</th><th>Akcje</th></tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["nazwa"]."</td>";
                echo "<td>".$row["cena"]."</td>";
                echo "<td><button onclick=\"addToCart('".$row["id"]."', '".$row["nazwa"]."', '".$row["cena"]."')\">Dodaj do koszyka</button></td>";
                echo "</tr>";
            }

            echo "</table>";
        } elseif(isset($result)) {
            echo "<p>Brak produktów dla tej restauracji.</p>";
        }
        ?>
    </main>
    <footer>
    </footer>
</body>
</html>

<?php
// Zamykanie połączenia z bazą danych
$conn->close();
?>