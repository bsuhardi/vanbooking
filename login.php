<?php
session_start();
if(isset($_POST['submit'])){
    //get all the posted items
    $uname=$_POST['uname'];
    $pword=$_POST['pword'];

    //connect to db
    $con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

    //construct and run query to check for correct credentials
    $q="select * from user where uname='$uname' and pword='$pword'";
    $res=mysqli_query($con,$q);
    $num=mysqli_num_rows($res);
    if($num!=1){
        mysqli_close($con);
        header("Location: login.html");
    }

    //user is admin - send to admin page
    $r=mysqli_fetch_assoc($res);
    $_SESSION['uid']=$r['id'];
    $_SESSION['ulevel']=$r['level'];
    if($r['level']==1){
        
        //clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
        header("Location: admin.php");
    } 

    //user has successfully signed in
    if($r['level']==2){
        //clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
        header("Location: user.php");
    } 
}else{ header("Location: login.html");}
?>