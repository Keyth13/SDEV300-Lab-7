<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
   <title>Select Student </title>
</head>
<body OnLoad="document.createstudent.firstname.focus();"> 

<?php   			

	require_once('Includes/DBQueries.php');		
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
			show_form(); 
		}
	}
	
   
			
	function show_form() { 			
		echo "<form name='logout' method='post' action=LogoutUser.php>
		<input name='btnsubmit' type='submit' value='Logout'>
		</form>";
		echo "<p></p>";
		echo "<h2> The Current Students</h2>";
		echo "<p></p>";	 	
		// Retrieve the students
		$students = selectStudents();
		
		echo "<h3> " . "Number of Students in Database is:  " . sizeof($students) . "</h3>";
		// Loop through table and display
		echo "<table border='1'>";
		// Table headers
		echo "<tr> <td><b> Firstname</b> </td>";
		echo "<td> <b>Lastname</b> </td>";
		//echo "<td><b> Password</b> </td>";
		echo "<td> <b>PSUsername</b> </td> </tr>";
		
		foreach ($students as $data) {
		echo "<tr>";	
		 echo "<td>" . $data->getFirstname() . "</td>";
		 echo "<td>" . $data->getLastname() . "</td>";
		 //echo "<td>" . $data->getPassword() . "</td>";
		 echo "<td>" . $data->getPsusername() . "</td>";
		echo "</tr>";
	  }
		echo "</table>";
	
	} // End Show form
	 echo "<p></p>"; 
	 echo "<a href='StudentApp.html'> Return to Student App.</a>";  
?>

</body>
</html>
