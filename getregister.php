<?php

	session_start();
	//include a db.php file to connect to database
	include ("db.php");
	
	//create a variable called $pagename which contains the actual name of the page
	$pagename="Registrations Confirmation";
	//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
	//display window title
	echo "<title>".$pagename."</title>";
	//include head layout
	include ("headfile.html");
	echo "<p></p>";
	//display name of the page and some random text
	echo "<h2>".$pagename."</h2>";
	
	//Capture the details entered in the all the fields of the form using the $_POST superglobal variable
	$fName=$_POST['fName'];
	$lName=$_POST['lName'];
	$adress=$_POST['adress'];
	$postcode=$_POST['postcode'];
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$cPassword=$_POST['cPassword'];
	
	
	//checking if all form fields are entered
	if(empty($fName) || empty($lName) || empty($adress) || empty($postcode)|| empty($tel)  || empty($email) || empty($password)|| empty($cPassword) ){
		echo "All fields are compulsory <br>";
	}else{
		
		//checking if the email entered is valid
		$reg = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ;
		//this function returns 1 if it is valid or else 0
		$isVaildEmail=preg_match($reg,$email);
		if(!($isVaildEmail)){
			//Display error for invalid email 
			echo "Email not Valid <br>";
			//Display a link back to register page 
			echo "Go back to <a href='register.php' >Register</a>";
		}else{
			//checking if the 2 entered passwords do not match
			if($password !== $cPassword ){
				//Display error passwords not matching message 
				echo "The 2 passwords do not match <br> Please enter them correctly <br>";
				//Display a link back to register page 
				echo "Go back to <a href='register.php' >Register</a>";

			} else{

				//sql query to get user given the email adress
				$sqlUser ="select * from users where userEmail='".$email."'";

				//Execute the INSERT INTO SQL query to get user
				$exeSQLUser= mysqli_query($conn ,$sqlUser);
				
				//Getting the number of rows returned
				$numberOfRows= mysqli_num_rows($exeSQLUser);

				// echo $numberOfRows;
				//checking if Email entered by user is already in database
				if($numberOfRows<1){
					//Write SQL query to insert a new user into users table and execute SQL query
					$sql="insert into users(userFName,userSName,userAddress,userPostCode,userTelNo,userEmail,userPassword) values ('".$fName."','".$lName."','".$adress."','".$postcode."','".$tel."','".$email."','".$password."')";
						
					//Execute the INSERT INTO SQL query
					$exeSQL= mysqli_query($conn ,$sql);
					echo "Success <br> You created the account successfuly <br> Now you can <a href='login.php' >Login</a> <br> ";
				}else{
					echo "SORRY <br> The email you entered already exists in the database";
				}


			}
		}
	}
	
	    //Retrieve the error number using mysql_errno. If the error detector returns the number 0, everything is fine  {   //Display registration confirmation message   //Display a link to login page  }  //if the error detector does not return the number 0, there is a problem else   {   //Display generic error message   //if the error detector returned the number 1062 i.e. unique constraint on the email is breached  //(meaning that the user entered an email which already existed)   {    //Display email already taken error message    //Display a link back to register page 
	

	//include head layout
	include("footfile.html");

?>