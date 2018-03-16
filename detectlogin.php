<?php
	
    //if the session variable user id is set i.e. if the user has gone successfully through getlogin.php 
    if(isset($_SESSION['c_userid'])){
        $uId=$_SESSION['c_userid'];
        $fName=$_SESSION['c_fname'];
        $lName=$_SESSION['c_lname'];

        $sql="select * from users where userId='".$uId."'";	
        $exeSql=mysqli_query($conn ,$sql) or die (mysqli_error($conn));
        $result= mysqli_fetch_array($exeSql);

        //display full name i.e first name and surname and id number aligned on the right 
        echo "<p style='text-align:right;'> Name : $fName $lName / Customer number : $uId </p>";
    }
    else{
        echo "<p style='text-align:right;'> Not logged in </p>";
    }
    echo "<hr>";


?>