<?php
require_once ("app/Config.php");

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: logout.php");
    exit;
}
//Cheking id user is authorized
if($_SESSION["role"] !== "It" AND $_SESSION["role"] !== 'All'){
    header("location: logout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IT Data Search </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<p><body> 

<h3> IT Data Search </h3> 
<a class="btn btn-secondary" href="logout.php" role="button">Log Out »</a>
<table>
<tr>
	 <td>
		<p>Employee ID</p> 
		<form  method="post" action="ItData.php?go"  id="searchform1"> 
			<input  type="number" name="id" max="4000"> 
			<input  type="submit" name="submit" value="Search"> 
		</form> 
 	</td>
 	<td>
		<p>Username</p> 
		<form  method="post" action="ItData.php?go"  id="searchform2"> 
			<input  type="text" name="uname" maxlength="20"> 
			<input  type="submit" name="submit" value="Search"> 
		</form> 
 	</td>
 	<td>
		<p>Access Level</p> 
		<form  method="post" action="ItData.php?go"  id="searchform3"> 
			<input  type="number" name="access" max="4000"> 
			<input  type="submit" name="submit" value="Search"> 
		</form> 
 	</td>
 </table>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

 <table>
    <thead>
     <tr>
	    <th>Employee Id</th>
	    <th>User Name</th>
	    <th>Computer Asset Number</th>
	    <th>Static Ip Address</th>
	    <th>MAC Address</th>
	    <th>Access Level</th>
	</tr>
  </thead>
<?php
  if(isset($_POST['submit'])){
	  if(isset($_GET['go'])){
		
		//Filter_var() and mysqli_real_escape_string() used to steralize input
		
	  	if($_POST['id']){
		  $id=filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
		  $id=mysqli_real_escape_string($link,$id);
		  $sql="SELECT * FROM system_access_data WHERE employee_id = '".$id."'";

		}
		if($_POST['uname']){
		  $uname=filter_var($_POST['uname'],FILTER_SANITIZE_STRING);
		  $uname=mysqli_real_escape_string($link,$uname);
		  $sql="SELECT * FROM system_access_data WHERE username = '".$uname."'";
		}
		if($_POST['access']){
		  $access=filter_var($_POST['access'],FILTER_SANITIZE_NUMBER_INT);
		  $access=mysqli_real_escape_string($link,$access);
		  $sql="SELECT * FROM system_access_data WHERE access_level = '".$access."'";
		}
		 
		//-run  the query against the mysql query function
		$result=mysqli_query($link,$sql);

		//-create  while loop and loop through result set
		while($row=mysqli_fetch_array($result)){
		        
			   //-display the result of the array
?>
		        <tr>
                  <td><?php echo $row['employee_id']?></td>
                  <td><?php echo $row['username']?></td>
                  <td><?php echo $row['computer_asset_number']?></td>
                  <td><?php echo $row['static_ip_address']?></td>
                  <td><?php echo $row['MAC_address']?></td>
                  <td><?php echo $row['access_level']?></td>
                </tr>
<?php
	  	}
	}
	else{
	  	echo  "<p>Please enter a search query</p>";
	}
  }
?>
  </tbody>
  </table>

</body> 
</html> 
</p> 