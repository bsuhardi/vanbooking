<?php
//connect to db
$con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

//construct and run query to list vans
$q="select * from van";
$res=mysqli_query($con,$q);
while($r=mysqli_fetch_assoc($res)){
    $json[]=$r;
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
mysqli_free_result($res);
mysqli_close($con);
?>