<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
   <title>Create Student </title>
</head>
<body OnLoad="document.createstudent.firstname.focus();"> 

<?php   	

	require_once('Includes/DBQueries.php');		
	require_once('Includes/DBClasses.php');		

	if(isset($_POST["CreateSubmit"])) {    	 	 	 	
		validate_form();	   	     
	} 
	else {			    
		$messages = array();
		show_form($messages);  
	} 
	
	function show_form($messages) { 		
			
		
		// Assign post values if exist
		$firstname="";
		$lastname="";
		$wsname="";
		$password="";
		if (isset($_POST["firstname"]))
		  $firstname=$_POST["firstname"];
		if (isset($_POST["lastname"]))
		  $lastname=$_POST["lastname"];	  
		if (isset($_POST["wsname"]))
		  $wsname=$_POST["wsname"];  
		if (isset($_POST["password"]))
		  $password=$_POST["password"];
	
	echo "<p></p>";
	echo "<h2> Enter New Student</h2>";
	echo "<p></p>";	 	
	?>
	<h5>Complete the information in the form below and click Submit to create your account. All fields are required.</h5>
	<form name="createstudent" method="POST" action="InsertStudent.php">	
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
				<td><input type="text" name="wsname" value='<?php echo $wsname ?>' size="30"></td>
			</tr>
			<tr>
				<td width="157">Password:</td>
				<td><input type="password" name="password" value='<?php echo $password ?>' size="30"></td>
				<td width="157">Must include: 8 characters, 1 upper, 1 lower, 1 number and 1 special character</td>
			</tr>
			<tr>
				<td width="157"><input type="submit" value="Submit" name="CreateSubmit"></td>
				<td>&nbsp;</td>
			</tr>
	</table>			
	</form>
	
	<?php
} // End Show form
?>

<?php
	function validate_form() {
			
		$messages = array();
		$redisplay = false;
		// Assign values
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$wsname = $_POST["wsname"];
		//$password = $_POST["password"];
		
		//if(preg_match((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$), $_POST['password']):
		
		if(valid_password($_POST["password"])) {
			$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$hashed_password = trim($hashed_password);
			$student = new StudentClass($firstname,$lastname,$hashed_password,$wsname);
			$count = countStudent($student);    	  
	
			// Check for accounts that already exist and Do insert
			if ($count==0) {  		
				$res = insertStudent($student);
				if ($res) {
					echo "<h3>$firstname $lastname has been added!</h3> ";    
					echo "<p></p>";  
					echo "<a href='login.php'> Please login.</a>";   
				}
				else {
					echo "<h3>$firstname $lastname was not added. DB error!</h3> ";   
					echo "<p></p>"; 
					echo "<a href='welcome.html'> Return to Welcome page.</a>";  
				}
			}
			else {
				echo "<h3>A student account with that PSusername already exists.</h3> ";  
				echo "<p></p>"; 	
				echo "<a href='welcome.html'> Return to Welcome page.</a>";  	
			}
		}
		else {
			echo "<h3>Password does not meet minimum requirements!</h3>";
			echo "<p></p>";
			echo "<a href='insertstudent.php'> Return to Registration page.</a>";
		}
	}

 ?>
</body>
</html>

