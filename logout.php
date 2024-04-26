<?php
session_start();


function clearCookies() {
    setcookie('UserType', '', time() - 3600, '/');
    setcookie('UserID', '', time() - 3600, '/');
    setcookie('Username', '', time() - 3600, '/');
}

// Call the function to clear cookies
clearCookies();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page after logout
header('Location: index.php');
exit();
?>
