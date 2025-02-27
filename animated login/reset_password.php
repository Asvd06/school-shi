<?php
// reset_password.php

$servername = "localhost";
$username = "root"; // Je MySQL gebruikersnaam
$password = ""; // Je MySQL wachtwoord
$dbname = "registration"; // De naam van je database

// Maak verbinding
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

$message = ""; // Voor het opslaan van meldingen

// Verwerk het formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Hier zou je de e-mail moeten valideren en controleren of deze bestaat in je database
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Voorbeeld van het verzenden van een e-mail (je moet dit implementeren)
        // mail($email, "Wachtwoord Reset", "Klik op deze link om je wachtwoord te resetten: [link]");
        $message = "<div class='success'>Instructies voor het resetten van je wachtwoord zijn naar je e-mailadres verzonden.</div>";
    } else {
        $message = "<div class='error'>Ongeldig e-mailadres.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord Vergeten</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <div class="login-box">
            <h2>Wachtwoord Vergeten</h2>
            <p class="info-text">Vul je e-mailadres in en wij sturen je instructies om je wachtwoord te resetten.</p>
            <?php if (!empty($message)) echo $message; ?>
            <form action="reset_password.php" method="POST">
                <div class="input-box">
                    <input type="email" name="email" id="email" required>
                    <label for="email">E-mail</label>
                </div>
                <button type="submit">Reset Wachtwoord</button>
            </form>
            <div class="register-link">
                <p>Weet je je wachtwoord weer? <a href="login.php">Log in</a></p>
                <p>Geen account? <a href="register.php">Registreer</a></p>
            </div>
        </div>
    </section>
</body>
</html>