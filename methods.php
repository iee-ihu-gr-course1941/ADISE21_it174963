<?php
//-------------CONNECTION-------------------------------------------------------
require_once "include/db_connect.php";


//------------------------------------------------------------------------------

$method = $_SERVER['REQUEST_METHOD'];
$request = explode ('/',trim($_SERVER['PATH_INFO'],'/'));
$json = file_get_contents('php://input');
$data = json_decode($json);


switch ($request) {
  case 'cards': handle_cards($method, $request, $data, $conn);
            		break;
  default:  header("HTTP/1.1 404 Not Found");
            exit;
}


function handle_cards($method, $request, $data, $conn){
	$sym=$data->symbol;
	$num=$data->number;

	if(!isset($sym)) {
		if(!isset($num)) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(["No data given."]);
			exit;
		}
	}


	$sql = "UPDATE `board_1` SET `c_symbol`='$sym',`c_number`='$num' WHERE `x`=1 AND `y`=1 ;" ;
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}


}

//------------------------------------------------------------------------------
 ?>
