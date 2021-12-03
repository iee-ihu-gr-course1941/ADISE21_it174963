<?php
$host='localhost';
$db = 'ADISE21_it174963';
require_once "db_upass.php";

$user=$DB_USER;
$pass=$DB_PASS;

if(gethostname()=='users.iee.ihu.gr') {
	$con = new mysqli($host, $user, $pass, $db, null, '/home/student/it/2017/it174963/mysql/run/mysql.sock');
} else {
  $con = new mysqli($host, $user, $pass, $db);
}


$sym=$_POST['symbol'];
$num=$_POST['number'];


$sql = " INSERT INTO `board_1`(`x`, `y`, `c_symbol`, `c_number`) VALUES (1,1,'Hearts','2'); ";


$rs = mysqli_query($con, $sql);

if($rs)
{
	echo " Records Inserted";
}



 ?>
