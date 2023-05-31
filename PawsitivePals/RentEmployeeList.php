
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>List All Rented Services</title>
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

table {

  border-collapse: collapse;

}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
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
    <h1><b>Rented Services</b></h1>
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

$name = "";
$errors = 0;
session_start();

if(isset($_SESSION['name']) && $_SESSION['name']) {
	echo "<h3><font color='teal'>Welcome, you are logged in as ". $_SESSION['name']. "!". "</h3></font><hr />";
}


$serviceID = "";
$category = "";
$brand= "";
$description = "";
$status = "";
$regularcostperday = "";


$sqlresult = "";
$sql = "";


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
 
//get the Employee details from database which that particular user rented and havent return
$sql = "SELECT * FROM services WHERE status='Rented' AND rentBy='".$_SESSION['name']. "'";
$sqlresult = mysqli_query($conn, $sql);

echo "<table id ='myTable' border='1' width='140%'>\n";
echo "<tr>
 <th style=''>Service ID</th>
 <th style=''>Name</th>
 <th style=''>Description</th>
 <th style=''>Status</th>
 <th style=''>Regular Cost Per Day</th>
 <th style=''>Rent Date</th>
 <th style=''>Return Date</th>
 <th style=''>Action</th></tr>\n";
 
 
if (mysqli_num_rows($sqlresult) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($sqlresult)) {
       

echo "<tr><td>" . $row['serviceID'] . "</td>\n";
echo "<td>" . $row['ename'] . "</td>\n"; 
echo "<td>". $row['description']. "</td>\n";
echo "<td>". $row['status']. "</td>\n";
echo "<td>". $row['regularcostperday']. "</td>\n";
echo "<td>". $row['rentdate']. "</td>\n";
echo "<td>". $row['returndate']. "</td>\n";
//category and Employee id will be auto generated once they press this button
echo "<td><form method='POST' action='ReturnEmployee.php'><input type='hidden' name='serviceID' value='".$row['serviceID']."' /><input type='hidden' name='ename' value='".$row['ename']."' /><input type='submit' name='return' value='Return'/></form></td></tr>\n";

 
    }
	echo "</table>\n";
	
} else {
    echo "0 results";
}

mysqli_close($conn);


?>

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