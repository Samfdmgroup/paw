<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Update Employee Status</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

div#intro {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

#intro {
    margin-right: 15px;
    float: right;

}

</style>
</head>

<body class="w3-light-grey w3-content" style="max-width:1600px">

<div class="w3-main">

  <!-- Header -->
  <header id="portfolio">
    <a style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>Update Employee</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16">
      <span class="w3-margin-right">Filter:</span> 
      <button class="w3-button w3-white" onclick="window.location.href='ListEmployee.php'">
	  <i class="fa fa-map-pin w3-margin-right"></i>List all availability</button>
	  

      <!-- <button class="w3-button w3-white" onclick="window.location.href='UpdateEmployeeStatus.php'">
	  <i class="fa fa-map-pin w3-margin-right"></i>Update Employee Status</button>-->
      
	  <button class="w3-button w3-white w3-hide-small" onclick="window.location.href='InsertEmployee.php'">
	  <i class="fa fa-photo w3-margin-right"></i>Insert Employee</button>
	
	<div style="float:right" id="intro1">
	<button class="w3-button w3-white w3-hide-small" 
	onclick="window.location.href='Logout.php'"><i class="fa fa-sign-out"></i> Log out</button>
	</div>
	
	<div style="float:right" id="intro">
	<button class="w3-button w3-white w3-hide-small"
	onclick="window.location.href='InsertEmployee.php'"><i class="fa fa-home"></i> Home</button>
	</div>
	
	</div>
    </div>
  </header>
  
<div class="w3-row">
	<div class="w3-col l8 s12">
	
	  <div class="w3-card-4 w3-margin w3-white">
    <div class="w3-container">
      <div class="w3-row">
        <div class="w3-col m8 s12">

<h2></h2>

<?php

$name = "";


session_start();

if(isset($_SESSION['name']) && $_SESSION['name']) {
	echo "<h3><font color='teal'>Welcome, you are logged in as ". $_SESSION['name']. "!". "</h3></font><hr />";
}

$server = "localhost";
$databasename="pawsitivepals";
$username="root";
$password = "";


$serviceID = "";
$ename = "";


if (isset($_POST['update'])) {
	$serviceID = $_POST['serviceID'];
	$ename = $_POST['ename'];
}

$status = "";



$conn = mysqli_connect($server, $username, $password, $databasename);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }



if (isset($_POST['submit']))
{
	$serviceID = stripslashes($_POST['serviceID']);
	$ename = stripslashes($_POST['ename']);
	$status = stripslashes($_POST['status']);

	//Update status to available
if ($_POST['status'] == "Available") {
$SQLstring = "UPDATE services SET status = 'Available'
			WHERE serviceID = '$serviceID' AND ename = '$ename'";
	if (mysqli_query($conn, $SQLstring)) {
		echo "<script type='text/javascript'>alert('Service is successfully updated')</script>";

	}
	else {
		echo "error: " .$SQLstring. "<br>" .mysqli_error($conn);
	}
	mysqli_close($conn);
}
//Update status to rented
else if ($_POST['status'] == "Rented") {
$SQLstring = "UPDATE services SET status = 'Rented'
			WHERE serviceID = '$serviceID' AND ename ='$ename'";
	if (mysqli_query($conn, $SQLstring)) {
		echo "<script type='text/javascript'>alert('Service is successfully updated')</script>";
	
	}
	else {
		echo "error: " .$SQLstring. "<br>" .mysqli_error($conn);
	}
	mysqli_close($conn);
  }

}

if (isset($_POST['delete']))
{
	$serviceID = stripslashes($_POST['serviceID']);
	$ename = stripslashes($_POST['ename']);
	$status = stripslashes($_POST['status']);

	//Delete Employee
    $SQLstring = "DELETE FROM services 
			WHERE serviceID = '$serviceID' AND ename = '$ename'";
	if (mysqli_query($conn, $SQLstring)) {
		echo "<script type='text/javascript'>alert('Service is successfully deleted')</script>";

	}
	else {
		echo "error: " .$SQLstring. "<br>" .mysqli_error($conn);
	}
	mysqli_close($conn);


}

?>


<h1>Update status of Employee</h1>


<form action="UpdateEmployeeStatus.php" method="POST">
<span style="font-weight:bold">Service ID: </span>
<input type="text" name="serviceID" value="<?php echo $serviceID;?>" />
<br /><br />

<span style="font-weight:bold">Name: </span>
<input type="text" name="ename" value="<?php echo $ename;?>" />
<br /><br />


<span style="font-weight:bold">Status: </span>
	<select name="status">
		<option value="Available" selected>Available</option>
		<option value="Rented" selected>Rented</option>
		
	</select>
	<br /><br />


<p> 
<input type="submit" name="submit" value="Submit" />
<input type="submit" name="delete" value="Delete" />
<input type="reset" value="Reset Form" />


</form>

       </div>
      </div>
    </div>
	<hr>
  </div>

	</div>
</div>
</div>
</body>

</html>