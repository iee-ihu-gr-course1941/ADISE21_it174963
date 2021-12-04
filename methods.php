<?php
$host='localhost';
$db = 'ADISE21_it174963';
require_once "include/db_upass.php";

$user=$DB_USER;
$pass=$DB_PASS;

$input = json_decode(file_get_contents('php://input'),true);


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
echo '<script>alert('$input['symbol']')</script>';
handle_cards($input);

function handle_cards($input){
  if(isset($input['symbol'])) {
    if(isset($input['number'])) {
      $sym = $input['symbol'] ;
      $num = $input['number'] ;

      $stmt = $con->prepare( "  UPDATE `board_1` SET `c_symbol`= ?,`c_number`= ?  WHERE `x`=? AND `y`=? ") ;

			$sql = "UPDATE board_1 SET c_symbol=$sym, c_number=$num WHERE x=1 AND y=1 ";
			if ($con->query($sql) === TRUE) {
				echo '<script>alert("Record updated successfully")</script>';
			} else {
				echo '<script>alert("Error updating record")</script>';
  			echo "Error updating record: " . $conn->error;
			}

    }else {
      header("HTTP/1.1 400 Bad Request");
      		print json_encode(['errormesg'=>"Emptyyyyy!!!"]);
      		exit;    }
  }
}
//------------------------------------------------------------------------------




 ?>
