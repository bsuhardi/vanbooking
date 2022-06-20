<?php
//connect to db
$con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

$van_id=$_GET['id'];

//construct and run query to list vans
$q="select plate from van where id=$van_id";
$res=mysqli_query($con,$q);
$r=mysqli_fetch_assoc($res);

echo json_encode($r,JSON_UNESCAPED_UNICODE);
mysqli_free_result($res);
mysqli_close($con);
?>