<?php 

    #Ensure that the client has provided a value for "UserNameToSearch" and  "KeyToSearch"
    if (isset($_POST["UserNameToSearch"]) && $_POST["UserNameToSearch"] != "" && isset($_POST["KeyToSearch"]) && $_POST["KeyToSearch"] != ""){ 
         
        #Setup variables 
        $username = $_POST["UserNameToSearch"]; 
		$key_temp = $_POST["KeyToSearch"];	

		$PW_temp = bin2hex(hash("sha256", $key_temp . $key_temp . $key_temp ));
		$PW = bin2hex(hash("sha256", $key_temp));
		
	require_once("connect.php");
	  #Connect to Database 
        //$con = mysqli_connect("localhost","root","", "VSN"); 
         
        #Check connection 
        //if (mysqli_connect_errno()) { 
        //    echo 'Database connection error: ' . mysqli_connect_error(); 
         //   exit(); 
        //} 

        #Escape special characters to avoid SQL injection attacks 
        $username = mysqli_real_escape_string($con, $username); 
      

        #Query the database to get the user details. 
        $userdetails = mysqli_query($con, "SELECT * FROM users WHERE un = '$username' AND pw = '$PW'"); 
        

        #If no data was returned, check for any SQL errors 
        if (!$userdetails) { 
            echo 'Could not run query: ' . mysqli_error($con); 
            exit; 
        } 
	
        #Get the first row of the results 
        $row = mysqli_fetch_row($userdetails); 
        #Build the result array (Assign keys to the values) 
        $result_data = array(
		'id' => $row[0],
		'un' => $row[1],
		'pw' => $row[2],
		'fn' => $row[3],
		'ln' => $row[4],
		'md5hash' => $row[5]
	  	); 

        #Output the JSON data 
        echo json_encode($result_data);  
    }else{ 
        echo "Could not complete query. Missing parameter";  
    } 
?>