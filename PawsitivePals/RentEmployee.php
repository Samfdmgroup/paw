<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Rent Service</title>
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
    <h1><b>Rent Service</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16">
      <span class="w3-margin-right">Filter:</span> 
      <button class="w3-button w3-white" onclick="window.location.href='UserListEmployee.php'">
	    <i class="fa fa-map-pin w3-margin-right"></i>View All Services</button>
	  
      <button class="w3-button w3-white" onclick="window.location.href='RentEmployeeList.php'">
	    <i class="fa fa-map-pin w3-margin-right"></i>View Rented Services</button>
	  
	    <button class="w3-button w3-white w3-hide-small" onclick="window.location.href='ReturnedEmployeeList.php'">
	    <i class="fa fa-map-pin w3-margin-right"></i>Completed Services</button>
	
	<div style="float:right" id="intro1">
	<button class="w3-button w3-white w3-hide-small" 
	onclick="window.location.href='Logout.php'"><i class="fa fa-sign-out"></i> Log out</button>
	</div>
	
	<div style="float:right" id="intro">
	<!--<button class="w3-button w3-white w3-hide-small"
	onclick="window.location.href='UserListEmployee.php'" id="defaultview"><i class="fa fa-home"></i> Home</button> -->
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
session_start();

$errors = 0;
$name = "";


if(isset($_SESSION['name']) && $_SESSION['name']) {
	echo "<h3><font color='teal'>Welcome, you are logged in as ". $_SESSION['name']. "!". "</h3></font><hr />";
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

if (isset($_POST['rent'])) {
	$serviceID = $_POST['serviceID'];
	$ename = $_POST['ename'];
}

$sqlresult = "";
$sql = "";


$brand= "";
$description = "";
$status = "";
$regularcostperday = "";
$rentdate = "";
$selectedcategory = "";
$duedate= "";
$selectedcost = "";
$selectedextendedcostperday = "";
$renterID = "";




if (isset($_POST['submit'])) {
	$errors = 0;
	
	$serviceID = $_POST['serviceID'];
	$ename = $_POST['ename'];
    $name = $_POST['name'];
	
	$serviceID=htmlspecialchars(strip_tags($serviceID));
	$name=htmlspecialchars(strip_tags($name));
	//if ($errors = 0) {
	
	$rentdate = date ('Y-m-d');
	//$duedate = date('Y-m-d', strtotime('+3 days'));
	
	$sql = "SELECT regularcostperday FROM services WHERE serviceID = 'serviceID'"; 

	$sqlresult = mysqli_query($conn, $sql);
	if ($sqlresult !== FALSE) {
		while (($row = mysqli_fetch_assoc($sqlresult)) !== NULL) {
			$regularcostperday = $row['regularcostperday'];
		}			
	}
	
$query = "UPDATE services SET status='Rented', rentBy='".$_SESSION['name']."', rentdate='".$rentdate."'
WHERE serviceid='$serviceID'"; 	
	
	if (mysqli_query($conn, $query) == TRUE) {
		date_default_timezone_set('Asia/Singapore');
		 echo "<script type='text/javascript'>alert('You have successfully rented: ".$ename." \\nRented on: ".$rentdate."\\nCost of service: $".$regularcostperday." per day')</script>";
		 return true;
		}else{
		echo "\n error updating";
		++$errors;
		}	   
	//}
	
}


?>

		<form method="post" action="RentEmployee.php">
		
			<p>Service ID <input type="text" name="serviceID" value="<?php echo $serviceID?>" readonly/>&nbsp;
			Name <input type="text" name="ename" value="<?php echo $ename?>" readonly/></p>
			<p>User <input type="text" name="name" value="<?php echo $_SESSION['name'] ?>" readonly/>

		<br /><br />

		<input type="submit" name="submit" value="Rent Employee" />
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