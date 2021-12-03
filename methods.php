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
 handle_cards($input);


function handle_cards($input){
  if(isset($input['symbol'])) {
    if(isset($input['number'])) {
      $sym = $input['symbol'] ;
      $num = $input['number'] ;

      $stmt = $con->prepare( "  UPDATE `board_1` SET `c_symbol`= ?,`c_number`= ?  WHERE `x`=? AND `y`=? ") ;
      $stmt->bind_param("ssss", $sym, $num, 1, 1);
      $stmt->execute();
    }else {
      header("HTTP/1.1 400 Bad Request");
      		print json_encode(['errormesg'=>"Emptyyyyy!!!"]);
      		exit;    }
  }
}
//------------------------------------------------------------------------------




 ?>
