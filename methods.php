<?php
$host='localhost';
$db = 'ADISE21_it174963';
require_once "include/db_upass.php";

$user=$DB_USER;
$pass=$DB_PASS;



if(gethostname()=='users.iee.ihu.gr') {
	$con = new mysqli($host, $user, $pass, $db, null, '/home/student/it/2017/it174963/mysql/run/mysql.sock');
} else {
  $con = new mysqli($host, $user, $pass, $db);
}

if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" .
    $con->connect_errno . ") " . $con->connect_error;
}else{
  echo " Success AGAIN!!!! ";
}

  $sym = $_POST['c_symbol'];
  $num = $_POST['c_number'];


$sql = " UPDATE `board_1` SET `c_symbol`= 'Hearts',`c_number`= '2'  WHERE `x`=1 AND `y`=1";


$rs = mysqli_query($con, $sql);

if($rs)
{
	echo $sym;
}



 ?>
