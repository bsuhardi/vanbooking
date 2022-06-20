<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulevel']==2){

    //get the parameter
    $van_id=$_GET['id'];
    $mydate=$_GET['mydate'];

    //connect to db
    $con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

    //construct and run query to list vans
    $q="select * from van where id=$van_id";
    $res=mysqli_query($con,$q);
    $r=mysqli_fetch_assoc($res);
    echo "<h2>Van ".$r['plate']."</h2>\n";
    echo "<p>".$r['make']."\n".$r['year']."\n".$mydate."</p>\n";
    echo "<form method=get action=book.php><input type=hidden name=id value=$van_id>";
    echo "<input type=date name=mydate><input type=submit></form>";

    $q="SELECT * FROM (SELECT * FROM journey where (jdate='$mydate' and van_id=$van_id and (approval=1 or approval is null))) a right join(select * from seat) b on a.seat_id=b.id";
    //echo $q;
    $res=mysqli_query($con,$q);
    echo "<table border=1>\n";
    echo "<tr><th>Seat</th><th>Status</th></tr>\n";
    while($r=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$r['seat']."</td><td>";
        if(($r['bookdate']!=null)&&($r['approval']==1)) echo 'X'; 
        elseif($r['bookdate']!=null&&($r['approval']==0 or $r['approval']==NULL)) echo 'A/B <a href=bconfirm.php?van_id='.$van_id.'&seat_id='.$r['id'].'&date='.$mydate.'><button>Book</button></a>'; 
        else echo 'A <a href=bconfirm.php?van_id='.$van_id.'&seat_id='.$r['id'].'&date='.$mydate.'><button>Book</button></a>';
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