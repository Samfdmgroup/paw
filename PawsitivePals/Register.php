<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Register</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}



</style>
</head>

<body class="w3-light-grey w3-content" style="max-width:1600px">

<?php

$errors =0;


$name = "";
$surname = "";
$phone = "";
$email = "";
$type = "";
$password= "";

$emailErr = "";
$passwordErr = "";

$server = "localhost";
$databasename="pawsitivepals";
$username="root";
$password = "";


$conn = mysqli_connect($server, $username, $password, $databasename);

//check conn 
if (!$conn) {
	die("connection failed: " . mysqli_connect_error());
}


if (isset($_POST['user']))
{
	$name = stripslashes($_POST['name']);
	$surname = stripslashes($_POST['surname']);
	$phone = stripslashes($_POST['phone']);
	$email = stripslashes($_POST['email']);
	$type = stripslashes($_POST['type']);
	$password = stripslashes($_POST['password']);

//if type = '1' insert into client
if ($_POST['type'] == "1") {
$SQLstring = "INSERT INTO client (name, surname, phone, email, type, password)
	  VALUES ('$name', '$surname', '$phone', '$email', '$type', '$password')";
	if (mysqli_query($conn, $SQLstring)) {
		echo "<strong><h3> New client record created successfully. Remember to log in at the main page. </h3></strong>";
		
	}
	else {
		echo "error: " .$SQLstring. "<br>" .mysqli_error($conn);
	}
	mysqli_close($conn);
}
// if type ='2' insert into administrator
else {
$SQLstring = "INSERT INTO administrator (name, surname, phone, email, type, password)
	  VALUES ('$name', '$surname', '$phone', '$email', '$type', '$password')";
	if (mysqli_query($conn, $SQLstring)) {
		echo "<strong><h3> New administrator record created successfully. Remember to log in at the main page. </h3></strong>";
						
	}
	else {
		echo "error: " .$SQLstring. "<br>" .mysqli_error($conn);
	}
	mysqli_close($conn);
}

}

?>

  
<div class="w3-row">
	<div class="w3-col l8 s12">
	
	  <div class="w3-card-4 w3-margin w3-white">
    <div class="w3-container">
      <div class="w3-row">
        <div class="w3-col m8 s12">

<h1>Please fill in your details</h1>
<hr />

<form action="Register.php" method="POST">
<span style="font-weight:bold">Name: </span>
<input type="text" name="name" />
<br /><br />

<span style="font-weight:bold">Surname: </span>
<input type="text" name="surname" />
<br /><br />

<span style="font-weight:bold">Phone: </span>
<input type="text" name="phone" />
<br /><br />

<span style="font-weight:bold">E-mail: </span>
<input type="text" name="email" />
<span class="error">* <?php echo $emailErr;?></span> 
<br /><br />

<span style="font-weight:bold">Type of User:</span>
<select name="type">
<option value="1" selected>Client</option>
<option value="2" selected>Administrator</option>
</select>
	<br /><br />

<span style="font-weight:bold">Password: </span>
<input type="password" name="password" />
<span class="error">* <?php echo $passwordErr;?></span> 
<br /><br />

<p> <input type="submit" name="user" value="Submit" />
<input type="reset" value="Reset Form" />
<button><a href="Login.php">Login</a></button>

</form>

       </div>
      </div>
    </div>
	<hr>
  </div>

	</div>
</div>
</body>

</html>