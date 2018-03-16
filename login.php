<?php
	session_start();
	//include a db.php file to connect to database
	include ("db.php");
	
	//create a variable called $pagename which contains the actual name of the page
	$pagename="Login";
	//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
	//display window title
	echo "<title>".$pagename."</title>";
	//include head layout
	include ("headfile.html");
	echo "<p></p>";
	//display name of the page and some random text
	echo "<h2>".$pagename."</h2>";
	
	echo "<form action=getlogin.php method='POST'>";
	echo '<table border>';
	
	echo '<tr>';
	echo '<td>Email</td>';
	echo '<td><input type=text name=email id=email ></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>Password</td>';
	echo '<td><input type=password name=password id=password></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td><input type=reset value=Clear></td>';
	echo '<td><input type=submit value=Login></td>';
	echo '</tr>';
	
	echo '</table>';
	echo '</form>';
	
	//include head layout
	include("footfile.html");

?>