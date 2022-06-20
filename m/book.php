<?php

//get the parameter
$van_id=$_GET['van_id'];
$mydate=$_GET['mydate'];
//$van_id=2;
//$mydate='2022-06-14';

//connect to db
$con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

$q="SELECT b.id, bookdate, seat, approval FROM (SELECT * FROM journey where (jdate='$mydate' and van_id=$van_id and (approval=1 or approval is null))) a right join(select * from seat) b on a.seat_id=b.id";
//echo $q;
$res=mysqli_query($con,$q);
while($r=mysqli_fetch_assoc($res)){
    $json[]=$r;
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);

//clear results and close the connection
mysqli_free_result($res);
mysqli_close($con);

?>