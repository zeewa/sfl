<?php

/*** unset the form token session variable ***/
//unset( $_SESSION['form_token'] );

/*** begin our session ***/
session_start();

/*** check if the users is already logged in ***/
if(isset( $_SESSION['loginid'] ))
{
    $message = "User" .  $_SESSION['loginid'] . "is already logged in";
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['loginid'], $_POST['loginpasswd']))
{
    $message = 'Please enter a valid username and password. <br> Try <a href="http://10.169.41.63/sfl/login.php">login</a> again';
	
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['loginid']) > 10 || strlen($_POST['loginid']) < 4)
{
    $message = 'Incorrect length of login-id. <br> Try <a href="http://10.169.41.63/sfl/login.php">login</a> again';
		
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['loginpasswd']) > 20 || strlen($_POST['loginpasswd']) < 4)
{
    $message = 'Incorrect Length for Password. <br> Try <a href="http://10.169.41.63/sfl/login.php">login</a> again';
	}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['loginid']) != true)
{
    /*** if there is no match ***/
    $message = 'Username must be alpha numeric. <br> Try <a href="http://10.169.41.63/sfl/login.php">login</a> again';
		
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['loginpasswd']) != true)
{
        /*** if there is no match ***/
        $message = 'Password must be alpha numeric. <br> Try <a href="http://10.169.41.63/sfl/login.php">login</a> again';
			
}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $loginid = filter_var($_POST['loginid'], FILTER_SANITIZE_STRING);
    $loginpasswd = filter_var($_POST['loginpasswd'], FILTER_SANITIZE_STRING);

    /*** now we can encrypt the password ***/
    //$loginpasswd = password_hash( $loginpasswd, PASSWORD_DEFAULT);
    
    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'jm';

    /*** mysql password ***/
    $mysql_password = 'jeeva';

    /*** database name ***/
    $mysql_dbname = 'mydb';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to exceptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the select statement ***/
        $stmt = $dbh->prepare("SELECT uname, pass, admin FROM users WHERE uname = :loginid");
		
        /*** bind the parameters ***/
        $stmt->bindParam(':loginid', $loginid, PDO::PARAM_STR);
        //$stmt->bindParam(':loginpasswd', $loginpasswd, PDO::PARAM_STR);
		
        /*** execute the prepared statement ***/
        $stmt->execute();
		
		$db_result = $stmt->fetch(PDO::FETCH_ASSOC);
		?>
		
	
		<!DOCTYPE html>
		<html>
		<title>Home page</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/master.css">
		
		<body>
		<form action="login.php" method="post">
		<section id="homepage">
			<ul class="nav navbar-nav">
<?php
		
		
			
		if ( $loginid == $db_result['uname'] && password_verify($loginpasswd, $db_result['pass']) && $db_result['admin'] == 1) 
		{
			  /*** set the session user_id variable ***/
                $_SESSION['loginid'] = $loginid;

                /*** tell the user we are logged in ***/
                $message = "Welcome " . $loginid;
				
				echo $_SESSION['loginid'];
				echo '  <button type="submit" class="btn" value="logout">Logout</button>';				
				 ?>
        
          <li class="active"><a href="#">Home</a></li>
          <li><a href="/sfl/user_reg.php" target="iframe_mainh">Register user</a></li>
          <li><a href="coupons.php" target="iframe_mainh">Coupons</a></li>
          <li><a href="myaccount.php"  target="iframe_mainh">My Account</a></li>
          <li><a href="featured.php" target="iframe_mainh">Featured Offers</a></li>
          <li><a href="howitworks.php" target="iframe_mainh">How It Works</a></li>
          <li><a href="help.php" target="iframe_mainh">Help</a></li>
          <li><a href="myfavorites.php" target="iframe_mainh">My Favorite Stores</a></li>
	  
        
    <?php
    			
		} 		
		elseif ( $loginid == $db_result['uname'] && password_verify($loginpasswd, $db_result['pass']) && $db_result['admin'] == 0) 
		{
	  /*** set the session user_id variable ***/
                $_SESSION['loginid'] = $loginid;

                /*** tell the user we are logged in ***/
                $message = "Welcome " . $loginid;
				
				echo $_SESSION['loginid'];
				echo '<button type="submit" class="btn" value="logout">Logout</button>';
				 ?>
        
          <li class="active"><a href="#">Home</a></li>
          <li><a href="users/hierarchy.php" target="iframe_mainh">Hierarchy</a></li>
          <li><a href="myaccount.php" target="iframe_mainh">My Account</a></li>
          <li><a href="featured.php" target="iframe_mainh">Featured Offers</a></li>
          <li><a href="howitworks.php" target="iframe_mainh">How It Works</a></li>
          <li><a href="help.php" target="iframe_mainh">Help</a></li>
          <li><a href="myfavorites.php" target="iframe_mainh">My Favorite Stores</a></li>
		  
        
    <?php
    	} 
		else 
		{
			$message = 'Login Failed :-( <br> Try <a href="http://10.169.41.63/sfl/login.php">login</a> again';
			echo "<title>Login failed :-(</title>";
			
				
		}
    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message = 'We are unable to process your request. Please try again later"';
    }
}
?>
</ul>
</nav>
<main>
<p>
	<?php 
		echo $message; 
	?>

</p>
<iframe src=""  name="iframe_mainh" class="fframe"></iframe>
</main>
		
			
		</section>

</form>
</body>
</html>
