<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Return Employee</title>
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
    <h1><b>Return Employee</b></h1>
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
$ename = "";

//get the specific service id and ename from the database
if (isset($_POST['return'])) {
	$serviceID = $_POST['serviceID'];
	$ename = $_POST['ename'];
}

$description = "";
$status = "";
$selectedcategory = "";

$sql = "";
$sqlresult = "";


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

if (isset($_POST['submit'])) {
	$errors = 0;
	$serviceID = $_POST['serviceID'];
	$ename = $_POST['ename'];
    $name = $_POST['name'];	 

	
	$serviceID = htmlspecialchars(strip_tags($serviceID));
	$name = htmlspecialchars(strip_tags($name));
	
	$returneddatestring = date ('Y-m-d H:i:s');
	$returneddate = new DateTime();
	
	//select that specific service
	$sql = "SELECT * FROM services WHERE serviceID =".$serviceID;
			$sqlresult = mysqli_query($conn, $sql);
			
	if ($sqlresult === FALSE) {
		
	} else { //get the specific service details from database
	while (($row = mysqli_fetch_assoc($sqlresult)) !== NULL) {
		$serviceID = $row['serviceID'];
		$ename = $row['ename'];
		$description = $row['description'];
		$status = $row['status'];
		$rentdate = $row['rentdate'];
		$returndate = $row['returndate'];
		$regularcostperday = $row['regularcostperday'];
		$rentBy = $row['rentBy'];
		
		$returndate = new DateTime($returndate);
		$result = $returndate->format("Y-m-d H:i:s");
		
		/*$diff = date_diff($duedate, $returneddate);
		
		//find the days difference between return date and due date
		//$days = $diff->format("%a");
		
		//check if the return date is more than 3 days or lesser
		if ($duedate > $returneddate) {
			$overdueMsg= "No extended charge for service ID". $serviceID;
		} else if ($duedate < $returneddate) {
			$charge = $days * $regularcostperday;
			$overdueMsg = "Please pay extended charge: $". $charge;
		}*/
	 }
	}
	//update services table from rented to available
		$query = "UPDATE services SET status='Available', rentBy=NULL, rentdate=NULL, returndate=NULL  WHERE serviceID=".$serviceID; 
		
		//insert into History table to store the details of the returned service by that specific user
		$SQLQuery = "INSERT INTO History (serviceID, ename, description, status, regularcostperday, rentdate, returneddate, rentBy) VALUES ('".$serviceID."', '".$ename."', '".$description."', 'Available', '".$regularcostperday."', '".$rentdate."', 
		'".$returneddatestring."', '".$rentBy."');";
		
		$QueryResult= mysqli_query($conn, $SQLQuery);

		//$QueryResult = @$this->DBConnect->query($SQLString);
		if ($QueryResult === FALSE) {
		echo "<p>Unable to execute the query. " . "Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>\n";
		}else {
		//echo "Insert query successfully executed.";
		}

		if (mysqli_query($conn, $query) == TRUE) {	
			date_default_timezone_set('Asia/Singapore');
			
			echo "<script type='text/javascript'>alert('serviceID ".$serviceID." successfully completed\\nCompleted on: ".$returneddatestring."')</script>";
			return true;
			}else{
			echo "\n error";
			}			
}

?>

<form method="post" action="ReturnEmployee.php">
		
			<p>Service ID <input type="text" name="serviceID" value="<?php echo $serviceID?>" readonly/>&nbsp;
			Name <input type="text" name="ename" value="<?php echo $ename?>" readonly/></p>
			<p>User <input type="text" name="name" value="<?php echo $_SESSION['name'] ?>" readonly/>
		
		<br /><br />

		<input type="submit" name="submit" value="Return Employee" />
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