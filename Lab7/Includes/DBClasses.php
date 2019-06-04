<?php   
// Class to construct Students with getters/setter
class StudentClass
{
    // property declaration
    private $firstname="";
    private $lastname="";
    private $password="";
    private $psusername="";
   
    // Constructor
    public function __construct($firstname,$lastname,$password,$psusername)
    {
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->password = $password;
      $this->psusername = $psusername;      
    }
    
    // Get methods 
	  public function getFirstname ()
    {
    	return $this->firstname;
    } 
	  public function getLastname ()
    {
    	return $this->lastname;
    } 
	  public function getPassword ()
    {
    	return $this->password;
    } 
	  public function getPsusername ()
    {
    	return $this->psusername;
    } 
	  

    // Set methods 
    public function setFirstname ($value)
    {
    	$this->firstname = $value;    	
    }
    public function setLastname ($value)
    {
    	$this->lastname = $value;    	
    }
    public function setPassword ($value)
    {
    	$this->password = $value;    	
    }
    public function setPsusername ($value)
    {
    	$this->psusername = $value;    	
    }     
    
} // End Studentclass

 class DBparmsClass
	{
	    // property declaration  
	    private $username="";
	    private $password="";
	    private $host="";
	    private $db="";
	   
	    // Constructor
	    public function __construct($myusername,$mypassword,$myhost,$mydb)
	    {
	      $this->username = $myusername;
	      $this->password = $mypassword;
			  $this->host = $myhost;
				$this->db = $mydb;
	    }
	    
	    // Get methods 
		  public function getUsername ()
	    {
	    	return $this->username;
	    } 
		  public function getPassword ()
	    {
	    	return $this->password;
	    } 
		  public function getHost ()
	    {
	    	return $this->host;
	    } 
		  public function getDb ()
	    {
	    	return $this->db;
	    } 	 
	
	    // Set methods 
	    public function setUsername ($myusername)
	    {
	    	$this->username = $myusername;    	
	    }
	    public function setPassword ($mypassword)
	    {
	    	$this->password = $mypassword;    	
	    }
	    public function setHost ($myhost)
	    {
	    	$this->host = $myhost;    	
	    }
	    public function setDb ($mydb)
	    {
	    	$this->db = $mydb;    	
	    }    
	    
	} // End DBparms class
	


?>