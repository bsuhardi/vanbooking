<?php
if(isset($_POST['submit'])){
    //get all the posted items
    $uname=$_POST['uname'];
    $pword=$_POST['pword'];
    $fname=$_POST['fname'];

    //connect to db
    $con=mysqli_connect('localhost','root','','vanbooking') or die(mysqli_error($con));

    //construct and run query to check if username is taken
    $q="select * from user where uname='$uname'";
    $res=mysqli_query($con,$q);
    $num=mysqli_num_rows($res);
    if($num!=0) header("Location: register.html");

    //construct and run query to store new user
    $q="insert into user(uname,pword,fname) values('$uname','$pword','$fname')";
    $res=mysqli_query($con,$q);
    echo "<h1>New user created. Please <a href=login.html>Login</a></h1>";

    //clear results and close the connection
//    mysqli_free_result($res);
    mysqli_close($con);
}else{ header("Location: register.html");}
?>