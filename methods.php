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

//------------------------------------------------------------------------------
switch ($r=array_shift($request)) {
	case 'cards': handle_cards($method, $request,$input);
                break;
  default:  header("HTTP/1.1 404 Not Found");
            exit;
}

function handle_cards($method, $request,$input){
  if(isset($input['symbol'])) {
    if(isset($input['number'])) {
      $sym = $input['symbol'] ;
      $num = $input['number'] ;

      $stmt = $conn->prepare( "  UPDATE `board_1` SET `c_symbol`= ?,`c_number`= ?  WHERE `x`=? AND `y`=? ") ;
      $stmt->bind_param("ssss", $sym, $num, 1, 1);
      $stmt->execute();
    }else {
      header("HTTP/1.1 400 Bad Request");
      		print json_encode(['errormesg'=>"Emptyyyyy!!!"]);
      		exit;    }
  }
}
//------------------------------------------------------------------------------


// $sql = " UPDATE `board_1` SET `c_symbol`= 'Hearts',`c_number`= '2'  WHERE `x`=1 AND `y`=1";
//
//
// $rs = mysqli_query($con, $sql);

if($rs){	echo $sym; }



 ?>
