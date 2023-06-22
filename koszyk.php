<!DOCTYPE html>
<html>
<head>
    <title>Koszyk</title>
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
        <h1>Koszyk</h1>

        <div id="cart-items">
            <h2>Produkty w koszyku:</h2>
            <table id="cart-table">
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Cena</th>
                </tr>
            </table>
        </div>

        <button onclick="placeOrder()">Złóż zamówienie</button>

        <script>
            // Funkcja wyświetlająca produkty z localStorage na stronie
            function displayCart() {
                var cartTable = document.getElementById("cart-table");
                cartTable.innerHTML = "";

                var total = 0;

                // Sprawdzenie, czy localStorage jest obsługiwane przez przeglądarkę
                if (typeof(Storage) !== "undefined") {
                    // Sprawdzenie, czy istnieje zapisany koszyk w localStorage
                    var cartItems = localStorage.getItem("koszyk");

                    if (cartItems) {
                        var produkty = JSON.parse(cartItems);

                        for (var i = 0; i < produkty.length; i++) {
                            var row = cartTable.insertRow(-1);

                            var idCell = row.insertCell(0);
                            idCell.innerHTML = produkty[i].id;

                            var nazwaCell = row.insertCell(1);
                            nazwaCell.innerHTML = produkty[i].nazwa;

                            var cenaCell = row.insertCell(2);
                            cenaCell.innerHTML = produkty[i].cena;

                            total += parseFloat(produkty[i].cena);
                        }
                    }
                } else {
                    console.log("Przeglądarka nie obsługuje localStorage.");
                }

                var totalRow = cartTable.insertRow(-1);
                var totalCell = totalRow.insertCell(0);
                totalCell.colSpan = 3;
                totalCell.innerHTML = "Suma: " + total.toFixed(2);
            }

            // Funkcja obsługująca składanie zamówienia
            function placeOrder() {
                // Sprawdzenie, czy localStorage jest obsługiwane przez przeglądarkę
                if (typeof(Storage) !== "undefined") {
                    // Sprawdzenie, czy istnieje zapisany koszyk w localStorage
                    var cartItems = localStorage.getItem("koszyk");

                    if (cartItems) {
                        var produkty = JSON.parse(cartItems);

                        var productsIds = produkty.map(function (produkt) {
                            return produkt.id;
                        });

                        // Tworzenie żądania AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "zloz-zamowienie.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        // Obsługa odpowiedzi AJAX
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(xhr.responseText);
                                // Wyczyszczenie koszyka po złożeniu zamówienia
                                localStorage.removeItem("koszyk");
                                // Odświeżenie widoku koszyka
                                displayCart();
                            }
                        };

                        // Przygotowanie danych do wysłania
                        var data = "products_ids=" + JSON.stringify(productsIds);

                        // Wysłanie żądania AJAX
                        xhr.send(data);
                    }
                } else {
                    console.log("Przeglądarka nie obsługuje localStorage.");
                }
            }

            // Wywołanie funkcji displayCart() przy załadowaniu strony
            displayCart();
        </script>
    </main>
    <footer>
    </footer>
</body>
</html>