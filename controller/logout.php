<?php
// Start the session
require("../model/db.php");
session_start();

// Destroy the session to log out the user
session_unset(); // This removes all session variables
session_destroy(); // This destroys the session

// Redirect the user to the login page (or homepage)
header("Location: ../index.php"); // Replace "login.php" with the page you want to redirect to
exit();
?>
