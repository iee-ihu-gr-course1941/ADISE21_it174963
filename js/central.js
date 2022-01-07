//-----------------VARIABLES SECTION--------------------------------------------
var me={token:null, player_turn:null};
var timer = null;
var game_status = {};
var last_update = new Date().getTime();
var Rules_counter = true;
var myDeck = new deck();
var pos_1_x = 1;
var pos_1_y = 1;
var pos_2_x = 1;
var pos_2_y = 1;
//------------------------------------------------------------------------------


//---------------------------------------------------------------- S T A R T  U P  F U N C T I O N S -----------------------------------------------------------------------------------
$(function(){
  reset_everything();
  shuffle_deck();
});

//---------------------------------------------------------------- B A S I C  F U N C T I O N S ----------------------------------------------------------------------------------------

function find_game_status(){
  clearTimeout(timer);

  refresh();

  $.ajax({
    	url: "methods.php/status/",
      headers: {"X-Token": me.token} ,
      success: update_status
  });
}


function update_status(data) {
  last_update = new Date().getTime();
  game_players_turn = data[1];

  console.log("game_status : " + game_players_turn);

  clearTimeout(timer);

  //show whose turn it is to make a move
  if(game_players_turn == 1){
    $('.players_turn_txt').text( "Player's  turn : " + $('.Player1_name').text() ) ;
  }else if(game_players_turn == 2){
    $('.players_turn_txt').text( "Player's  turn : " + $('.Player2_name').text() ) ;
  }

  if(game_players_turn == me.player_turn  &&  me.player_turn != null) {
    //αν ειναι η σειρα μου βαση τοκεν και p_turn τοτε μπορω να κανω την κινηση μου
    //θα καλω την μεθοδο που χρειαζεται για να κανει κινηση ο παικτης μου
    timer=setTimeout(function() { find_game_status();}, 10000);
    console.log("time : 10000" );
  } else {
    // αν οχι, περιμενω κινηση απο τον αλλον
    //θα καλω την μεθοδο που χρειαζεται για να κανει κινηση ο αντιπαλος παικτης
    timer=setTimeout(function() { find_game_status();}, 5000);
    console.log("time : 10000" );
  }
}
//------------------------------------------------------------------------------


//-----------------REFRESH SECTION----------------------------------------------
function refresh(){
  handle_shuffle_effects();

  $.ajax({
    	url: "methods.php/refresh/",
      headers: {"X-Token": me.token} ,
      success: refresh_everything
  });
}

function refresh_everything(data){
  clearTimeout(timer);

  //split all returned data into board_1-data, board_2-data, both player's name
  var dataArrays_Splitted = data.split("-",3);

  var dataArray_1_Splitted = dataArrays_Splitted[0].split("<br>",52);// board_1-data
  var dataArray_2_Splitted = dataArrays_Splitted[1].split("<br>",52);// board_2-data
  var dataArray_3_Splitted = dataArrays_Splitted[2].split("<br>",2); // both player's name

  //refresh names
  $('.Player1_name').text(dataArray_3_Splitted[0]);
  $('.Player2_name').text(dataArray_3_Splitted[1]);


  //refresh cards
  for(var i=0; i<=51; i++){
    //-----------Clear both sides from any cards--------------------------------
    var cell_1 = "#c1-" + (i + 1);
    var cell_2 = "#c2-" + (i + 1);
    $(cell_1).html("");
    $(cell_2).html("");

    //-----------For board_1----------------------------------------------------
    var dataArray1_RowSplitted = dataArray_1_Splitted[i].split(" ",4);
    var x1 = dataArray1_RowSplitted[0]; //---------ολα τα x---------------------
    var y1 = dataArray1_RowSplitted[1]; //---------ολα τα y---------------------
    var c_s1 = dataArray1_RowSplitted[2]; //---------ολα τα c_symbol------------
    var c_n1 = dataArray1_RowSplitted[3]; //---------ολα τα c_number------------

    if(c_s1 != ""){
      var side_1=1;
      create_Cards(i, side_1, cell_1, cell_2, x1, y1, c_s1, c_n1);
    }

    //-----------For board_2----------------------------------------------------
    var dataArray2_RowSplitted = dataArray_2_Splitted[i].split(" ",4);
    var x2 = dataArray2_RowSplitted[0]; //---------ολα τα x---------------------
    var y2 = dataArray2_RowSplitted[1]; //---------ολα τα y---------------------
    var c_s2 = dataArray2_RowSplitted[2]; //---------ολα τα c_symbol------------
    var c_n2 = dataArray2_RowSplitted[3]; //---------ολα τα c_number------------

    if(c_s2 != ""){
      var side_2=2;
      create_Cards(i, side_2, cell_1, cell_2, x2, y2, c_s2, c_n2);
    }
  }


  //hide opponent's cards
  if(me.player_turn == 1){
    for(var i=0; i<=51; i++){
      var cid = "#div_card_2_" + i;
      var hide_spans = cid +" > span";
      var remove_bCard = cid +" > img";
      $(remove_bCard).remove();

      var hasCardInside1 = $(cid).is(':has(span.number)');
      var hasCardInside2 = $(cid).is(':has(span.number_red)');
      if(hasCardInside1 == true  ||  hasCardInside2 == true){
        $(hide_spans).hide();
        $(cid).append("<img id='BackOfCard' class='bCard' src='extras/shuffled_card.png'/>");
      }
    }
  }else{
    for(var i=0; i<=51; i++){
      var cid = "#div_card_1_" + i;
      var hide_spans = cid +" > span";
      var remove_bCard = cid +" > img";
      $(remove_bCard).remove();

      var hasCardInside1 = $(cid).is(':has(span.number)');
      var hasCardInside2 = $(cid).is(':has(span.number_red)');
      if(hasCardInside1 == true  ||  hasCardInside2 == true){
        $(hide_spans).hide();
        $(cid).append("<img id='BackOfCard' class='bCard' src='extras/shuffled_card.png'/>");
      }
    }
  }

}

function create_Cards(index , side , cell_1 , cell_2 , x , y , c_s , c_n){
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


  if(side == 1){
    div.id = 'div_card_1_' + index;
    $(cell_1).append(div);
  }else{
    div.id = 'div_card_2_' + index;
    $(cell_2).append(div);
  }

}
//------------------------------------------------------------------------------


//-----------------LOGIN SECTION------------------------------------------------
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


function login_result(data){
  var t = "";
  var pt = "";

  for(var i=1; i<=32; i++){
    t += data[i];
  }

  me.token = t;
  me.player_turn = data[35];
  console.log('LogIn successful \n' + me.token + "\n" + me.player_turn );
  find_game_status();

}
//------------------------------------------------------------------------------



//-------Clear board_1 , board_2 of all data------------------------------------
function reset_everything() {
  $.ajax({
    url: "methods.php/cards_clear/",
    method: 'POST',
    headers: {"X-Token":  me.token},
    contentType: 'application/json',
    success: clear_real_board
  });
}

function clear_real_board() {
  console.log("! RESET SUCCESSFUL !");
}
//------------------------------------------------------------------------------



//-----------------SHUFFLE CARDS SECTION----------------------------------------
//------CREATE CARDS  SECTION---------------------------------------------------
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
//------------------------------------------------------------------------------


//------SHUFFLE CARDS AND FILL BOARDS SECTION-----------------------------------
function shuffle_deck() {
  myDeck = shuffle(myDeck);

  for (var i = 0; i < myDeck.length; i++) {
    div = document.createElement('div');
    div.className = 'card';

    if (myDeck[i].suit == 'Diamonds') {
      var ascii_char = '&diams;';
      div.innerHTML = '<span class="number_red">' + myDeck[i].name + '</span><span class="suit_red">' + ascii_char + '</span>';
    } else if (myDeck[i].suit == "Hearts") {
      var ascii_char = '&' + myDeck[i].suit.toLowerCase() + ';';
      div.innerHTML = '<span class="number_red">' + myDeck[i].name + '</span><span class="suit_red">' + ascii_char + '</span>';
    } else {
      var ascii_char = '&' + myDeck[i].suit.toLowerCase() + ';';
      div.innerHTML = '<span class="number">' + myDeck[i].name + '</span><span class="suit">' + ascii_char + '</span>';
    }


    var cell_1 = "#c1-" + (i + 1);
    var cell_2 = "#c2-" + (i + 1);

    if (i % 2 == 0) {
      $(cell_1).html("");
      $(cell_2).html("");
      div.id = 'div_card_1_' + i;
      $(cell_1).append(div);

      fill_board_1_game(i, pos_1_x, pos_1_y);

      if (pos_1_y == 12) {
        pos_1_x++;
        pos_1_y = 0;
      }
      pos_1_y++;

    } else {
      $(cell_2).html("");
      $(cell_1).html("");
      div.id = 'div_card_2_' + i;
      $(cell_2).append(div);

      fill_board_2_game(i, pos_2_x, pos_2_y);

      if (pos_2_y == 12) {
        pos_2_x++;
        pos_2_y = 0;
      }
      pos_2_y++;
    }
  }
}

function shuffle(o) {
  for (var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
  return o;
};
//------------------------------------------------------------------------------


//-------Fill board_1 of the MYSQL database with data---------------------------
function fill_board_1_game(i, x1, y1) {

  var var_card = $('#div_card_1_' + i).find('span');
  var cn = var_card[0].innerHTML;
  var cs = var_card[1].innerHTML;

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

  var dataToPass = JSON.stringify({
    x: x1,
    y: y1,
    symbol: cs,
    number: cn
  });

  fill_board_1_db(dataToPass);
}
//------------------------------------------------------------------------------


//-------Fill board_2 of the MYSQL database with data---------------------------
function fill_board_2_game(i, x2, y2) {

  var var_card = $('#div_card_2_' + i).find('span');
  var cn = var_card[0].innerHTML;
  var cs = var_card[1].innerHTML;

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

  var dataToPass = JSON.stringify({
    x: x2,
    y: y2,
    symbol: cs,
    number: cn
  });

  fill_board_2_db(dataToPass);
}


function fill_board_1_db(dataToPass){
  $.ajax({
    url: "methods.php/cards_1/",
    method: 'POST',
    headers: {"X-Token":  me.token},
    contentType: 'application/json',
    data: dataToPass,
  });
}

function fill_board_2_db(dataToPass){
  $.ajax({
    url: "methods.php/cards_2/",
    method: 'POST',
    headers: {"X-Token":  me.token},
    contentType: 'application/json',
    data: dataToPass,
  });
}
//------------------------------------------------------------------------------








//---------------------------------------------------------------- E X T R A  F U N C T I O N S ----------------------------------------------------------------------------------------

//------SHUFFLE BUTTONS SPECIAL_EFFECTS SECTION---------------------------------
function handle_shuffle_effects() {
  if( $("#shuffle_card_img").attr("src") == "extras/shuffled_card.png" ){
    $("#shuffle_card_img").attr("src", "extras/shuffle_card.png").stop(true, true).hide().fadeIn();
  }else{
    $("#shuffle_card_img").attr("src", "extras/shuffled_card.png").stop(true, true).hide().fadeIn();
  }


  // $('#shuffle_cards_btn').prop('disabled', true);
  // $('#shuffle_cards_btn').fadeTo("slow", 0.4);
}
//------------------------------------------------------------------------------


//-----------------RULES SECTION------------------------------------------------
function ShowRules() {
  if (Rules_counter == true) {
    $('#Rules-btn').html("Hide Rules");
    $('#Rules_box').show();
    Rules_counter = false;
  } else {
    $('#Rules-btn').html("Show Rules");
    $('#Rules_box').hide();
    Rules_counter = true;
  }
}
//------------------------------------------------------------------------------


//-----------------BOARD/TABLE SECTION------------------------------------------
function card_picked(cp) {
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

  var var_card_picked = $(cp_num + cp_splited[1]).find('span');
  var cn = var_card_picked[0].innerHTML;
  var cs = var_card_picked[1].innerHTML;

  var spanClass = $(cp_num + cp_splited[1]).find('span').attr('class');

  if (spanClass == "number_red") {
    div.innerHTML = '<span class="number_red">' + cn + '</span><span class="suit_red">' + cs + '</span>';
  } else {
    div.innerHTML = '<span class="number">' + cn + '</span><span class="suit">' + cs + '</span>';
  }

  $('.Card_OnTop_div').append(div);

}
