<?php
//-------------CONNECTION-------------------------------------------------------
require_once "include/db_connect.php";

//------------------------------------------------------------------------------
$method = $_SERVER['REQUEST_METHOD'];
$request = explode ('/',trim($_SERVER['PATH_INFO'],'/'));
$json = file_get_contents('php://input');
$data = json_decode($json);


switch ($r=array_shift($request)) {
  case 'players': log_user($method, $request, $data, $conn);
                  break;
  case 'cards_1': handle_cards_1($method, $request, $data, $conn);
            			break;
	case 'cards_2': handle_cards_2($method, $request, $data, $conn);
									break;
  case 'cards_clear': handle_cards_clear($method, $request, $conn);
                      break;
  default:  header("HTTP/1.1 404 Not Found");
            exit;
}

//---------LOG USER INTO players BOARD SECTION----------------------------------
function log_user($method, $request, $data, $conn){
  $user = $data->username;
  $p_side = $data->player_side;
  $StringToToken = $user.date("Y-m-d H:i:s");

  if(!isset($user) || $user == '') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"No username given."]);
		exit;
	}

  $sql1 = "SELECT `username`  FROM `players` WHERE `player_side`='$p_side'";
  $result = mysqli_query($conn, $sql1);
  $row = mysql_fetch_row($result);

  echo $row[0]; // 42

  // if (mysqli_query($conn, $sql2)) {
  //   $result = mysqli_query($conn, $sql1);
  //   if($result == "" ){
  //     echo "<br>" . "- There is an available seat for player ";
  //     $sql2 = "UPDATE `players` SET `username`='$user',`token`=md5( '$StringToToken' ) ,`last_action`=CURRENT_TIMESTAMP() WHERE `player_side`='$p_side' ;" ;
  //       if (mysqli_query($conn, $sql2)) {
  //         echo "<br>" . "- Record of user updated successfully ";
  //       } else {
  //         echo "<br>" . "- Error: " . $sql . "<br>" . mysqli_error($conn);
  //       }
  //   }else{
  //     echo "<br>" . "- There is not an available seat for player ";
  //   }
  // } else {
  //   echo "<br>" . "- Error: " . $sql . "<br>" . mysqli_error($conn);
  // }




  //
  // $sql2 = "UPDATE `players` SET `username`='$user',`token`=md5( '$StringToToken' ) ,`last_action`=CURRENT_TIMESTAMP() WHERE `player_side`='$p_side' ;" ;
  //   if (mysqli_query($conn, $sql2)) {
  //     echo "<br>" . "- Record of user updated successfully ";
  //   } else {
  //     echo "<br>" . "- Error: " . $sql . "<br>" . mysqli_error($conn);
  //   }

}



//---------CLEAR ALL BOARDS SECTION---------------------------------------------
function handle_cards_clear($method, $request, $conn){
  $sql = "UPDATE board_1 B1
          INNER JOIN board_empty BE  ON B1.x = BE.x AND B1.y = BE.y
          SET B1.c_symbol = BE.c_symbol , B1.c_number = BE.c_number ";
	if (mysqli_query($conn, $sql)) {
		echo "<br>" . "- Records for board_1 cleared successfully ";
	} else {
		echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
	}

  $sql = "UPDATE board_2 B2
          INNER JOIN board_empty BE  ON B2.x = BE.x AND B2.y = BE.y
          SET B2.c_symbol = BE.c_symbol , B2.c_number = BE.c_number ";
	if (mysqli_query($conn, $sql)) {
    echo "<br>" . "- Records for board_2 cleared successfully ";
	} else {
		echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
	}
}


//---------FILL board_1 WITH DATA SECTION---------------------------------------
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


//---------FILL board_2 WITH DATA SECTION---------------------------------------
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
