<?php
// Begin the session
session_start();

// Unset all of the session variables.
session_unset();

// Destroy the session.
session_destroy();
?>
<html>
<head>
<title>Logged Out</title>
</head>

<body>
<h1>You are now logged out. <br> Want to login again? Click <a href="http://10.169.41.63/sfl/login.php">here</a></h1>
</body>
</html>
