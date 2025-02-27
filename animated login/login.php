<?php
// login.php

session_start(); // Start de sessie

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
    $password = $_POST['password'];

    // Bereid en bind
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Controleer het wachtwoord
        if (password_verify($password, $hashed_password)) {
            // Inloggen succesvol, sla de gebruikers-ID op in de sessie
            $_SESSION['user_id'] = $user_id;
            header("Location: homepagina.php"); // Redirect naar de homepage
            exit();
        } else {
            $message = "<div class='error'>Ongeldig wachtwoord.</div>";
        }
    } else {
        $message = "<div class='error'>Geen gebruiker gevonden met dit e-mailadres.</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pagina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <section>
        <div class="login-box">
            <form action="login.php" method="POST">
                <h2>Login</h2>
                <?php if (!empty($message)) echo $message; ?> <!-- Toon meldingen -->
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-unread"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label for="email">E-mail</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label for="password">Wachtwoord</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="reset_password.php">Wachtwoord Vergeten?</a>
                </div>
                <button type="submit">Login</button>
                <div class="register-link">
                    <p>Heb je nog geen account? <a href="register.php">Registreer</a></p>
                </div>
            </form>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>