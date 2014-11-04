<?php 

    #Ensure that the client has provided a value for "UserNameToSearch" 
    if (isset($_POST["UserNameToSearch"]) && $_POST["UserNameToSearch"] != ""){ 
         
        #Setup variables 
        $username = $_POST["UserNameToSearch"]; 
        #echo "username =" . $username;
        #Connect to Database 
        $con = mysqli_connect("localhost","root","", "VSN"); 
         
        #Check connection 
        if (mysqli_connect_errno()) { 
            echo 'Database connection error: ' . mysqli_connect_error(); 
            exit(); 
        } 

        #Escape special characters to avoid SQL injection attacks 
        $username = mysqli_real_escape_string($con, $username); 
        #echo "username =" . $username;
 
        #Query the database to get the user details. 
        $userdetails = mysqli_query($con, "SELECT * FROM users WHERE un = '$username'"); 
        #echo "userdetails =" . $userdetails;

        #If no data was returned, check for any SQL errors 
        if (!$userdetails) { 
            echo 'Could not run query: ' . mysqli_error($con); 
            exit; 
        } 
	
        #Get the first row of the results 
        $row = mysqli_fetch_row($userdetails); 
        #echo "row =" . json_encode($row);
        #echo "row1 =" . $row[6];
        #Build the result array (Assign keys to the values) 
        $result_data = array(
		'id' => $row[0],
		'un' => $row[1],
		'fn' => $row[2],
		'ln' => $row[3],
		'md5hash' => $row[4],
		'md5data' => $row[5],
		'publickey' => $row[6],
		'privatekey' => $row[7],
		'openssl' => $row[8],
        	); 

        #Output the JSON data 
        echo json_encode($result_data);  
    }else{ 
        echo "Could not complete query. Missing parameter";  
    } 
?>