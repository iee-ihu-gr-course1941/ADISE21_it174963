<?php
//-------------CONNECTION-------------------------------------------------------
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

if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" .
    $con->connect_errno . ") " . $con->connect_error;
}else{
  echo " CONN_2 ";
}

//------------------------------------------------------------------------------
$sql = "INSERT INTO `board_1`(`x`, `y`, `c_symbol`, `c_number`) VALUES (1,1,'Hearts','A') ;" ;
if (mysqli_query($con, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// $sql = "INSERT INTO board_1(x, y, c_symbol, c_number) VALUES (1,1,'Hearts','2') ";
// if($con->query($sql) === true){
// 		echo "Records inserted successfully.";
// } else{
// 		echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
// }


// $method = $_SERVER['REQUEST_METHOD'];
// $request = 'cards';
// $json = file_get_contents('php://input');
// $data = json_decode($json);
// // echo $data->symbol;
//
//
//
// switch ($request) {
//   case 'cards': handle_cards($method, $request,$data);
//             		break;
//   default:  header("HTTP/1.1 404 Not Found");
//             exit;
// }
//
// function handle_cards($method, $request,$data){
	// $sym=$data->symbol;
	// $num=$data->number;
	// echo $sym;
	// echo $num;
	//
	//
	// if(!isset($sym)) {
	// 	if(!isset($num)) {
	// 		header("HTTP/1.1 400 Bad Request");
	// 		print json_encode(["No data given."]);
	// 		exit;
	// 	}
	// }

//-----------ΦΘΑΝΟΥΝ ΜΕΧΡΙ ΕΔΩ ΟΙ ΤΙΜΕΣ ΠΟΥ ΘΕΛΩ--------------------------------

	// $sql = 'INSERT INTO board_1(x, y, c_symbol, c_number) VALUES (1,1,?,?) ';
	// $st = $mysqli->prepare($sql);
	// $st->bind_param('ss',$sym,$num);
	// $st->execute();


// }





//------------------------------------------------------------------------------
 ?>
