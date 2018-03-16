<?php
	session_start();
	//include a db.php file to connect to database
	include ("db.php");
	
	//create a variable called $pagename which contains the actual name of the page
	$pagename="Login Confirmation";
	//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
	//display window title
	echo "<title>".$pagename."</title>";
	//include head layout
	include ("headfile.html");
	echo "<p></p>";
	//display name of the page and some random text
	echo "<h2>".$pagename."</h2>";
	
	//Capture the details entered in the form using the $_POST superglobal variable
	//Store these details into a set of new variables, one for email and one for password
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	//if any of the variables is empty
	if(empty($email)|| empty($password)){
		//Display an error message
		echo "Your form is incomplete <br> Please fill all the required details<br>";
		//Display a link back to the login page
		echo "Go back to <a href='login.php' >login</a>";	
	}
	else{
		//SQL query to retrieve the record from the users table for which the email stored in database table matches the email entered in the form (if there is one).
		//$sql="select * from users where userEmail='".$email."' and userPassword='".$password."'";	
		$sql="select * from users where userEmail='".$email."'";	
		//Execute query and store result in array.
		$exeSql=mysqli_query($conn ,$sql) or die (mysqli_error($conn));

		if (mysqli_num_rows($exeSql) < 1){
			echo "Sorry the email you entered was not recognized <br>";
			//Display a link back to the login page
			echo "Go back to <a href='login.php'> login</a>";
		}else{
			$result= mysqli_fetch_array($exeSql);
			//if password from array i.e. retrieved from DB doesn't match password entered in form 
			if($password != $result['userPassword']){
				echo "Sorry the password entered is wrong <br>";
				echo "Go back to <a href='login.php' >login</a>";	
			}else{
				//create a session variable for this customer who has just logged in 
				//store his/her id, first name and surname in this session variable.
				//For the user id create $_SESSION['c_userid'] and inside allocate the user id from the array of records.
				$_SESSION['c_userid']=$result['userId']; 
				//Do the same for the first name and the surname. 
				$_SESSION['c_fname']=$result['userFName'];  
				$_SESSION['c_lname']=$result['userSName'];  

				//Display a greeting using the full name i.e. first name and surname stored in the session variable 

				echo "<h3>Hello ".$_SESSION['c_fname'] ." ".$_SESSION['c_lname'] ." </h3>";

				echo "You have succesfully Loged in :) <br>";
				echo "Email: ".$result['userEmail']." <br>";
				echo "Password: Secret <br><br>";
				echo "To continue shopping - <a href='index.php'> Index</a><br>";
				echo "To view your basket- <a href='basket.php'> Basket</a><br>";

			}
	
		}

	}
		
	
	//include head layout
	include("footfile.html");

?>