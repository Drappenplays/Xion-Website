<?php
session_start(); // Startar en session så att vi kan lagra användarens information
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personuppgifter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="personinfo.css" rel="stylesheet" />
</head>
<body>

    <!-- Stängningsknapp som leder tillbaka till beställningssidan -->
    <a href="klar_order.php" class="close-icon"> ✖ </a>

    <div class="form-container">
        <h2>Fyll i dina uppgifter</h2>

        <!-- Formulär för att samla in personuppgifter -->
        <form id="personInfoForm">
            
            <!-- Fält för förnamn -->
            <div class="form-group">
                <label for="first_name">Förnamn</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <!-- Fält för efternamn -->
            <div class="form-group">
                <label for="last_name">Efternamn</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <!-- Fält för e-post -->
            <div class="form-group">
                <label for="email">E-post</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Dropdown-meny för att välja om frakt behövs -->
            <div class="form-group">
                <label for="shipping">Vill du ha frakt?</label>
                <select class="form-select" id="shipping" name="shipping" onchange="toggleAddress()">
                    <option value="Nej">Nej</option>
                    <option value="Ja">Ja</option>
                </select>
            </div>

            <!-- Dolda adressfält som visas om frakt väljs -->
            <div class="form-group" id="addressField" style="display: none;">
                <label for="address">Adress</label>
                <input type="text" class="form-control" id="address" name="address">

                <label for="postnummer">Postnummer</label>
                <input type="text" class="form-control" id="postnummer" name="postnummer">

                <label for="postort">Postort</label>
                <input type="text" class="form-control" id="postort" name="postort">
            </div>

            <!-- Skicka-knapp för att bekräfta och skicka beställningen -->
            <input class="skickaknapp" type="submit" value="Gör Beställning">
        </form>
    </div>

        <script>

        // Funktion som visar eller döljer adressfältet beroende på om användaren väljer frakt.
        function toggleAddress() {
            const shipping = document.getElementById("shipping").value;
            const addressField = document.getElementById("addressField");
            
            if (shipping === "Ja") { // Om de väljer att ha frakt visas alla nya delar de måste skriva in och gör de till "required" eftersom de måste anges för frakt
                addressField.style.display = "block"; // Visa adressfältet
                document.getElementById("address").setAttribute("required", "true");
                document.getElementById("postnummer").setAttribute("required", "true");
                document.getElementById("postort").setAttribute("required", "true");
            } else {
                addressField.style.display = "none"; // Om de inte vill ha frakt göms de olika delarna och tar bort "required" så de inte blir låsta på sidan och måste skriva in de
                document.getElementById("address").removeAttribute("required");
                document.getElementById("postnummer").removeAttribute("required");
                document.getElementById("postort").removeAttribute("required");
            }
        }

        // Lyssnar på formulärets submit-händelse och skickar uppgifterna via AJAX.

        document.getElementById("personInfoForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Förhindrar att sidan laddas om vid formulärskick

            // Skapar ett FormData-objekt för att skicka data till servern
            const formData = new FormData();
            formData.append("first_name", document.getElementById("first_name").value);
            formData.append("last_name", document.getElementById("last_name").value);
            formData.append("email", document.getElementById("email").value);
            formData.append("shipping", document.getElementById("shipping").value);

            // Lägger till adressuppgifter om användaren valt frakt
            if (document.getElementById("shipping").value === "Ja") {
                formData.append("address", document.getElementById("address").value);
                formData.append("postnummer", document.getElementById("postnummer").value);
                formData.append("postort", document.getElementById("postort").value);
            }

            // Skickar beställningsuppgifter via AJAX till servern (order_info.php)
            fetch("order_info.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text()) // Omvandlar svaret till text
            .then(data => {
                console.log("Beställningsinfo skickad!"); // Loggar att datan har skickats för att kontrollera
                window.location.href = "tack_sida.php"; // Om beställningen är lyckad, gå till tack-sidan
            })
            .catch(error => console.error("Fel vid skickning av beställning:", error)); // Hanterar eventuella fel
        });
    </script>

</body>
</html>