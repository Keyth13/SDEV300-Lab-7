<?php  
require_once('Includes/DBConnect.php');		
require_once('Includes/DBClasses.php');		
		
function selectStudents ()
  {
		
		// Connect to the database
   $mysqli = connectdb();
		
	 
		// Add Prepared Statement
		$Query = "Select firstName,lastName,password,Psusername from Students";	         
	          
		$result = $mysqli->query($Query);
		$myStudents = array();
if ($result->num_rows > 0) {    
    while($row = $result->fetch_assoc()) {
    	// Assign values
    	$firstname = $row["firstName"];
    	$lastname = $row["lastName"];
    	$password = $row["password"];
    	$psusername= $row["Psusername"];    	
      
       // Create a Student instance     
       $studentData = new Studentclass($firstname,$lastname,$password,$psusername);
       $myStudents[] = $studentData;         
      }    
 } 

	$mysqli->close();
	
	return $myStudents;		
		
	}

	function insertStudent ($student)
  {
		
		// Connect to the database
   $mysqli = connectdb();
		
	$firstname = $student->getFirstname();
	$lastname = $student->getLastname();
	$wsname = $student->getPsusername();
	$password = $student->getPassword();
	
		
		// Add Prepared Statement
		$Query = "INSERT INTO Students 
	          (Psusername, firstName,lastName,password) 
	           VALUES (?,?,?,?)";
	           
		
		$stmt = $mysqli->prepare($Query);
				
$stmt->bind_param("ssss", $wsname,$firstname,$lastname,$password);
$stmt->execute();		
		
	
	$stmt->close();
	$mysqli->close();
		
		return true;
	}


	
	function countStudent ($student)
  {  	  	 
  	// Connect to the database
   $mysqli = connectdb();
   $firstname = $student->getFirstname();
   $lastname = $student->getLastname();
   $wsname = $student-> getPsusername();
   $password = $student->getPassword();
   
			
	// Define the Query
	// For Windows MYSQL String is case insensitive
	 $Myquery = "SELECT count(*) as count from Students
		   where Psusername='$wsname'";	 
		
	 if ($result = $mysqli->query($Myquery)) 
	 {
	    /* Fetch the results of the query */	     
	    while( $row = $result->fetch_assoc() )
	    {
	  	  $count=$row["count"];	    			   	     	  	     	  
	    }	 
	
 	    /* Destroy the result set and free the memory used for it */
	    $result->close();	      
   }
	
	$mysqli->close();   
	    
	return $count;
  	  	
  }
  	
// Function to Delete Student  	
  function deleteIt($studentD) {  	
  	// Connect to the database
   $mysqli = connectdb();
   
   // Add Prepared Statement
		$Query = "Delete from Students 
		         where psusername = ?";	          
	           
		
		$stmt = $mysqli->prepare($Query);
				
   // Bind and Execute
   $stmt->bind_param("s", $studentD);
   $stmt->execute();

   // Clean-up		
	   $stmt->close();   
     $mysqli->close();
  }
	  	
	function getStudent ($studentD) {
  	// Connect to the database
   $mysqli = connectdb();
   
   // Add Prepared Statement
		$Query = "Select firstName, lastName, password, Psusername from Students 
		         where Psusername = ?";	         
	           
		$stmt = $mysqli->prepare($Query);
				
// Bind and Execute
$stmt->bind_param("s", $studentD);
$result = $stmt->execute();

 $stmt->bind_result($firstName,$lastName,$password,$psusername);
 
  /* fetch values */
    $stmt->fetch();
  $studentData = new Studentclass($firstName,$lastName,$password,$psusername);

// Clean-up				
	$stmt->close();   
   $mysqli->close();
   return $studentData;
  }


// Final Update
function FinalUpdate($student) {
	// Assign values
  $firstname = $student->getFirstname();
  $lastname = $student->getLastname();
  $psusername = $student->getPsusername();
  $password = $student->getPassword();
  
  // update
  // Connect to the database
   $mysqli = connectdb();		
	 		
		// Add Prepared Statement
		$Query = "Update Students set FirstName = ?,
		         lastName = ?, password = ?, psusername = ?
		         where Psusername = ?";
		         
	                    
		
		$stmt = $mysqli->prepare($Query);
				
$stmt->bind_param("sssss", $firstname, $lastname, $password,$psusername,$psusername);
$stmt->execute();

 //Clean-up				
	$stmt->close();   
   $mysqli->close();

}
	  	
?>