<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulevel']==2){

    //get the parameters
    $van_id=$_GET['van_id'];
    $seat_id=$_GET['seat_id'];
    $mydate=$_GET['date'];
    $user_id=$_SESSION['uid'];

    //connect to db
    $con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

    //construct and run query to list vans
    $q="insert into journey(van_id, seat_id, user_id,jdate) values($van_id,$seat_id,$user_id,'$mydate')";
    //echo $q;
    $res=mysqli_query($con,$q);
    echo "<h1>New booking saved. <a href=user.php>Dashboard</a></h1>";

    //clear results and close the connection
    //mysqli_free_result($res);
    mysqli_close($con);
}else{ header("Location: login.html");}
?>