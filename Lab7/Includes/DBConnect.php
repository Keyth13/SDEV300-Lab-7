<?php   
require_once('Includes/Utils.php');		
 function connectdb() {      		
		// Get the DBParameters
	  $mydbparms = getDbparms();
	  
	  // Try to connect
	  $mysqli = new mysqli($mydbparms->getHost(), $mydbparms->getUsername(), 
	                        $mydbparms->getPassword(),$mydbparms->getDb());
	
	   if ($mysqli->connect_error) {
	      die('Connect Error (' . $mysqli->connect_errno . ') '
	            . $mysqli->connect_error);      
	   }
	  return $mysqli;
	}
	
	
	 

?>