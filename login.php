<html>
<?php
/*** begin our session ***/
session_start();

if(isset( $_SESSION['loginid'] ))
{
?>
<head><title>SFL Logout</title></head>
	<p> Want to <a href='logout.php'>logout</a> <?php echo $_SESSION['loginid'] . "??"; ?></p>
	
<?php
}
else
{
echo "<head><title>SFL Login</title></head>";
?>
<body>
<h2>Login Here</h2>
<form action="validate_login.php" method="post">
<fieldset>
<p>
<label>Username</label>
<input type="text" id="loginid" name="loginid" value="" maxlength="20" />
</p>
<p>
<label>Password</label>
<input type="password" id="loginpasswd" name="loginpasswd" value="" maxlength="20" />
</p>

<p>
<button type="submit" class="btn" value="login">Login </button>
<button type="reset" class="btn" value="reset">Reset </button>
</p>

</fieldset>
</form>
</body>
</html>
	
<?php
}
?>

