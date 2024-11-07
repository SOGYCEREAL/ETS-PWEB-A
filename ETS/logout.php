<?php
session_start();  // Start the session to access session variables

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page or home page
header("Location: login.php");
exit();
?>
