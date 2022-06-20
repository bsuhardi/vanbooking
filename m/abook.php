<?php

//connect to db
$con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

//$q="SELECT * FROM (SELECT * FROM journey where (jdate='$mydate' and van_id=$van_id and (approval=1 or approval is null))) a right join(select * from seat) b on a.seat_id=b.id";
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