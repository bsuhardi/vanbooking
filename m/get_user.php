<?php

//get the parameter
$uname=$_GET['uname'];

//connect to db
$con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

$q="SELECT id,fname,level from user where uname='$uname'";
//echo $q;
$res=mysqli_query($con,$q);
$r=mysqli_fetch_assoc($res);

echo json_encode($r,JSON_UNESCAPED_UNICODE);

//clear results and close the connection
mysqli_free_result($res);
mysqli_close($con);

?>