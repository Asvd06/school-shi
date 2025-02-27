<?php
session_start(); // Start de sessie

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect naar login als niet ingelogd
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kala.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <video autoplay loop muted plays-inline class="background-clip">
            <source src="images/video.mp4" type="video/mp4">
        </video>
        <div class="content">
            <h1>Explore</h1>
            <a href="#">start</a>
        </div>
    </div>
</body>
</html>