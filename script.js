function addToCart(id, nazwa, cena) {
    var produkt = {
        id: id,
        nazwa: nazwa,
        cena: cena
    };

    // Sprawdzenie, czy localStorage jest obsługiwane przez przeglądarkę
    if (typeof(Storage) !== "undefined") {
        // Sprawdzenie, czy istnieje już zapisany koszyk w localStorage
        var koszyk = localStorage.getItem("koszyk");

        if (koszyk) {
            // Jeśli koszyk już istnieje, pobieramy go i dodajemy nowy produkt
            var produkty = JSON.parse(koszyk);
            produkty.push(produkt);
            localStorage.setItem("koszyk", JSON.stringify(produkty));
        } else {
            // Jeśli koszyk nie istnieje, tworzymy nową tablicę i dodajemy produkt
            var produkty = [produkt];
            localStorage.setItem("koszyk", JSON.stringify(produkty));
        }

        console.log("Dodano produkt do koszyka: ", produkt);
    } else {
        console.log("Przeglądarka nie obsługuje localStorage.");
    }
}