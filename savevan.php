<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['uid']==1){
    if(isset($_POST['submit'])){
        //get all the posted items
        $plate=$_POST['plate'];
        $make=$_POST['make'];
        $year=$_POST['year'];
    
        //connect to db
        $con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));
    
        //construct and run query to store new van
        $q="insert into van(plate,make,year) values('$plate','$make','$year')";
        $res=mysqli_query($con,$q);
        echo "<h1>New van saved.  <a href=admin.php>Dashboard</a></h1>";
    
        //clear results and close the connection
    //    mysqli_free_result($res);
        mysqli_close($con);
    }else{ header("Location: admin.php");}
}else{ header("Location: login.html");}    
?>