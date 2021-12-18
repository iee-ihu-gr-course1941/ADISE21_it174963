<?php
//-------------CONNECTION-------------------------------------------------------
require_once "include/db_connect.php";


//------------------------------------------------------------------------------

$method = $_SERVER['REQUEST_METHOD'];
$request = 'cards';
$json = file_get_contents('php://input');
$data = json_decode($json);
// echo $data->symbol;



switch ($request) {
  case 'cards': handle_cards($method, $request, $data, $conn);
            		break;
  default:  header("HTTP/1.1 404 Not Found");
            exit;
}

function handle_cards($method, $request, $data, $conn){
	$sym=$data->symbol;
	$num=$data->number;
	echo $sym;
	echo $num;


	if(!isset($sym)) {
		if(!isset($num)) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(["No data given."]);
			exit;
		}
	}

//-----------ΦΘΑΝΟΥΝ ΜΕΧΡΙ ΕΔΩ ΟΙ ΤΙΜΕΣ ΠΟΥ ΘΕΛΩ--------------------------------

	$sql = "INSERT INTO `board_1`(`x`, `y`, `c_symbol`, `c_number`) VALUES (1,1,'$sym','$num') ;" ;
	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}


	}

//------------------------------------------------------------------------------
 ?>
