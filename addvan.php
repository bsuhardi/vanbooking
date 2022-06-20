<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['uid']==1){
?>
<form method="post" action="savevan.php">
    <input type="text" name="plate" placeholder="Plate"><br>
    <input type="text" name="make" placeholder="Make"><br>
    <input type="text" name="year" placeholder="Year"><br>
    <input type="reset"><input type="submit" name="submit" value="Submit">
</form>    
<?php    
}else{ header("Location: login.html");}    
?>