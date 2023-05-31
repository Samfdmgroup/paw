<?php

session_start();

 if(isset($_POST['submit']))
{
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['type'] = $_POST['type'];
	echo $_SESSION['name'];
	
	// if user is client then it will be redirected to userlistEmployee.php and if its admin then it will be redirected to insertEmployee.php
	if ($_POST['type'] === "1") 
	{
		header('location: UserListEmployee.php');
	}
	if ($_POST['type'] === "2") 
	{
		header('location: InsertEmployee.php');
	}
			
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>IT for rent</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

.form-control {border-radius: 5px;}

</style>
</head>

<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- !PAGE CONTENT! -->
<div class="w3-main">

  <header class="w3-container w3-center w3-padding-32"> 
  <h1><b>IT FOR RENT</b></h1>
  
</header>

  <div class="w3-row-padding" style="max-width:400px; margin: 30px auto; padding: 30px;">
    <div class="w3-center w3-container w3-margin-bottom">
      <div class="w3-container w3-white">
        <p><b>Please log in</b></p>
        <form action="Login.php" method="post">
		<p>Enter your name: <input type="text" class="form-control" placeholder="Name" name="name" required="required"></p>
        <p>Enter your password: <input type="password" class="form-control" placeholder="Password" name="password" required="required"></p>
		<p> <span style="font-weight:bold">Status:</span>
		<select name="type">
			<option value="1" selected>Client</option>
			<option value="2" selected>Administrator</option>
		</select>
		<p><input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">
		<p><button><a href="Register.php">Click here to register</a></button></p>
	  </div>
    </div>

  </div>
  </div>
  </form>


</body>
</html>