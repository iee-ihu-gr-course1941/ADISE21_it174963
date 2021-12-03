<?php
$host='localhost';
$db = 'ADISE21_it174963';
require_once "db_upass.php";

$user=$DB_USER;
$pass=$DB_PASS;

$con = mysqli_connect($host, $user,$pass,$db);

$symbol=$_POST['symbol'];
$number=$_POST['number'];


$sql = " INSERT INTO `board_1` (`x`, `y`, `c_symbol`, `c_number`) VALUES ('1', '1', $symbol , $number) ";


$rs = mysqli_query($con, $sql);

if($rs)
{
	echo " Records Inserted";
}



 ?>
