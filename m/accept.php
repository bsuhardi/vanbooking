<?php

//get the parameters
$jid=$_GET['jid'];
$user_id=$_GET['uid'];

//connect to db
$con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

//construct and run query to list vans
$q="update journey set approval=1, admin_id=$user_id where id=$jid";
//echo $q;
$res=mysqli_query($con,$q);
$q="select a.id, a.jdate, a.bookdate, b.plate, c.seat, d.fname from journey a, van b, seat c, user d where a.approval is null and b.id=a.van_id and c.id=a.seat_id and d.id=a.user_id order by jdate, bookdate asc";
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