<?php
// define variables and set to empty values
$uname = $fname = $lname = $pas = $faname = $loca = $mobile = $email = $admin = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = test_input($_POST["fname"]);
  $lname = test_input($_POST["lname"]);
  $uname = test_input($_POST["uname"]);
  $pas = test_input($_POST["pas"]);
  $faname = test_input($_POST["faname"]);
  $loca = test_input($_POST["loca"]);
  $mobile = test_input($_POST["mobile"]);
  $email = test_input($_POST["email"]);
  $admin = test_input($_POST["admin"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User registration</title>
<link rel="stylesheet" type="text/css" href="css/mystyle.css">


<script language='javascript' type='text/javascript'>
function check(input) {
        if (input.value != document.getElementById('pas').value) {
            input.setCustomValidity('Password Must be Matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
	</script>


</head> 

<form method="post" action="<?php echo htmlspecialchars("signup_db.php");?>">
  
   <fieldset>
        <legend class="legend">User details</legend>
  <table>
    <tbody>
      <tr>
        <td class="lft">Username</td>
        <td>:</td>
        <td class="midd"> <input type="text" id="uname" name="uname" value="" aria-describedby="name-format" required aria-required=”true” pattern="[a-z]{5}"></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;[5 lower case letters only]</td>
      </tr>

	    <tr>
        <td class="lft">Password</td>
        <td>:</td>
        <td class="midd"> <input type="password" id="pas" name="pas" value="" aria-describedby="name-format" required aria-required=”true” pattern="[a-z]{5,}"></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;[5 & more lower case letters]</td>
      </tr>
	  <tr>
        <td class="lft">Confirm password</td>
        <td>:</td>
        <td class="midd"><div> <input type="password" id="cpas" name="cpas" value="" aria-describedby="name-format" required aria-required=”true” pattern="[a-z]{5,}" oninput="check(this)"> </div></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;</td>
      </tr>
	<tr>
        <td class="lft"> First Name</td>
        <td>:</td>
        <td class="midd"><input name="fname" type="text" aria-describedby="name-format" required aria-required=”true” pattern="[A-Za-z]{5,}"></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;</td>
      </tr>
      <tr>
        <td class="lft"> Last Name</td>
        <td>:</td>
        <td class="midd"><input name="lname" type="text" required aria-required=”true”  pattern="[A-Za-z]{1,}"></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;</td>
      </tr>
      <tr>
        <td class="lft">faname</td>
        <td>:</td>
        <td class="midd"><input name="faname" type="text" required aria-required=”true”  pattern="[A-Za-z]{5,}"></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;</td>
      </tr>
      <tr>
        <td class="lft">Location</td>
        <td>:</td>
        <td class="midd"><input name="loca" type="text" required aria-required=”true” pattern="[A-Za-z]{5,}"></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;</td>
      </tr>
      <tr>
        <td class="lft">Mobile</td>
        <td>:</td>
        <td class="midd">+91-<input name="mobile" type="text" required aria-required=”true” pattern="[0-9]{10}"></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;[10 digit numbers only]</td>
      </tr>
      <tr>
        <td class="lft"> E-mail</td>
        <td>:</td>
        <td class="midd"><input name="email" type="text" required aria-required=”true” pattern="[A-Za-z]{5,}"></td>
		<td class="star">*<br>
		<td class="rht">&nbsp;[5 digit lower case letters only]</td>
      </tr>
      <tr>
        <td class="lft">Administrator</td>
        <td>:</td>
        <td>
			<input name="admin" value="1" type="radio">Yes 
			<input name="admin" value="0" type="radio">No </td>
      </tr>
	  <tr>
        <td></td>
        <td></td>
        <td>
		<button type="submit">Submit</button>
		<button type="reset">Reset</button>
      </tr>
    </tbody>
  </table>
  <br>
      </fieldset>
</form> 
</html>
