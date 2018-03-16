<?php
	session_start();
	//include a db.php file to connect to database
	include ("db.php");
	
	//create a variable called $pagename which contains the actual name of the page
	$pagename="Check Out Confirmation";
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
    
    //initialise total and subtotal to 0.
    $totValue=0;
    $subTotal=0;
    //store the current date and time in format that is compatible with MySQL. 
    //use the date PHP function with the 'Y-m-d H:i:s' parameters.  
    //write a SQL query to insert a new record in the order table to generate a new order number. 
    //store the id of the user who is placing the order as well as the current date and time 
    $currentDateTime=Date('Y-m-d H:i:s');
    $userId=$_SESSION['c_userid'];

    $insertSQL="insert into orders (userId, orderDateTime, orderTotal) values ( '".$userId ."', '". $currentDateTime."', '".$totValue."');";
    //Run the SQL query. 
    $exeSQL=mysqli_query($conn,$insertSQL) or die (mysqli_error());
   
    //if no database error is returned i.e. if the new order was inserted correctly { 
    if($exeSQL){
        //SQL query to retrieve max order number for current user (for which id matches the id in session) 
        //i.e retrieve the order number of most recent order placed by current user
        $maxOrderSQL="select max(orderNo) from orders where userId=".$userId;
        //execute SQL query  
        $exemaxOrderSQL =mysqli_query($conn,$maxOrderSQL) or die (mysqli_error());
        //fetch the result of the execution of the SQL statement and store it in an array 
        $result=mysqli_fetch_array($exemaxOrderSQL ); 
        //store the value of this order number in a variable  
        $maxOrderNo=$result['max(orderNo)'];
        //display message to confirm that order has been placed successfully and display the order number. 
        echo "<h3>Your order has been Successfully places</h3>";
        echo "<h3>Order number :".$maxOrderNo."</h3>";
        //as for basket.php, display a table header for product name, price, quantity and subtotal
        echo '<table border>';
        echo '<tr>';
        echo '<th>Product name</th>';
        echo '<th>Price</th>';
        echo '<th>Quantity</th>';
        echo '<th>Subtotal</th>';
        echo '</tr>';

        
        if(isset($_SESSION['basket'])){
            foreach( $_SESSION['basket'] as $id=> $value) {
                $sql="select prodId,prodName,prodPrice from product where prodId='$id'";
                $exeSQL=mysqli_query($conn,$sql) or die (mysqli_error());
                $arrayprod=mysqli_fetch_array($exeSQL);
                
                echo "<tr>";
                    
                    echo "<td>".$arrayprod['prodName']."</td>";
                    echo "<td>$".$arrayprod['prodPrice']."</td>";
                    //ordered Quantity
                    echo "<td>$value </td>";
                    //subtotal
                    $subTotal=$arrayprod['prodPrice']*$value;
                    echo "<td>$".$subTotal ."</td>";
                    //SQL query to store details of ordered items in order_line table i.e. order number,
                    //product id (index), ordered quantity (content of the session array) and subtotal 
                    $orderLineSQL="insert into order_line ( orderNo, prodId, quantityOrdered, subTotal) VALUES ( '". $maxOrderNo ."', '" .$arrayprod['prodId'] . "', '".$value ."', '".$subTotal."');"; 
                    $exeorderLineSQL=mysqli_query($conn,$orderLineSQL) or die (mysqli_error());

                    $totValue;
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
                

        //SQL update query to update the total value in the order table for this specific order
        $updateSQL="update orders set orderTotal = ".$totValue." where orderNo=".$maxOrderNo ."";
        //execute SQL query and display logout link.
        $exeorderLineSQL=mysqli_query( $conn , $updateSQL ) or die (mysqli_error());
    }    
       
    else{ 
       echo "ERROR WHILE PLACING ORDER :(";
    } 
    //Unset the basket session array
    unset($_SESSION['basket']);
 



	//include head layout
	include("footfile.html");

?>