<?php
//-------------CONNECTION-------------------------------------------------------
$host='localhost';
$db = 'ADISE21_it174963';
$user=$DB_USER;
$pass=$DB_PASS;
require_once "include/db_upass.php";

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
$method = $_SERVER['REQUEST_METHOD'];
$request = 'cards';
$input = json_decode(file_get_contents('php://input'),true);

switch ($request) {
  case 'cards': handle_cards($method, $request,$input);
            		break;
  default:  header("HTTP/1.1 404 Not Found");
            exit;
}

function handle_cards($method, $request,$input){
	$sym=$input[0]->symbol;
	$num=$input[1]->number;

	if(!isset($sym)) {
		if(!isset($num)) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"No data given."]);
			exit;
		}
	}



	$sql = 'INSERT INTO board_1(x, y, c_symbol, c_number) VALUES (1,1,?,?) ';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ss',$sym,$num);
	$st->execute();

}





//------------------------------------------------------------------------------
// $sql = "INSERT INTO board_1(x, y, c_symbol, c_number) VALUES (1,1,'Hearts','2') ";
// if($con->query($sql) === true){
// 		echo "Records inserted successfully.";
// } else{
// 		echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
// }



 ?>
