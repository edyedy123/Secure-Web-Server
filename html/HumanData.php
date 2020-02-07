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
if($_SESSION["role"] !== 'Human Resources' AND $_SESSION["role"] !== 'All'){
    header("location: logout.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Human Resource Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head> 
<p><body> 

<h3>Human Resource Data Search Form </h3> 
<a class="btn btn-secondary" href="logout.php" role="button">Log Out »</a>
<table>
<tr>
	 <td>
		<p>First Name</p> 
		<form  method="post" action="HumanData.php?go"  id="searchform1"> 
			<input  type="text" name="fName" maxlength="20"> 
			<input  type="submit" name="submit" value="Search"> 
		</form> 
 	</td>
 	<td>
		<p>Last Name</p> 
		<form  method="post" action="HumanData.php?go"  id="searchform2"> 
			<input  type="text" name="lName" maxlength="20"> 
			<input  type="submit" name="submit" value="Search"> 
		</form> 
 	</td>
 	<td>
		<p>Employee ID</p> 
		<form  method="post" action="HumanData.php?go"  id="searchform3"> 
			<input  type="number" name="id" max="4000"> 
			<input  type="submit" name="submit" value="Search"> 
		</form> 
 	</td>
 	<td>
		<p>Manager</p> 
		<form  method="post" action="HumanData.php?go"  id="searchform4"> 
			<input  type="text" name="manager" maxlength="20"> 
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
	    <th>Id</th>
	    <th>First Name</th>
	    <th>Last name</th>
	    <th>Gender</th>
	    <th>Health Card Number</th>
	    <th>SIN</th>
	    <th>University</th>
	    <th>Home Address</th>
	    <th>Email</th>
	    <th>Employment Id</th>
	    <th>Job Role</th>
	    <th>Pay</th>
	    <th>Manager</th>
	</tr>
  </thead>
<?php
  if(isset($_POST['submit'])){
	  if(isset($_GET['go'])){

		//Filter_var() and mysqli_real_escape_string() used to steralize input

	  	if($_POST['fName']){
		  $fName=filter_var($_POST['fName'],FILTER_SANITIZE_STRING);
		  $fName=mysqli_real_escape_string($link,$fName);
		  $sql="SELECT * FROM staff_data WHERE first_name = '".$fName."'";
		}
		if($_POST['lName']){
		  $lName=filter_var($_POST['lName'],FILTER_SANITIZE_STRING);
		  $lName=mysqli_real_escape_string($link,$lName);
		  $sql="SELECT * FROM staff_data WHERE last_name = '".$lName."'";
		}
		if($_POST['id']){
		  $id=filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
		  $id=mysqli_real_escape_string($link,$id);
		  $sql="SELECT * FROM staff_data WHERE id = '".$id."'";
		}
		if($_POST['manager']){
		  $manager=filter_var($_POST['manager'],FILTER_SANITIZE_STRING);
		  $manager=mysqli_real_escape_string($link,$manager);
		  $sql="SELECT * FROM staff_data WHERE manager = '".$manager."'";
		}

		  //-run  the query against the mysql query function
		  $result=mysqli_query($link,$sql);

		  //-create  while loop and loop through result set
		  while($row=mysqli_fetch_array($result)){
				  
		          //Date was formated wrong in the sql source file so I took it out

			  //-display the result of the array
		          ?>
		          <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['first_name']?></td>
                    <td><?php echo $row['last_name']?></td>
                    <td><?php echo $row['gender']?></td>
                    <td><?php echo $row['health_card_number']?></td>
                    <td><?php echo $row['SIN']?></td>
                    <td><?php echo $row['university']?></td>
                    <td><?php echo $row['home_address']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['employment_id']?></td>
                    <td><?php echo $row['job_role']?></td>
                    <td><?php echo $row['pay']?></td>
                    <td><?php echo $row['manager']?></td>
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