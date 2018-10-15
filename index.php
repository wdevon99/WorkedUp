<?php
	session_start();
	//add db
	include ("db.php");
	
	//create a variable called $pagename which contains the actual name of the page
	$pagename="Index";
	//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
	//display window title
	echo "<title>".$pagename."</title>";
	//include head layout
	include ("headfile.html");

	//including the get login part
	include ("detectlogin.php"); 

	echo "<p></p>";
	//display name of the page and some random text
	echo "<h2>".$pagename."</h2>";
	
	//create a new variable containing a SQL statement retrieving names of products from the product table
	$SQL="select prodId, prodName, prodPicName,prodPrice from product";
	//Create a new variable containing the execution of the SQL query i.e. select the records or get out
	$exeSQL=mysqli_query($conn,$SQL) or die (mysqli_error());
	//create an array of records (2 dimensional variable) called $prodArray.
	//populate it with the records retrieved by the SQL query previously executed.
	//loop through the array i.e while the end of the array has not been reached go through it
	while ($arrayprod=mysqli_fetch_array($exeSQL))
	{
		echo "<img src=images/".$arrayprod['prodPicName'].">";
		echo "<br>";
		//make each product a link to the next page and pass the product id to the next page by URL
		//concatenate a string of characters u_prodid which carries the value of the actual id
		echo "<p><a href=prodinfo.php?u_prodid=".$arrayprod['prodId'].">";
		echo $arrayprod['prodName'];
		echo "</a>";
		echo "<br><br>";
		echo "Price : $".$arrayprod['prodPrice'];
		echo "<hr>";	
		echo "<br>";
		
		
	}
	//include head layout
	include("footfile.html");

?>
