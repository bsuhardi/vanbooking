<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulevel']==1){

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
    echo "<h2>Van List</h2> (<a href = addvan.php>Add Van</a>)\n";
    echo "<table border=1>\n";
    echo "<tr><th>Plate</th><th>Make</th><th>Year</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['plate']."</td><td>".$r['make']."</td><td>".$r['year']."</td></tr>\n";
    }
    echo "</table>";

    //construct and run query to list new bookings
    $q="select a.id, a.jdate, a.bookdate, b.plate, c.seat, d.fname from journey a, van b, seat c, user d where a.approval is null and b.id=a.van_id and c.id=a.seat_id and d.id=a.user_id order by jdate, bookdate asc";
    $res=mysqli_query($con,$q);
    echo "<h2>Booking List</h2> (<a href = approve.php>Approve booking</a>)\n";
    echo "<table border=1>\n";
    echo "<tr><th>Journey Date</th><th>Booking Date</th><th>Van</th><th>Seat</th><th>User</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['jdate']."</td><td>".$r['bookdate']."</td><td>".$r['plate']."</td><td>".$r['seat']."</td><td>".$r['fname']. "</td></tr>\n";
    }
    echo "</table>";

    //construct and run query to list old bookings
    $q="select a.id, a.jdate, a.bookdate, a.approval, b.plate, c.seat, d.fname from journey a, van b, seat c, user d where a.approval is not null and b.id=a.van_id and c.id=a.seat_id and d.id=a.user_id order by jdate, bookdate asc";
    $res=mysqli_query($con,$q);
    echo "<h2>Old Booking List</h2>\n";
    echo "<table border=1>\n";
    echo "<tr><th>Journey Date</th><th>Booking Date</th><th>Van</th><th>Seat</th><th>User</th><th>Action</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['jdate']."</td><td>".$r['bookdate']."</td><td>".$r['plate']."</td><td>".$r['seat']."</td><td>".$r['fname']. "</td><td>";
        if($r['approval']==1) echo "Accepted";
        else echo "Rejected";
        echo "</td></tr>\n";
    }
    echo "</table>";

    //construct and run query to list users
    $q="select * from user";
    $res=mysqli_query($con,$q);
    echo "<br><h2>User List</h2>\n";
    echo "<table border=1>\n";
    echo "<tr><th>id</th><th>Name</th><th>Username</th><th>password</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['id']."</td><td>".$r['fname']."</td><td>".$r['uname']."</td><td>".$r['pword']."</td></tr>\n";
    }
    echo "</table>";

    //clear results and close the connection
    mysqli_free_result($res);
    mysqli_close($con);
}else{ header("Location: login.html");}
?>