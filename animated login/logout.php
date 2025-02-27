<?php
session_start(); // Start de sessie

// Verwijder alle sessievariabelen
$_SESSION = array();

// Als je de sessie-cookie wilt verwijderen, moet je deze ook instellen
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Vernietig de sessie
session_destroy();

// Redirect naar de loginpagina
header("Location: login.php");
exit();
?>