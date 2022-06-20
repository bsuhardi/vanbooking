<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulevel']==2){

    //connect to db
    $con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

    //construct and run query to list user details
    $q="select fname from user where id=".$_SESSION['uid'];
    $res=mysqli_query($con,$q);
    $r=mysqli_fetch_assoc($res);
    echo "<br><h2>Welcome ".$r['fname']."</h2><a href=logout.php>Logout</a>\n";
    
    //construct and run query to list vans
    $q="select * from van";
    $res=mysqli_query($con,$q);
    echo "<h2>Van List</h2>\n";
    echo "<table border=1>\n";
    echo "<tr><th>Plate</th><th>Make</th><th>Year</th><th>Book</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['plate']."</td><td>".$r['make']."</td><td>".$r['year']."</td><td><a href=book.php?id=".$r['id']."&mydate=".date("Y-m-d").">Book</a></td></tr>\n";
    }
    echo "</table>";

    //construct and run query to list bookings
    $q="select a.jdate, a.bookdate, b.plate, c.seat, a.approval from journey a, van b, seat c where a.user_id=".$_SESSION['uid']." and b.id=a.van_id and c.id=a.seat_id order by jdate, bookdate asc";
    $res=mysqli_query($con,$q);
    echo "<br><h2>Booking List</h2>\n";
    echo "<table border=1>\n";
    echo "<tr><th>Journey Date</th><th>Booking Date</th><th>Van</th><th>Seat</th><th>Confirmation</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['jdate']."</td><td>".$r['bookdate']."</td><td>".$r['plate']."</td><td>".$r['seat']."</td><td>";
        if($r['approval']==1) echo "Confirmed";
        elseif($r['approval']==NULL) echo "Booked";
        else echo "Rejected";
        echo "</td></tr>\n";
    }
    echo "</table>";

    //clear results and close the connection
    mysqli_free_result($res);
    mysqli_close($con);
}else{ header("Location: login.html");}
?>