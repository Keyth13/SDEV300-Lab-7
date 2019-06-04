<?php  
require_once('Includes/DBClasses.php');		
function getDbparms()
	 {
	 	$trimmed = file('parms/dbparms.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$key = array();
	$vals = array();
	foreach($trimmed as $line)
	{
		  $pairs = explode("=",$line);    
	    $key[] = $pairs[0];
	    $vals[] = $pairs[1]; 
	}
	// Combine Key and values into an array
	$mypairs = array_combine($key,$vals);
	
	// Assign values to ParametersClass
	$myDbparms = new DbparmsClass($mypairs['username'],$mypairs['password'],
	                $mypairs['host'],$mypairs['db']);
	
	// Display the Paramters values
	return $myDbparms;
	 }
	 
function valid_password($password) {
		$check_upper = '/[A-Z]/';
		$check_lower = '/[a-z]/';
		$check_number = '/[0-9]/';
		$check_special = '/[!@#$%^&*()\-_=+{};:,<.>]/';
		
		if(preg_match_all($check_upper, $password, $o)<1) return FALSE;
		
		if(preg_match_all($check_lower, $password, $o)<1) return FALSE;
		
		if(preg_match_all($check_number, $password, $o)<1) return FALSE;
		
		if(preg_match_all($check_special, $password, $o)<1) return FALSE;
		
		if(strlen($password)<8) return FALSE;
		
		return TRUE;
	}	 
	 
?>