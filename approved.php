<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulevel']==1){

    //get the parameters
    $id=$_GET['id'];
    $code=$_GET['code'];
    $user_id=$_SESSION['uid'];

    //connect to db
    $con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

    //construct and run query to list vans
    $q="update journey set approval=$code, admin_id=$user_id where id=$id";
    echo $q;
    $res=mysqli_query($con,$q);
    echo "<h1>Data saved. <a href=approve.php>Back</a></h1>";

    //clear results and close the connection
    //mysqli_free_result($res);
    mysqli_close($con);
}else{ header("Location: login.html");}
?>