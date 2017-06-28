<html>
<body>
<?php
/*** begin our session ***/
session_start();

if(isset( $_SESSION['loginid'] ))
{
	echo $_SESSION['loginid'];
	
	
	
	
	
	
	
}
else
{
	echo "Please login to access this page";
}
?>
</body>
</html>