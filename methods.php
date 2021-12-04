<?php
$host='localhost';
$db = 'ADISE21_it174963';
require_once "include/db_upass.php";

$user=$DB_USER;
$pass=$DB_PASS;

// $input = json_decode(file_get_contents('php://input'),true);


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

//------------------------------------------------------------------------------
// handle_cards($input);

function handle_cards(){
  // if(isset($input['symbol'])) {
  //   if(isset($input['number'])) {
  //     $sym = $input['symbol'] ;
  //     $num = $input['number'] ;


			$sql = "UPDATE 'board_1' SET 'c_symbol'='Hearts', 'c_number'='2' WHERE x=1 AND y=1 ";
			if (mysqli_query($con, $sql)) {
  			echo "Record updated successfully";
			} else {
  			echo "Error updating record: " . mysqli_error($conn);
			}

  //   }else {
  //     header("HTTP/1.1 400 Bad Request");
  //     		print json_encode(['errormesg'=>"Emptyyyyy!!!"]);
  //     		exit;    }
  // }
}
//------------------------------------------------------------------------------




 ?>
