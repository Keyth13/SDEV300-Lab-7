<html>
	<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
   <title>Delete Account </title>
</head>
<body > 

<?php   			

require_once('Includes/DBQueries.php');	
require_once('Includes/DBClasses.php');	

session_start();
	

// Check to see if Delete name is provided
	if(isset($_POST["deletestudent"])){
		validate_form();
	}
	else {
		$messages = array();
		show_form($messages);
	}
  	
	
	function show_form($messages) {
		$user = $_SESSION['Username'];
		$password = "";
	?>
		<h1>Welcome, <?php echo $user ?></h1>
		<h5>To delete record, please verify account.</h5>
			<p>
				<form name="verifylogin" method="POST" action="deletestudent.php">
					<input type="hidden" name="op" value="login">
					
					Username:<br>
					<input type="text" name="user" size="60"><br>
					
					Password:<br>
					<input type="password" name="pass" size="60"><br>
					
					<input type="submit" value="Verify" name="deletestudent">
				</form>
			</p>
	<?php
	}
	?>
	
	<?php
	function validate_form() {
		$messages = array();
		$redisplay = false;
		$students = selectStudents();
		//$user = $_POST["user"];
		$sessionUsername = $_SESSION['Username'];
		$enteredWsname = $_POST["user"];
		//$enteredPassword = $_POST["password"];
		$mysqli = connectdb();
		if($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		//printf("Made it into validate_form(), just before query start");
		//echo "<p></p>";
		$query = "SELECT * FROM students WHERE PSUsername = '$enteredWsname'";
		$result = $mysqli->query($query);
		if($result->num_rows === 1) {
			$row = $result->fetch_row();
			if($sessionUsername === $enteredWsname) {

				if(password_verify($_POST["pass"], $row[3])) {
					//printf("%s, %s\n", $sessionUsername, $enteredWsname);
					deleteIt($enteredWsname);	
					$result->close();
					$mysqli->close();					
					header('Location: welcome.html');
				}
				else {
					printf("%s, %s\n", password_hash($enteredPassword, PASSWORD_DEFAULT), $row[3]);
				}
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
