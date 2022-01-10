//-----------------VARIABLES SECTION--------------------------------------------
var me = {
  token: null,
  player_turn: null
};
var timer = null;
var game_status = {};
var last_update = new Date().getTime();
var Rules_flag = true;
var myDeck = new deck();
var pos_1_x = 1;
var pos_1_y = 1;
var pos_2_x = 1;
var pos_2_y = 1;
//------------------------------------------------------------------------------


//---------------------------------------------------------------- S T A R T  U P  F U N C T I O N S -----------------------------------------------------------------------------------
$(function() {
  reset_everything();
  initialize_deck();
});
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------






//---------------------------------------------------------------- B A S I C  F U N C T I O N S ----------------------------------------------------------------------------------------

//-----------------STATUS SECTION-----------------------------------------------
//----FIND STATUS - PHP METHOD--------------------------------------------------
function find_game_status() {
  clearTimeout(timer);

  refresh();

  $.ajax({
    url: "methods.php/status/",
    headers: {"X-Token": me.token},
    success: update_status
  });
}

//----UPDATE STATUS METHOD------------------------------------------------------
function update_status(data) {
  last_update = new Date().getTime();
  game_players_turn = data[1];

  if ((game_players_turn !== "1") || (game_players_turn !== "1")) {
    console.log("game_status : initialized" + " / players_turn : none");
  } else {
    console.log("game_status : started" + " / players_turn : " + game_players_turn);
  }

  clearTimeout(timer);

  //show whose turn it is to make a move
  if (game_players_turn == 1) {
    $('.players_turn_txt').text("Player's  turn : " + $('.Player1_name').text());
  } else if (game_players_turn == 2) {
    $('.players_turn_txt').text("Player's  turn : " + $('.Player2_name').text());
  }

  if (game_players_turn == me.player_turn && me.player_turn != null) {
    //αν ειναι η σειρα μου βαση τοκεν και p_turn τοτε μπορω να κανω την κινηση μου
    //θα καλω την μεθοδο που χρειαζεται για να κανει κινηση ο παικτης μου
    timer = setTimeout(function() {
      find_game_status();
    }, 10000);
    console.log("time : 10000");
  } else {
    // αν οχι, περιμενω κινηση απο τον αλλον
    //θα καλω την μεθοδο που χρειαζεται για να κανει κινηση ο αντιπαλος παικτης
    timer = setTimeout(function() {
      find_game_status();
    }, 5000);
    console.log("time : 5000");
  }
}
//------------------------------------------------------------------------------


//-----------------REFRESH SECTION----------------------------------------------
//----REFRESH - PHP METHOD------------------------------------------------------
function refresh() {
  // handle_shuffle_effects();
  $.ajax({
    url: "methods.php/refresh/",
    headers: {"X-Token": me.token},
    success: refresh_everything
  });
}

//----REFRESH - BOARD IN_GAME METHOD--------------------------------------------
function refresh_everything(data) {
  clearTimeout(timer);

  //split all returned data into board_1-data, board_2-data, both player's name
  var dataArrays_Splitted = data.split("-", 3);

  var dataArray_1_Splitted = dataArrays_Splitted[0].split("<br>", 52); // board_1-data
  var dataArray_2_Splitted = dataArrays_Splitted[1].split("<br>", 52); // board_2-data
  var dataArray_3_Splitted = dataArrays_Splitted[2].split("<br>", 2); // both player's name

  //refresh names
  $('.Player1_name').text(dataArray_3_Splitted[0]);
  $('.Player2_name').text(dataArray_3_Splitted[1]);


  //refresh cards
  for (var i = 0; i <= 51; i++) {
    //-----------Clear both sides from any cards--------------------------------
    var cell_1 = "#c1-" + (i + 1);
    var cell_2 = "#c2-" + (i + 1);
    $(cell_1).html("");
    $(cell_2).html("");

    //-----------For board_1----------------------------------------------------
    var dataArray1_RowSplitted = dataArray_1_Splitted[i].split(" ", 4);
    var x1 = dataArray1_RowSplitted[0]; //---------ολα τα x---------------------
    var y1 = dataArray1_RowSplitted[1]; //---------ολα τα y---------------------
    var c_s1 = dataArray1_RowSplitted[2]; //---------ολα τα c_symbol------------
    var c_n1 = dataArray1_RowSplitted[3]; //---------ολα τα c_number------------
    if (c_s1 != "") {
      var side_1 = 1;
      create_Cards(i, side_1, cell_1, cell_2, c_s1, c_n1);
    }

    //-----------For board_2----------------------------------------------------
    var dataArray2_RowSplitted = dataArray_2_Splitted[i].split(" ", 4);
    var x2 = dataArray2_RowSplitted[0]; //---------ολα τα x---------------------
    var y2 = dataArray2_RowSplitted[1]; //---------ολα τα y---------------------
    var c_s2 = dataArray2_RowSplitted[2]; //---------ολα τα c_symbol------------
    var c_n2 = dataArray2_RowSplitted[3]; //---------ολα τα c_number------------
    if (c_s2 != "") {
      var side_2 = 2;
      create_Cards(i, side_2, cell_1, cell_2, c_s2, c_n2);
    }
  }

  if (me.player_turn == 1) {
    hide_cards(2);
  }else{
    hide_cards(1);
  }
}

//----HIDE - OPPONENT'S CARDS METHOD--------------------------------------------
function hide_cards(c){
  for (var i = 0; i <= 51; i++) {
    var cid = "#div_card_" + c + "_" + i;
    var hide_spans = cid + " > span";
    var remove_bCard = cid + " > img";
    $(remove_bCard).remove();

    var hasCardInside1 = $(cid).is(':has(span.number)');
    var hasCardInside2 = $(cid).is(':has(span.number_red)');
    if (hasCardInside1 == true || hasCardInside2 == true) {
      $(hide_spans).hide();
      $(cid).append("<img id='BackOfCard' class='bCard' src='extras/shuffled_card.png'/>");
    }
  }
}
//------------------------------------------------------------------------------


//-----------------LOGIN SECTION------------------------------------------------
//----LOG_IN - PHP METHOD-------------------------------------------------------
function login_to_game() {
  $('#formModal').hide();

  var dataToPass = JSON.stringify({
    username: $('#username').val(),
    player_side: $('#LogIn_selected_player_side :selected').val()
  });

  $.ajax({
    url: "methods.php/players/",
    method: 'POST',
    headers: {"X-Token": me.token},
    contentType: 'application/json',
    data: dataToPass,
    success: login_result
  });
}

//----LOG_IN - PHP - RESULT METHOD----------------------------------------------
function login_result(data) {
  var temp_token = "";
  for (var i = 1; i <= 32; i++) {
    temp_token += data[i];
  }

  me.token = temp_token;
  me.player_turn = data[35];

  console.log('Log_In successful \n' + 'Token: ' + me.token + "\nPlayers turn: " + me.player_turn);

  for(var i=0; i<=51; i++){ // make this into a method for the 'click on a card ' event
    if (me.player_turn == 1) {
      var cid_lock = "#c1-" + (i+1);
      $(cid_lock).prop('onclick', null);
    }else{
      var cid_lock = "#c2-" + (i+1);
      $(cid_lock).prop('onclick', null);
    }
  }
  find_game_status();
}
//------------------------------------------------------------------------------


//-----------------RESET SECTION------------------------------------------------
//----RESET - PHP - METHOD------------------------------------------------------
function reset_everything() {
  $.ajax({
    url: "methods.php/reset/",
    method: 'POST',
    headers: {"X-Token": me.token},
    contentType: 'application/json',
    success: reset_everything_result
  });
}

function reset_everything_result() {
  console.log("! RESET SUCCESSFUL !");
}
//------------------------------------------------------------------------------



//-----------------INITIALIZE CARDS FOR GAME SECTION----------------------------
//------CREATE FIRST DECK  METHOD-----------------------------------------------
function card(value, name, suit) {
  this.value = value;
  this.name = name;
  this.suit = suit;
}

function deck() {
  this.names = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
  this.suits = ['Hearts', 'Diamonds', 'Spades', 'Clubs'];
  var cards = [];

  for (var s = 0; s < this.suits.length; s++) {
    for (var n = 0; n < this.names.length; n++) {
      cards.push(new card(n + 1, this.names[n], this.suits[s]));
    }
  }
  return cards;
}

//----SHUFFLE FIRST DECK - METHOD-----------------------------------------------
function shuffle(o) {
  for (var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
  return o;
};

//----INITIALIZE IN-GAME CARDS - METHOD-----------------------------------------
function initialize_deck() {
  myDeck = shuffle(myDeck);

  for (var i = 0; i < myDeck.length; i++) {
    var side_1 = 1;
    var cell_1 = "#c1-" + (i + 1);
    var card_1 = '#div_card_1_';
    var side_2 = 2;
    var cell_2 = "#c2-" + (i + 1);
    var card_2 = '#div_card_2_';

    if (i % 2 == 0) { // Calls the function that creates each card--------------
      $(cell_1).html("");
      $(cell_2).html("");
      var c_s1 = myDeck[i].suit;
      var c_n1 = myDeck[i].name;
      create_Cards(i, side_1, cell_1, cell_2, c_s1, c_n1);

      if (pos_1_y == 12) {
        pos_1_x++;
        pos_1_y = 0;
      }
      pos_1_y++;
    } else {
      $(cell_1).html("");
      $(cell_2).html("");
      var c_s2 = myDeck[i].suit;
      var c_n2 = myDeck[i].name;
      create_Cards(i, side_2, cell_1, cell_2, c_s2, c_n2);

      if (pos_2_y == 12) {
        pos_2_x++;
        pos_2_y = 0;
      }
      pos_2_y++;
    }
  }

  find_pairs(); // Calls the function that finds and remove pairs of 2 ---------

  var pos_1_x = 1;
  var pos_1_y = 1;
  var pos_2_x = 1;
  var pos_2_y = 1;

  for (var i = 0; i <= 51; i++) {
    if (i % 2 == 0) {
      var card_found = $("#c1-" + (i + 1)).find("div");;

      if (card_found.length) {
        fill_board_game(i, pos_1_x, pos_1_y, card_found); // Calls the function that fills the game and database with the cards
        if (pos_1_y == 12) {
          pos_1_x++;
          pos_1_y = 0;
        }
        pos_1_y++;
      }
    } else {
      var card_found = $("#c2-" + (i + 1)).find("div");;

      if (card_found.length) {
        fill_board_game(i, pos_2_x, pos_2_y, card_found); // Calls the function that fills the game and database with the cards
        if (pos_2_y == 12) {
          pos_2_x++;
          pos_2_y = 0;
        }
        pos_2_y++;
      }
    }
  }
}

//----CREATE IN-GAME CARDS - METHOD---------------------------------------------
function create_Cards(index, side, cell_1, cell_2, c_s, c_n) {
  div = document.createElement('div');
  div.className = 'card';

  if (c_s == 'Diamonds') {
    var ascii_char = '&diams;';
    div.innerHTML = '<span class="number_red">' + c_n + '</span><span class="suit_red">' + ascii_char + '</span>';
  } else if (c_s == "Hearts") {
    var ascii_char = '&' + c_s.toLowerCase() + ';';
    div.innerHTML = '<span class="number_red">' + c_n + '</span><span class="suit_red">' + ascii_char + '</span>';
  } else {
    var ascii_char = '&' + c_s.toLowerCase() + ';';
    div.innerHTML = '<span class="number">' + c_n + '</span><span class="suit">' + ascii_char + '</span>';
  }

  if (side == 1) {
    div.id = 'div_card_1_' + index;
    $(cell_1).append(div);
  } else {
    div.id = 'div_card_2_' + index;
    $(cell_2).append(div);
  }
}


//----FILL MYSQL DATABASE - PHP - METHOD----------------------------------------
function fill_board_game(i, x, y, card_found) {
  var boardToPass = "";

  var c = $(card_found).attr("id");
  var cardToPass = $(card_found).find("span");
  var cTP = c.substring(0, 11);

  var cn = cardToPass[0].innerHTML;
  var cs = cardToPass[1].innerHTML;

  switch (cs) {
    case "♣":
      cs = "Clubs";
      break;
    case "♥":
      cs = "Hearts";
      break;
    case "♠":
      cs = "Spades";
      break;
    case "♦":
      cs = "Diamonds";
      break;
  }

  //--- PHP REQUEST ---

  if (cTP == 'div_card_1_') {
    boardToPass = "board_1";
  } else {
    boardToPass = "board_2";
  }

  var dataToPass = JSON.stringify({
    board: boardToPass,
    x: x,
    y: y,
    symbol: cs,
    number: cn
  });

  $.ajax({
    url: "methods.php/cards/",
    method: 'POST',
    headers: {"X-Token": me.token},
    contentType: 'application/json',
    data: dataToPass,
  });
}
//------------------------------------------------------------------------------


//-----------------CLICK ON CARD SECTION----------------------------------------
//----CLICKED ON A SPECIFIC CARD - METHOD---------------------------------------
function card_picked(cp) {
  var boardToPass = "";
  $('.Card_OnTop_div').empty();
  div = document.createElement('div');
  div.className = 'card';
  div.id = 'div_card_picked';

  var cp_splited = cp.split("-");
  if (cp_splited[0] == 1) {
    var cp_num = '#div_card_1_';
  } else {
    var cp_num = '#div_card_2_';
  }

  var card_picked_id = cp_num + cp_splited[1];
  var card_picked_spans = $(card_picked_id).find('span');
  var cn = card_picked_spans[0].innerHTML;
  var cs = card_picked_spans[1].innerHTML;

  var spanClass = $(card_picked_id).find('span').attr('class');
  if (spanClass == "number_red") {
    div.innerHTML = '<span class="number_red">' + cn + '</span><span class="suit_red">' + cs + '</span>';
  } else {
    div.innerHTML = '<span class="number">' + cn + '</span><span class="suit">' + cs + '</span>';
  }

  $('.Card_OnTop_div').append(div);

  if (cp_num == '#div_card_1_') {
    card_picked_result("#c2-" , "div_card_2_" , 2 , cn , cs , card_picked_id);
    hide_cards(1);
  } else {
    card_picked_result("#c1-" , "div_card_1_" , 1 , cn , cs , card_picked_id);
    hide_cards(2);
  }

}

function cards_delete_result() {
  console.log("! CARD DELETE - SUCCESSFUL !");
}


//----CLICKED ON A SPECIFIC CARD - RESULT - METHOD------------------------------
function card_picked_result(cell_half , card_half , target , cn , cs , card_picked_id){
  var cs_2 = "";
  for (var i = 0; i <= 51; i++) {
    var cell_toSearch = $(cell_half + (i + 1)).find("div");
    if (cell_toSearch.length) {
      var card_toSearch = cell_toSearch.find("span");
      if ((cn == card_toSearch[0].innerHTML) && (card_toSearch[0].innerHTML !== "K")) {
        //request php to delete the cards from each board
        //--- PHP REQUEST ---
        switch (cs) {
          case "♣":
            cs = "Clubs";
            break;
          case "♥":
            cs = "Hearts";
            break;
          case "♠":
            cs = "Spades";
            break;
          case "♦":
            cs = "Diamonds";
            break;
        }

        switch (card_toSearch[1].innerHTML) {
          case "♣":
            cs_2 = "Clubs";
            break;
          case "♥":
            cs_2 = "Hearts";
            break;
          case "♠":
            cs_2 = "Spades";
            break;
          case "♦":
            cs_2 = "Diamonds";
            break;
        }

        var dataToPass = JSON.stringify({
          symbol_1: cs,
          number_1: cn,
          symbol_2: cs_2,
          number_2: card_toSearch[0].innerHTML
        });

        $.ajax({
          url: "methods.php/cards_delete/",
          method: 'POST',
          headers: {"X-Token": me.token},
          contentType: 'application/json',
          data: dataToPass,
          success: cards_delete_result
        });
        //--- PHP REQUEST ---

        //delete the cards from each player in_game
        $(card_picked_id).remove();
        $(cell_toSearch).remove();

        //request php to change the players turn and and lock the onclick on the player who played

      } else if((cn == card_toSearch[0].innerHTML) && (card_toSearch[0].innerHTML == "K")){
        var spanClass = $(card_picked_id).find('span').attr('class');
        $(card_picked_id).remove();

        div_K = document.createElement('div');
        div_K.className = 'card';
        if (spanClass == "number_red") {
          div_K.innerHTML = '<span class="number_red">' + cn + '</span><span class="suit_red">' + cs + '</span>';
        } else {
          div_K.innerHTML = '<span class="number">' + cn + '</span><span class="suit">' + cs + '</span>';
        }

        var index = find_empty(target);
        div_K.id = card_half + index;
        $(cell_half + (index+1)).append(div_K);
        break;
      }
    }
  }
}


//----FIND THE FIRST EMPTY SPOT FOR "K" CARD TO MOVE - METHOD-------------------
function find_empty(d){
  for (var i = 0; i <= 51; i++) {
    if(d == 2){
      var cell_toSearch = $("#c2-" + (i + 1)).find("div");
      if (cell_toSearch.length == 0) {
        return i;
        break;
      }
    }else{
      var cell_toSearch = $("#c1-" + (i + 1)).find("div");
      if (cell_toSearch.length == 0) {
        return i;
        break;
      }
    }
  }
}
//------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------






//---------------------------------------------------------------- E X T R A  F U N C T I O N S ----------------------------------------------------------------------------------------

//------SHUFFLE BUTTONS SPECIAL_EFFECTS SECTION---------------------------------
// function handle_shuffle_effects() {
//   if ($("#shuffle_card_img").attr("src") == "extras/shuffled_card.png") {
//     $("#shuffle_card_img").attr("src", "extras/shuffle_card.png").stop(true, true).hide().fadeIn();
//   } else {
//     $("#shuffle_card_img").attr("src", "extras/shuffled_card.png").stop(true, true).hide().fadeIn();
//   }
// }
//------------------------------------------------------------------------------


//-----------------FIND - REMOVE DOUBLES SECTION--------------------------------
//----FIND PAIRS OF 2 IN CARDS - METHOD-----------------------------------------
function find_pairs() {
  var cell = "";
  var card = "";
  for (var i = 0; i <= 51; i++) {
    cell = "#c1-";
    card = "#div_card_1_";
    remove_pairs(i, cell, card);

    cell = "#c2-";
    card = "#div_card_2_";
    remove_pairs(i, cell, card);
  }
}

//----REMOVE PAIRS OF 2 IN CARDS - METHOD---------------------------------------
function remove_pairs(i, cell, card) {
  var counter = 0;
  var array_found = [];
  var cell_i_exists = $(cell + (i + 1)).find("div");
  var cell_i_span_exists = cell_i_exists.find("span");

  if (cell_i_exists.length) {
    for (var z = 0; z <= 51; z++) {
      var cell_z_exists = $(cell + (z + 1)).find("div");
      var cell_z_span_exists = cell_z_exists.find("span");
      if (cell_z_exists.length) {
        if ((cell_i_span_exists[0].innerHTML) == (cell_z_span_exists[0].innerHTML)) {
          array_found.push(z);
          counter++;

          // Delete pairs of 2 in cards
          if ((counter == 2)) {
            if (cell_z_span_exists[0].innerHTML == "K") {
              var cid = card + array_found[1];
              $(cid).remove();
            } else {
              for (var w = 0; w < array_found.length; w++) {
                var cid = card + array_found[w];
                $(cid).remove();
              }
            }
          }

        }
      }

    }
  }

}
//------------------------------------------------------------------------------


//-----------------RULES SECTION------------------------------------------------
function ShowRules() {
  if (Rules_flag == true) {
    $('#Rules-btn').html("Hide Rules");
    $('#Rules_box').show();
    Rules_flag = false;
  } else {
    $('#Rules-btn').html("Show Rules");
    $('#Rules_box').hide();
    Rules_flag = true;
  }
}
//------------------------------------------------------------------------------






//----------------------------------------------------------------------- T H E  E N D -----------------------------------------------------------------------------------------------
