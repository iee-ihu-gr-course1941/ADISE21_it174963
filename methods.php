<?php
//-------------CONNECTION-------------------------------------------------------
require_once "include/db_connect.php";

//------------------------------------------------------------------------------

$method = $_SERVER['REQUEST_METHOD'];
$request = explode ('/',trim($_SERVER['PATH_INFO'],'/'));
$json = file_get_contents('php://input');
$data = json_decode($json);


switch ($r=array_shift($request)) {
  case 'reset': handle_reset($method, $request, $conn);
                break;
  case 'cards': handle_cards($method, $request, $data, $conn);
                break;
  case 'status': handle_status($conn);
                 break;
  case 'players': handle_log_user($method, $request, $data, $conn);
                  break;
  case 'refresh': handle_refresh($conn);
                  break;
  case 'cards_delete': handle_cards_delete($method, $request, $data, $conn);
                       break;
  case 'cards_move_K': handle_cards_move_K($method, $request, $data, $conn);
                       break;
  default:  header("HTTP/1.1 404 Not Found");
            exit;
}
//------------------------------------------------------------------------------


//---------RESET EVERYTHING SECTION---------------------------------------------
function handle_reset($method, $request, $conn){
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


  for($i=1; $i<=2; $i++){
    $sql = "UPDATE `players` SET `username`= NULL ,`token`= NULL WHERE `player_side`='$i' ";
  	if (mysqli_query($conn, $sql)) {
      echo "<br>" . "- Records for players cleared successfully ";
  	} else {
  		echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
  	}
  }

  $sql = "  UPDATE `game_status` SET `status`='not active',`p_turn`= 1,`result`=NULL,`last_change`= CURRENT_TIMESTAMP()";
  if (mysqli_query($conn, $sql)) {
    echo "<br>" . "- Records for game_status cleared successfully ";
  } else {
    echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
  }
}
//------------------------------------------------------------------------------



//---------STATUS SECTION-------------------------------------------------------
function handle_status($conn) {
	check_abort($conn);

	$sql = "SELECT * FROM `game_status`" ;
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    print json_encode($row["p_turn"]);
  }
}


function check_abort($conn) {
  $sql = "UPDATE `game_status` SET `status` = 'aborded', `p_turn` = NULL, `result` = NULL
          WHERE p_turn IS NOT NULL AND last_change< (NOW() - INTERVAL 5 MINUTE) AND `status` = 'started'";
  if (mysqli_query($conn, $sql)) {
    // echo "<br>" . "-  Checked the aborted successfully ";
  } else {
    echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
  }
}


function update_game_status($conn) {
  $sql = "SELECT * FROM `game_status` ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$status = $row["status"];
  $status_player_turn = $row["p_turn"];

	$new_status = null;
	$new_turn = 0;

  $sql = "SELECT COUNT(*) AS aborted FROM `players` WHERE `last_action`< (NOW() - INTERVAL 5 MINUTE )";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$aborted = $row["aborted"];


	if($aborted>0) {
		$sql = "UPDATE `players` SET `username` = NULL, `token` = NULL WHERE `last_action` < (NOW() - INTERVAL 5 MINUTE)";
		mysqli_query($conn, $sql);
		if($status == 'started') {
			$new_status='aborted';
		}
	}


	$sql = "SELECT COUNT(*) AS c FROM `players` WHERE `username` IS NOT NULL";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$active_players = $row["c"];


	switch($active_players) {
		case 0:
            $new_status='not active';
            break;
		case 1:
            $new_status='initialized';
            break;
		case 2:
            $new_status='started';
				        if($status_player_turn == null) {
					             $new_turn = 1;
				        }
				    break;
	}


  $sql = "UPDATE `game_status` SET `status`= '$new_status',`p_turn`='$new_turn' ";
  if (mysqli_query($conn, $sql)) {
    // echo "<br>" . "-  Game Status changed successfully ";
  } else {
    echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
  }

}
//------------------------------------------------------------------------------


//---------LOG USER INTO players BOARD SECTION----------------------------------
function handle_log_user($method, $request, $data, $conn){
  $user = $data->username;
  $p_side = $data->player_side;
  $StringToToken = $user.date("Y-m-d H:i:s");

  if(!isset($user) || $user == '') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"No username given."]);
		exit;
	}

  $sql = "SELECT `username`,`player_side` FROM `players` WHERE `player_side`='$p_side'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  if($row["username"] == "" ){
    // echo "<br>" . "- There is an available seat for player ";
    $sql = "UPDATE `players` SET `username`='$user',`token`=md5( '$StringToToken' ) ,`last_action`=CURRENT_TIMESTAMP() WHERE `player_side`='$p_side' ;" ;
    if (mysqli_query($conn, $sql)) {
      // echo "<br>" . "- Record of user updated successfully ";
    } else {
      echo "<br>" . "- Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }else{
    // echo "<br>" . "- There is not an available seat for player ";
  }

  update_game_status($conn);

  print json_encode( md5( $StringToToken ) );
  print json_encode($p_side);

}
//------------------------------------------------------------------------------



//---------REFRESH EVERYTHING SECTION-------------------------------------------
function handle_refresh($conn){
  $sql = " SELECT * FROM `board_1`  ";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($rows as $row) {
      printf("%s %s %s %s <br>", $row["x"], $row["y"], $row["c_symbol"], $row["c_number"]);
  }

  echo("-");

  $sql = " SELECT * FROM `board_2`  ";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($rows as $row) {
      printf("%s %s %s %s <br>", $row["x"], $row["y"], $row["c_symbol"], $row["c_number"]);
  }

  echo("-");

  $sql = " SELECT `username` FROM `players`  ";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($rows as $row) {
      printf("%s <br>", $row["username"]);
  }
}
//------------------------------------------------------------------------------


//---------FILL board_1/board_2 WITH DATA SECTION-------------------------------
function handle_cards($method, $request, $data, $conn){
  $board = $data->board;
  $x = $data->x;
  $y = $data->y;
  $sym=$data->symbol;
  $num=$data->number;


	$sql = "UPDATE `$board` SET `c_symbol`='$sym',`c_number`='$num' WHERE `x`= '$x' AND `y`=' $y' ;" ;
		if (mysqli_query($conn, $sql)) {
			echo "<br>" . "- Record updated successfully ";
		} else {
			echo "<br>" . "- Error: " . $sql . "<br>" . mysqli_error($conn);
		}
}
//------------------------------------------------------------------------------


//---------DELETE SPECIFIED CARD SECTION----------------------------------------
function handle_cards_delete($method, $request, $data, $conn){
  $sym_1=$data->symbol_1;
  $num_1=$data->number_1;
  $board_1=$data->board_1;

  $sym_2=$data->symbol_2;
  $num_2=$data->number_2;
  $board_2=$data->board_2;

  $sql = " UPDATE `$board_1` SET `c_symbol`= NULL,`c_number`= NULL WHERE `c_symbol`= '$sym_1' AND `c_number`= '$num_1' ";
  if (mysqli_query($conn, $sql)) {
    echo "<br>" . "- Specified card deleted successfully ";
  } else {
    echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
  }

  $sql = " UPDATE `$board_2` SET `c_symbol`= NULL,`c_number`= NULL WHERE  `c_symbol`= '$sym_2' AND `c_number`= '$num_2' ";
  if (mysqli_query($conn, $sql)) {
    echo "<br>" . "- Specified card deleted successfully ";
  } else {
    echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
  }
}
//------------------------------------------------------------------------------



//---------MOVE 'K' CARD SECTION------------------------------------------------
function handle_cards_move_K($method, $request, $data, $conn){
  $sym=$data->symbol;
  $num=$data->number;
  $board=$data->board;

  if($board == "board_2"){
    $board_opposite = "board_1";
  }else{
    $board_opposite = "board_2";
  }

  $sql = " SELECT * FROM `$board_opposite`  ";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($rows as $row) {
    if($row["c_symbol"] == ""){
      $xToMove = $row["x"];
      $yToMove = $row["y"];;

      $sql = " UPDATE `$board_opposite` SET `c_symbol`= `$sym`,`c_number`= `$num` WHERE `x`= '$xToMove' AND `y`= '$yToMove' ";
      if (mysqli_query($conn, $sql)) {
        echo "<br>" . "- Card K moved successfully ";
      } else {
        echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
      }

      $sql = " UPDATE `$board` SET `c_symbol`= NULL,`c_number`= NULL WHERE  `c_symbol`= '$sym' AND `c_number`= '$num' ";
      if (mysqli_query($conn, $sql)) {
        echo "<br>" . "- Card K deleted successfully ";
      } else {
        echo "<br>" . "- Error: " . $sql . "<br>" .  mysqli_error($conn);
      }

      break;
    }
  }
}

 ?>
