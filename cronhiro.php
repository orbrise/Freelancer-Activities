<?php
$servername = "localhost";
$username = "monemedi_mainadmin";
$password = "Kingumer@1231";
$db = "monemedi_hiro";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

$cdate = date('Y-m-d');
$sql = "SELECT * FROM users where end_date<'$cdate'";
$result = mysqli_query($conn, $sql);
while($r = mysqli_fetch_array($result))
{
    $id = $r['id'];
     mysqli_query($conn, "update users set status= 0, is_featured = 0 where id = $id ");
}
?>