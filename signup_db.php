<?php
/*** begin our session ***/
session_start();

/*** if we are here the data is valid and we can insert it into database ***/
    $uname = filter_var($_POST['uname'], FILTER_SANITIZE_STRING);
    $pas = filter_var($_POST['pas'], FILTER_SANITIZE_STRING);
	$fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
	$lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
	$faname = filter_var($_POST['faname'], FILTER_SANITIZE_STRING);
	$loca = filter_var($_POST['loca'], FILTER_SANITIZE_STRING);
	$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$admin = filter_var($_POST['admin'], FILTER_SANITIZE_STRING);

	/*** echo '+91'.$mobile . "<br>"; ***/
	
    /*** now we can encrypt the password ***/
    $pas = password_hash( $pas, PASSWORD_DEFAULT);

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

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("INSERT INTO users (uname,pass,fname,lname,faname,loca,mobile,email,admin) VALUES (:uname,:pas,:fname,:lname,:faname,:loca,:mobile,:email,:admin )");

        /*** bind the parameters ***/
		$stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
		$stmt->bindParam(':uname', $uname, PDO::PARAM_STR);
        $stmt->bindParam(':pas', $pas, PDO::PARAM_STR);
		$stmt->bindParam(':faname', $faname, PDO::PARAM_STR);
		$stmt->bindParam(':loca', $loca, PDO::PARAM_STR);
        $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':admin', $admin, PDO::PARAM_BOOL);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        unset( $_SESSION['form_token'] );

	    try
		{        
			session_start();
			$dbh2 = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
			$retri = $dbh2->prepare("SELECT * FROM users WHERE uname = \"$uname\"");
			$retri->execute();
			
			while($result = $retri->fetch(PDO::FETCH_ASSOC)){
				
			?>




<fieldset>
        <legend class="legend">User details</legend>
  <table>
    <tbody>
      <tr>
        <td class="dis">Username</td>
        <td>:</td>
        <td class="dis"><?php echo $result['uname'];?></td>
      </tr>

      <tr>
        <td class="dis">Name:</td>
        <td>:</td>
        <td class="dis">
		<?php 
			echo $result['fname'] . " "; 
			echo $result['lname']; ?>
		</td>
      </tr>
	  
	  <tr>
        <td class="dis">Faname</td>
        <td>:</td>
        <td class="dis"><?php echo $result['faname'];?></td>
      </tr>
	  
	  <tr>
        <td class="dis">Location</td>
        <td>:</td>
        <td class="dis"><?php echo $result['loca'];?></td>
      </tr>
	  
	  <tr>
        <td class="dis">Contact No</td>
        <td>:</td>
        <td class="dis"><?php echo $result['mobile'];?></td>
      </tr>
	  
	  <tr>
        <td class="dis">Email</td>
        <td>:</td>
        <td class="dis"><?php echo $result['email'];?></td>
      </tr>
	  
	  <tr>
        <td class="dis">Administrator</td>
        <td>:</td>
        <td class="dis"><?php echo $result['admin'];?></td>
      </tr>
    </tbody>
  </table>
  <br>
      </fieldset>















<?php			
				

			} 
			unset( $_SESSION['form_token'] );
		}
		catch(Exception $e)
		{
			$result = 'Unable to retrive newly added user from the backend...But "';
		}
				
        /*** if all is done, say thanks ***/
        $message = 'New user added';
    }
    catch(Exception $e)
    {
        /*** check if the username already exists ***/
        if( $e->getCode() == 23000)
        {
            $message = 'Username already exists';
        }
        else
        {
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later"';
        }
    }

//CREATE TABLE users (uid int AUTO_INCREMENT primary key, uname varchar(8) UNIQUE,pass varchar(128), fname varchar(128),lname varchar(128), faname varchar(128), loca varchar(128),mobile varchar(12), email varchar(128), admin boolean DEFAULT 0);
// INSERT INTO users (uid, uname, pass, fname,lname,faname,loca,mobile,email,admin) VALUES ("1000", "jeeva","jeeva123","Jeev", "M", "Sidd", "Senjerimali","9942254449","jeeva@gmail.com","1")
 
 
?>


<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> New user registration status</title>
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

</head>
<body>
<p><?php echo $message; ?></p>
<p><?php echo $result; ?></p>

</body>
</html>
