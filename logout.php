<html>
<head><title> Logout </title>

</head>

<?php
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy(); 

header("Location: login.html");
?>

</html>
