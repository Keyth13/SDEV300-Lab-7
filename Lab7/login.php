<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
   <title>Create User </title>
</head>
<body OnLoad="document.studentlogin.name.focus();"> 

<?php   	

	require_once('Includes/DBQueries.php');		
	require_once('Includes/DBClasses.php');	

	session_start();

	if(isset($_POST["studentlogin"])) {    	 	 	 	
		validate_form();	   	     
	} 
	else {			    
		$messages = array();
		show_form($messages);  
	}
	
	function show_form($messages) {
	?>	
	<h1>Login</h1>
		<p>
			<form name="logstudentin" method="POST" action="login.php">
				<input type="hidden" name="op" value="login">
				
				Username:<br>
				<input type="text" name="user" size="60"><br>
				
				Password:<br>
				<input type="password" name="pass" size="60"><br>
				
				<input type="submit" value="Login" name="studentlogin">
			</form>
		</p>
		
		
	<?php
	} //End Show form
	?>
	
	<?php
	function validate_form() {
		$messages = array();
		$redisplay = false;
		// Assign values		
		$students = selectStudents();
		$enteredWsname = $_POST["user"];
		//$enteredPassword = $_POST["pass"];
		$mysqli = connectdb();
		if($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		
		$query = "SELECT * FROM students WHERE PSUsername = '$enteredWsname'";
		
		$result = $mysqli->query($query);
		if($result->num_rows === 1) {
			$row = $result->fetch_row();
			if(password_verify($_POST["pass"], $row[3])) {
				$_SESSION['Username'] = $enteredWsname;
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
				header('Location: StudentApp.html');
				$result->close();
				$mysqli->close();
				exit();
			}
		}
		else {
			echo '<div class="alert alert-danger">
				  <a href="login.php" class="close" data-dismiss="alert" aria-label="close">Close X</a>
				  <p><strong>Alerta!</strong></p>
				  Username or passowrd incorrect!  Please try again!.
				  </div>';
		}
		$result->close();
		$mysqli->close();
		exit();
	}		
	?>
</body>
</html>