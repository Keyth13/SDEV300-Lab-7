<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
   <title>Update Student </title>
</head>
<body > 

<?php   			

require_once('Includes/DBQueries.php');		
require_once('Includes/DBClasses.php');		

session_start();
if(!isset($_SESSION['Username'])) {
		echo "Please Login again";
		echo "<a href='login.php'>Click Here to Login</a>";
	}
	else {
		$now = time();
		if($now > $_SESSION['expire']) {
			session_destroy();
			echo "Your session has expired! <a href='login.php'>Login here</a>";
		}
		else {
			// Check to see if update name is provided
			if (isset($_GET["psusername"])) {
				if($_SESSION['Username'] == $_GET['psusername']) {
					$toUpdate = $_GET["psusername"];
					updateIt($toUpdate);
				}
				else {
					header('Location: welcome.html');
				}
			}
			else if (isset($_POST["UpdateMe"])) {
				// Assign values
				$students = selectStudents();
				foreach ($students as $data) {
					if($_SESSION['Username'] == $data->getPsusername()) {
						if(isset($_POST['firstname'])) {
							$firstname=$_POST['firstname'];
						} else {
							$firstname=$data->getFirstname();
						}
						
						if(isset($_POST['lastname'])) {
							$lastname=$_POST['lastname'];
						} else {
							$lastname=$data->getLastname();
						}
						
						if(isset($_POST['psusername'])) {
							$psusername=$_POST['psusername'];
						} else {
							$psusername=$data->getPsusername();
						}
						
						if(isset($_POST['password'])) {
							$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
							
						}
						else {
							$password=$data->getPassword();
						}
					}
				}
				if($_SESSION['Username'] != $_POST['psusername']) {
					//$password = $data->getPassword();
					deleteIt($_SESSION['Username']);
					$student = new StudentClass($firstname,$lastname,$password,$psusername);
					insertStudent($student);
					$_SESSION['Username'] = $_POST['psusername'];
				}
				else {
					$student = new StudentClass($firstname,$lastname,$password,$psusername);
					FinalUpdate($student);
				}

				// Update the database
				
				// Successu message
				echo "<h3>$firstname $lastname has been updated!</h3> ";  
				echo "<p></p>";  
				echo "<a href='StudentApp.html'> Return to Student App.</a>";  
			}
			else {
				show_form();  	    
			}
		}
	}
  	
	
function show_form() { 
echo "<form name='logout' method='post' action=LogoutUser.php>
		<input name='btnsubmit' type='submit' value='Logout'>
		</form>";			
	$user = $_SESSION['Username'];
	echo "<p></p>";
	echo "<h2> Select the Student to Delete</h2>";
	echo "<p></p>";	 	
	// Retrieve the students
	$students = selectStudents();
	
	echo "<h3> " . "Number of Students in Database is:  " . sizeof($students) . "</h3>";
	// Loop through table and display
	echo "<table border='1'>";
	foreach ($students as $data) {
		if($data->getPsusername() === $user) {
			echo "<tr>";	
			// Provide Hyperlink for Selection
			// Could also use Form with Post method 
			echo "<td> <a href=UpdateStudent.php?psusername=" . $data->getPsusername() . ">" . "Update" . "</a></td>";
			echo "<td>" . $data->getFirstname() . "</td>";
			echo "<td>" . $data->getLastname() . "</td>";
			echo "<td>" . "XXXXXXXX" . "</td>";
			echo "<td>" . $data->getPsusername() . "</td>";
			echo "</tr>";
		}
}
	echo "</table>";

} // End Show form
?>

<?php
  	
 
  function updateIt($studentD) {
  	
	$student = getStudent($studentD);
	// Extract data
	$firstname = $student->getFirstname();
	$lastname = $student->getLastname();
	//$password = "";
	$psusername= $student->getPsusername();
	
	// Show the data in the Form for update
	echo "<form name='logout' method='post' action=LogoutUser.php>
		<input name='btnsubmit' type='submit' value='Logout'>
		</form>";
	?>
	
	<p></p>
	<h1>Welcome, <?php echo $_SESSION['Username'] ?></h1>
	<form name="updateStudent" method="POST" action="UpdateStudent.php">	
	<table border="1" width="75%" cellpadding="0">			
			<tr>
				<td width="157">Firstname:</td>
				<td><input type="text" name="firstname" value='<?php echo $firstname ?>' size="30"></td>
			</tr>
			<tr>
				<td width="157">Lastname:</td>
				<td><input type="text" name="lastname" value='<?php echo $lastname ?>' size="30"></td>
			</tr>
			<tr>
				<td width="157">PS username:</td>
				<td><input type="text" name="psusername" value='<?php echo $psusername ?>' size="30"></td>
			</tr>
			<tr>
				<td width="157">Password:</td>
				<td><input type="password" name="password" size="30"></td>
			</tr>
			<tr>
				<td width="157"><input type="submit" value="Update" name="UpdateMe"></td>
				<td>&nbsp;</td>
			</tr>
	</table>			
	</form>
		  	
  <?php	
  }
 ?>
 
</body>
</html>
