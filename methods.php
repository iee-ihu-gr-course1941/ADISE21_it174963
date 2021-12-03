<?php
$host='localhost';
$db = 'ADISE21_it174963';
require_once "db_upass.php";

$user=$DB_USER;
$pass=$DB_PASS;

$con = mysqli_connect($host, $user,$pass,$db);

$sym=$_POST['symbol'];
$num=$_POST['number'];


$sql = " UPDATE `board_1`
         SET `c_symbol`='Diamonds',`c_number`='A' 
         WHERE `x`=1 AND `y`=1 ";


$rs = mysqli_query($con, $sql);

if($rs)
{
	echo " Records Inserted";
}



 ?>
