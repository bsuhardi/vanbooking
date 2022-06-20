<?php
$uid=$_GET['uid'];
//connect to db
$con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

//construct and run query to list bookings
$q="select a.jdate, a.approval, b.plate, c.seat from journey a, van b, seat c where a.user_id=$uid and b.id=a.van_id and c.id=a.seat_id order by jdate, bookdate asc";
//$q="select jdate, approval, plate, seat from journey, van where user_id=$uid and van_id=van.id order by jdate, bookdate asc";
$res=mysqli_query($con,$q);
while($r=mysqli_fetch_assoc($res)){
    $json[]=$r;
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);

//clear results and close the connection
mysqli_free_result($res);
mysqli_close($con);
?>