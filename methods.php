<?php
//-------------CONNECTION-------------------------------------------------------
require_once "include/db_connect.php";


//------------------------------------------------------------------------------
// $method = $_SERVER['REQUEST_METHOD'];
// $request = 'cards';
$json = file_get_contents('php://input');
$data = json_decode($json);
echo $data->symbol;

// switch ($request) {
//   case 'cards': handle_cards($method, $request,$input);
//             		break;
//   default:  header("HTTP/1.1 404 Not Found");
//             exit;
// }

// function handle_cards($method, $request,$input){
	// $sym=$input['symbol'];
	// $num=$input['number'];
	//
	// if(!isset($sym)) {
	// 	if(!isset($num)) {
	// 		header("HTTP/1.1 400 Bad Request");
	// 		print json_encode(["No data given."]);
	// 		exit;
	// 	}
	// }
	//
	// $sql = 'INSERT INTO board_1(x, y, c_symbol, c_number) VALUES (1,1,?,?) ';
	// $st = $mysqli->prepare($sql);
	// $st->bind_param('ss',$sym,$num);
	// $st->execute();

// }





//------------------------------------------------------------------------------
// $sql = "INSERT INTO board_1(x, y, c_symbol, c_number) VALUES (1,1,'Hearts','2') ";
// if($con->query($sql) === true){
// 		echo "Records inserted successfully.";
// } else{
// 		echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
// }



 ?>
