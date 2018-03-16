<?php
	session_start();
	//include a db.php file to connect to database
	include ("db.php");
	
	//create a variable called $pagename which contains the actual name of the page
	$pagename="Log Out";
	//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
	//display window title
	echo "<title>".$pagename."</title>";
	//include head layout
	include ("headfile.html");
    echo "<p></p>";

    //unset basket session 
    unset($_SESSION['basket']);
    //unset user id session 
    unset($_SESSION['c_userid']);
    //unset first name session 
    unset($_SESSION['c_fname']);
    //unset surname session 
    unset($_SESSION['c_lname']);
    //unset all sessions
    //destroy session 
    session_destroy();

    //Display a log out confirmation message 
    echo "<h4>You have succesfully loged out!</h4>";
    
	//include head layout
	include("footfile.html");

?>