<?php
	session_start();
	//include a db.php file to connect to database
	include ("db.php");
	
	//create a variable called $pagename which contains the actual name of the page
	$pagename="Product Information";
	//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
	//display window title
	echo "<title>".$pagename."</title>";
	
	//retrieve the product id passed from the previous page using the $_GET superglobal variable
	//store the value in a variable called $prodid
	$prodid=$_GET['u_prodid'];
	
	//echo "<p>Selected product Id: ".$prodid;
	//query the product table to retrieve the record for which the value of the product id
	//matches the product id of the product that was selected by the user
	$prodSQL="select prodId, prodName, prodPicName,
	prodDescrip , prodPrice, prodQuantity from product
	where prodId=".$prodid;
	//execute SQL query
	$exeprodSQL=mysqli_query($conn,$prodSQL) or die(mysqli_error());
	//create array of records & populate it with result of the execution of the SQL query
	$thearrayprod=mysqli_fetch_array($exeprodSQL);
	//display product name in capital letters
	echo "<p><center><b>".strtoupper($thearrayprod['prodName'])."</b></center>";
			

	//include head layout
	include ("headfile.html");
	//including the get login part
	include ("detectlogin.php"); 
	echo "<p></p>";
	//display name of the page and some random text
	echo "<h2>".$pagename."</h2>";

	//Create a new variable containing the execution of the SQL query i.e. select the records or get out
	$exeSQL=mysqli_query($conn,$prodSQL) or die (mysqli_error());
	//create an array of records (2 dimensional variable) called $prodArray.
	//populate it with the records retrieved by the SQL query previously executed.
	//loop through the array i.e while the end of the array has not been reached go through it
	$arrayprod=mysqli_fetch_array($exeSQL);
	
	echo "<img src=images/".$arrayprod['prodPicName'].">";
	echo "<br>";
	//make each product a link to the next page and pass the product id to the next page by URL
	//concatenate a string of characters u_prodid which carries the value of the actual id
	echo "<p><a href=prodinfo.php?u_prodid=".$arrayprod['prodId'].">";
	echo $arrayprod['prodName'];
	echo "</a>";
	echo "<br><br>";
	echo $arrayprod['prodDescrip'];
	echo "<br><br>";
	echo "Price: $".$arrayprod['prodPrice'];
	echo "<br><br>";
	echo "In Stock:".$arrayprod['prodQuantity'];
	echo "<br><br>";
	
	//display form made of one text box and one button for user to enter quantity
	//pass the product id to the next page basket.php as a hidden value
	echo "<form action=basket.php method='POST'>";
	echo "<p>Enter Required Quantity: ";
	echo "<select name='qtySelect'>";
	
	for ($i = 1 ;  $i <= $arrayprod['prodQuantity'] ; $i++) {
		
		echo "<option value='$i'>";
		echo "$i";
		echo "</option>";
	}
		
	echo"</select>";
	echo"<input type='text' value='$prodid' name='prodid' hidden>"; //this is used to pass the product id in the POST
		
	echo "<input type='submit' name='submit' value='Add to Basket'>";
	echo "</form>";
	echo "<hr>";	
	echo "<br>";
	
	
	
	
	//include head layout
	include("footfile.html");

?>