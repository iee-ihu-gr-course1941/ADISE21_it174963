<?php
//-------------CONNECTION-------------------------------------------------------
require_once "include/db_connect.php";

//------------------------------------------------------------------------------
$method = $_SERVER['REQUEST_METHOD'];
$request = explode ('/',trim($_SERVER['PATH_INFO'],'/'));
$json = file_get_contents('php://input');
$data = json_decode($json);


switch ($r=array_shift($request)) {
  case 'cards_1': handle_cards_1($method, $request, $data, $conn);
            			break;
	case 'cards_2': handle_cards_2($method, $request, $data, $conn);
									break;
  case 'cards_clear': handle_cards_clear($method, $request, $conn);
                      break;
  default:  header("HTTP/1.1 404 Not Found");
            exit;
}

function handle_cards_clear(){
  // $sql = "UPDATE 'board_1'
  //         INNER JOIN board_empty  ON `board_1.x` = `board_empty.x` AND `board_1.y`=`board_empty.y`
  //         SET `c_symbol` = ''  ,  `c_number` = ''
  //         WHERE `x` = 1 AND `y`=1 " ;

  $sql = "SELECT * FROM `board_1` ";
		if (mysqli_query($conn, $sql)) {
			echo "Record updated successfully ";
		} else {
			echo "Error: " . $sql . "<br>" .  mysqli_error($conn);
		}

    // $sql = "UPDATE 'board_2'
    //         INNER JOIN 'board_empty'  ON 'board_2.x'='board_empty.x' AND 'board_2.y'='board_empty.y'
    //         SET 'board_2.c_symbol' = 'board_empty.c_symbol' , 'board_2.c_number' = 'board_empty.c_number' ;" ;
    //   if (mysqli_query($conn, $sql)) {
    //     echo "Record updated successfully ";
    //   } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //   }


}


function handle_cards_1($method, $request, $data, $conn){
  $x1 = $data->x;
  $y1 = $data->y;
	$sym = $data->symbol;
	$num = $data->number;
  echo "$x1";
  echo "$y1";
  echo "$sym";
  echo "$num";


	if(!isset($sym)) {
		if(!isset($num)) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(["No data given."]);
			exit;
		}
	}


	$sql = "UPDATE `board_1` SET `c_symbol`='$sym',`c_number`='$num' WHERE `x`= '$x1' AND `y`=' $y1' ;" ;
		if (mysqli_query($conn, $sql)) {
			echo "Record updated successfully ";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

}

function handle_cards_2($method, $request, $data, $conn){
  $x2 = $data->x;
  $y2 = $data->y;
	$sym=$data->symbol;
	$num=$data->number;

	if(!isset($sym)) {
		if(!isset($num)) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(["No data given."]);
			exit;
		}
	}


	$sql = "UPDATE `board_2` SET `c_symbol`='$sym',`c_number`='$num' WHERE `x`= '$x2' AND `y`='$y2' ;" ;
		if (mysqli_query($conn, $sql)) {
			echo "Record updated successfully ";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

}

//------------------------------------------------------------------------------
 ?>
