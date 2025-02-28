<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kala.css">
    <title>Video Background</title>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Extra 1</a></li>
            <li><a href="#">Extra 2</a></li>
        </ul>

        <li class="profile-menu">
            <a href="#" class="profile-icon">
                <ion-icon name="person-circle"></ion-icon>
            </a>
            <ul class="dropdown">
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
        
    </nav>
    <video autoplay loop muted playsinline class="background-clip">
        <source src="images/video.mp4" type="video/mp4">
        Your browser does not support video.
    </video>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Linking the external JS file -->
    <script src="script.js"></script>
</body>
</html>
