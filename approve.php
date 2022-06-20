<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulevel']==1){

    //get the parameters
    if(isset($_POST['mydate'])) $mydate=$_POST['mydate'];
    else $mydate=date("Y-m-d");
    if(isset($_POST['van_id'])) $van_id=$_POST['van_id'];
    else $van_id=1;

    //connect to db
    $con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

    $q="SELECT * FROM (SELECT * FROM journey where (jdate='$mydate' and van_id=$van_id and (approval=1 or approval is null))) a right join(select * from seat) b on a.seat_id=b.id";
    echo $q;
    $res=mysqli_query($con,$q);
    echo "<table border=1>\n";
    echo "<tr><th>Seat</th><th>Status</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['seat']."</td><td>";
        if(($r['bookdate']!=null)&&($r['approval']==1)) echo 'X'; 
        //elseif($r['bookdate']!=null&&($r['approval']==0 or $r['approval']==NULL)) echo 'A/B'; 
        elseif($r['bookdate']!=null && $r['approval']==null) echo 'B'; 
        else echo 'A';
        echo "</td></tr>\n";
    }
    echo "</table>";

    //construct and run query to list vans
    $q="select id,plate from van";
    $res=mysqli_query($con,$q);
    echo "<form method=post action=approve.php><select name=van_id>";
    while($r=mysqli_fetch_assoc($res)) echo "<option value=".$r['id'].">".$r['plate']."</option>\n";
    echo "</select>\n";
    echo "<input type=date name=mydate><input type=submit></form>";

    //construct and run query to list new bookings
    $q="select a.id, a.jdate, a.bookdate, b.plate, c.seat, d.fname from journey a, van b, seat c, user d where a.jdate='$mydate' and a.approval is null and b.id=a.van_id and c.id=a.seat_id and d.id=a.user_id order by jdate, bookdate asc";
    $res=mysqli_query($con,$q);
    echo "<h2>Booking List</h2>\n";
    echo "<table border=1>\n";
    echo "<tr><th>Journey Date</th><th>Booking Date</th><th>Van</th><th>Seat</th><th>User</th><th>Action</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['jdate']."</td><td>".$r['bookdate']."</td><td>".$r['plate']."</td><td>".$r['seat']."</td><td>".$r['fname']. "</td><td><a href=approved.php?id=".$r['id']."&code=0><button>Reject</button></a><a href=approved.php?id=".$r['id']."&code=1><button>Approve</button></a></tr>\n";
    }
    echo "</table>";

    //clear results and close the connection
    mysqli_free_result($res);
    mysqli_close($con);
}else{ header("Location: login.html");}    