<?php
// register.php

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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash het wachtwoord
    $confirm_password = $_POST['confirm_password'];

    // Controleer of de wachtwoorden overeenkomen
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $message = "<div class='error'>Wachtwoorden komen niet overeen.</div>";
    } else {
        // Bereid en bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $message = "<div class='success'>Registratie succesvol!</div>";
        } else {
            $message = "<div class='error'>Fout: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie Pagina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <div class="login-box">
            <h2>Registreren</h2>
            <?php if (!empty($message)) echo $message; ?>
            <form action="register.php" method="POST">
                <div class="input-box">
                    <input type="text" name="username" id="username" required>
                    <label for="username">Gebruikersnaam</label>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" required>
                    <label for="email">E-mail</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Wachtwoord</label>
                </div>
                <div class="input-box">
                    <input type="password" name="confirm_password" id="confirm_password" required>
                    <label for="confirm_password">Bevestig Wachtwoord</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="agree" required> Ik ga akkoord met de voorwaarden</label>
                </div>
                <button type="submit">Registreren</button>
            </form>
            <div class="register-link">
                <p>Heb je al een account? <a href="login.php">Log in</a></p>
            </div>
        </div>
    </section>
</body>
</html>