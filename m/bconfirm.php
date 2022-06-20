<?php

//get the parameters
$van_id=$_GET['van_id'];
$seat_id=$_GET['seat_id'];
$mydate=$_GET['mydate'];
$user_id=$_GET['uid'];

//connect to db
$con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

//construct and run query to list vans
$q="insert into journey(van_id, seat_id, user_id,jdate) values($van_id,$seat_id,$user_id,'$mydate')";
//echo $q;
$res=mysqli_query($con,$q);
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