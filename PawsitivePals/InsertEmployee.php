<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert New Employee</title>
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
    <h1><b>PawsitivePals</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16">
      <span class="w3-margin-right">Filter:</span> 
      <button class="w3-button w3-white" onclick="window.location.href='ListEmployee.php'">
	  <i class="fa fa-map-pin w3-margin-right"></i>List all availability</button>
	  
      <!-- <button class="w3-button w3-white" onclick="window.location.href='UpdateProductStatus.php'">
	  <i class="fa fa-map-pin w3-margin-right"></i>Update Product Status</button>-->
      
	  <button class="w3-button w3-white w3-hide-small" onclick="window.location.href='InsertEmployee.php'">
	  <i class="fa fa-photo w3-margin-right"></i>Insert Employee</button>
	
	<div style="float:right" id="intro1">
	<button class="w3-button w3-white w3-hide-small" 
	onclick="window.location.href='Logout.php'"><i class="fa fa-sign-out"></i> Log out</button>
	</div>
	
	<div style="float:right" id="intro">
	<!--<button class="w3-button w3-white w3-hide-small"
	onclick="window.location.href='InsertProduct.php'"><i class="fa fa-home"></i> Home</button>-->
	</div>
	
	</div>
    </div>
  </header>

<?php

$name = "";

$errors = 0;
session_start();

if(isset($_SESSION['name']) && $_SESSION['name']) {
	echo "<h3><font color='teal'>Welcome, you are logged in as ". $_SESSION['name']. "!". "</h3></font>";
}

if ($errors == 0) {
	$conn = @mysqli_connect ("localhost", "root", "");
	if ($conn === FALSE) {
		echo "<p>Unable to connect to the database server. " . "Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p>\n";
		++$errors;
	}
	else {
		$DBName = "pawsitivepals";
		$result = @mysqli_select_db($conn,$DBName);
		if ($result === FALSE) {
			echo "<p>Unable to select the database. " . "Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>\n";
			++$errors;
		}
	}
}

$serviceID = "";
$ename = "";
$description = "";
$status = "";
$regularcostperday = "";
$rentdate = "";
$returndate = "";
$rentBy = "";

$serviceIDErr = $enameErr = $descriptionErr = $statusErr = $regularcostperdayErr = "";

//check if the fields are all being filled up and post error message if its not being fill up
if (isset($_POST['submit']))
{
	$errors = 0;

	if (empty($_POST["serviceID"])) {
		$serviceIDErr = "Service id is required";
		++$errors;
	  } else{
		$serviceID = $_POST['serviceID'];
	  }
	  if (empty($_POST["ename"])) {
		$enameErr = "Name is required";
		++$errors;
	  } else{
		$ename = $_POST['ename'];
	
	  if (empty($_POST["description"])) {
		$descriptionErr = "Description is required";
		++$errors;
	  } else{
		$description = $_POST['description'];
	  }		  
	  if (empty($_POST["status"])) {
		$statusErr = "status is required";
		++$errors;
	  } else{
		$status = $_POST['status'];
	  }	
	  if (empty($_POST["regularcostperday"])) {
		$regularcostperdayErr = "Cost is required";
		++$errors;
	  } else{
		$regularcostperday = $_POST['regularcostperday'];
	  }	
	  
}
//insert into services table if all details are being filled up
if ($errors == 0) {
$sqlquery = "SELECT 'name' FROM 'administrator' WHERE 'name' = '$name'"; 

$sqlString = "INSERT INTO services (serviceID, ename, description, status, regularcostperday, 
rentdate, returndate, rentBy)
	  VALUES ('$serviceID', '$ename', '$description', '$status', '$regularcostperday',
		'$rentdate', '$returndate',  '$rentBy')";
	  $queryresult = mysqli_query($conn, $sqlString);
	  
	if ($queryresult === FALSE) {
		
		echo "<p>Unable to execute the query. " . "Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>\n";
		++$errors;
		}else echo "<script type='text/javascript'>alert('Employee is successfully added')</script>";
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

<h2>Please fill in the employee details</h2>
<hr />

<form action="InsertEmployee.php" method="POST">
<span style="font-weight:bold">Service ID: </span>
<input type="text" name="serviceID" />
<?php echo $serviceIDErr?>&nbsp;
<br /><br />

<span style="font-weight:bold">Name: </span>
<input type="text" name="ename" />
<?php echo $enameErr?>&nbsp;
<br /><br />

<span style="font-weight:bold">Description: </span>
<input type="text" name="description" />
<?php echo $descriptionErr?>&nbsp;

<br /><br />

<span style="font-weight:bold">Status: </span>
<input type="text" name="status" />
<?php echo $statusErr?>&nbsp;
	<br /><br />

<span style="font-weight:bold">Regular Cost Per Day: </span>
<input type="text" name="regularcostperday" />
<?php echo $regularcostperdayErr?>&nbsp;
 
<br /><br />



<p> <input type="submit" name="submit" value="Insert service" />
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