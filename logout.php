<?php
// Begin the session

session_start();
$user=$_SESSION['loginid'];

// Unset all of the session variables.
session_unset();

// Destroy the session.
session_destroy();
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/master.css">
<head>
<title>Logged Out</title>
</head>

<body>
<h1>User <?php echo $user ?> successfully logged out. <br> 
Click <a href="/sfl/login.php">here</a> to login </h1>
</body>
</html>

