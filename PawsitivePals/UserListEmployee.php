<?php
//user can search by Employeeid, category, brand or status from the textbox
if(isset($_POST['search']))
{
	$search = $_POST['search'];
	$query = "SELECT * FROM services WHERE CONCAT(serviceID, ename, description, status) LIKE '%".$search."%'";
	$sql_result = filterTable($query);
}
else {
	$query = "SELECT * FROM services WHERE status='available'";
	$sql_result = filterTable($query);
}

function filterTable($query) {
	
	$conn = mysqli_connect("localhost", "root", "", "pawsitivepals");
	$filter_Result = mysqli_query($conn, $query);
	return $filter_Result;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>View Employees</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
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
    <h1><b>Services available</b></h1>
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



$server = "localhost";
$databasename="pawsitivepals";
$username="root";
$password = "";

$conn = mysqli_connect($server, $username, $password, $databasename);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>

			<form action="UserListEmployee.php" method="POST">
			<input type="text" name="search" id="myInput" placeholder="Search services" title="Type in a name">
			   Search by: <select name="searchType" id="searchType" onchange="changeType(this.value)">
				<option value="2">Service ID</option>
				<option value="3">Category</option>
				<option value="4">Description</option>
				<option value="5">Status</option>
			  </select>

			 <input type="submit" value="Submit" />
			</form>
			<br/>
			
<table id ='myTable' border='1' width='140%'>
  <tr>
    <td><strong>Service ID</strong></td>
    <td><strong>Category</strong></td>
    <td><strong>Description</strong></td>
    <td><strong>Cost per service</strong></td>
    <td><strong>Status</strong></td>
	<td><strong>Action</strong></td>
  </tr>

<?php
	
	while ($row = mysqli_fetch_array($sql_result)):
?>
  <tr>
    <td><?php echo $row['serviceID']; ?></td>
    <td><?php echo $row['ename']; ?></td>
    <td><?php echo $row['description']; ?></td>
    <td><?php echo $row['regularcostperday']; ?></td>
    <td><?php echo $row['status']; ?></td>
	<td><?php if ($row['status'] == 'Rented' || $row['status'] == 'rented'){
				echo "<td>-</td>";
				}else if($row['status'] == 'available' || $row['status'] == 'Available' ){
				echo "<form method='POST' action='RentEmployee.php'><input type='hidden' name='serviceID' value='".$row['serviceID']."' /><input type='hidden' name='ename' value='".$row['ename']."' />
				<input type='submit' name='rent' value='Rent'/></form>";				
				} ?></td>

  </tr>
  <?php endwhile;?>
</table>


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