<?php
	session_start();
	//include a db.php file to connect to database
	include ("db.php");

	//create a variable called $pagename which contains the actual name of the page
	$pagename="Ordering Basket";
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
	echo "<h2>$pagename</h2>";
	
	//checking if the user added a new item or just went to basket page
	if(isset($_POST['submit'])){
		//getting the values from the post from prodInfo.php
		$newprodid=$_POST['prodid'];
		$reququantity=$_POST['qtySelect'];
		echo 'Your basket has been updated.';
		$_SESSION['basket'][$newprodid]=$reququantity ;	
			
	}else{
		echo "Existing basket";
	}
	
	echo '<table border>';
	echo '<tr>';
	echo '<th>Product name</th>';
	echo '<th>Price</th>';
	echo '<th>Quantity</th>';
	echo '<th>Subtotal</th>';
	echo '</tr>';

	$totValue=0;
	
	if(isset($_SESSION['basket'])){
		foreach( $_SESSION['basket'] as $id=> $value) {
			$sql="select prodName,prodPrice from product where prodId='$id'";
			$exeSQL=mysqli_query($conn,$sql) or die (mysqli_error());
			$arrayprod=mysqli_fetch_array($exeSQL);
			
	    	echo "<tr>";
				
				echo "<td>".$arrayprod['prodName']."</td>";
				echo "<td>$".$arrayprod['prodPrice']."</td>";
				echo "<td>$value </td>";
				echo "<td>$".$arrayprod['prodPrice']*$value ."</td>";

				global $totValue;
				$totValue += $arrayprod['prodPrice']*$value ;
						
			echo "</tr>";
		}

	}else{

		echo "<br/><b>Your basket is empty</b>";
	}
	echo '<tr>';
	echo '<td colspan="3">Total</td>';
	echo "<td>$".$totValue."</td>";
	echo '</tr>';

	echo '</table>';

	echo "<a href='clearbasket.php' >Clear basket</a>";
	echo "<br>";
	echo "<br>";
	if(isset($_SESSION['c_userid'])){
		echo "To finalise your order <a href='checkout.php' >Check Out</a>";
	}else{
		echo "New Workedup customers <a href='register.php' >Register</a>";
		echo "<br>";
		echo "<br>";
		echo "Registered Workedup members <a href='login.php' >Login</a>";

	}

	
	
	//include head layout
	include("footfile.html");
	

?>