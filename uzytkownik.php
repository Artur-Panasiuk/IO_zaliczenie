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

// Sprawdzenie, czy formularz został wysłany
if(isset($_POST['miasto'])) {
    $miasto = $_POST['miasto'];
    
    // Zapytanie do bazy danych
    $sql = "SELECT * FROM restauracja WHERE miasto = '$miasto'";
    $result = $conn->query($sql);
}
?>

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
        <h1>Wyszukiwanie restauracji</h1>
        <form method="POST" action="">
            <label for="miasto">Wpisz miasto:</label>
            <input type="text" name="miasto" id="miasto">
            <input type="submit" value="Szukaj">
        </form>

        <?php
        // Wyświetlanie wyników
        if(isset($result) && $result->num_rows > 0) {
            echo "<h2>Restauracje w $miasto:</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nazwa</th><th>Miasto</th><th>Akcje</th></tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["nazwa"]."</td>";
                echo "<td>".$row["miasto"]."</td>";
                echo "<td><a href='produkty.php?id_rest=".$row["id"]."'>Pokaż produkty</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } elseif(isset($result)) {
            echo "<p>Brak wyników dla $miasto.</p>";
        }
        ?>
        <form action="index.php">
            <input type="submit" value="Powrót">
        </form>
        <form action="koszyk.php">
            <input type="submit" value="Koszyk">
        </form>
    </main>

    <footer>
    </footer>
</body>
</html>

<?php
// Zamykanie połączenia z bazą danych
$conn->close();
?>