//-----------------LOGIN SECTION------------------------------------------------
var token = null;


function login_to_game() {
  $('#formModal').hide();
  $('.Player1_name').text($('#username').val());


  var dataToPass = JSON.stringify({
    username: $('#username').val(),
    player_side: $('#LogIn_selected_player_side :selected').val(),

  });

  $.ajax({
    url: "methods.php/players/",
    method: 'POST',
		headers: {"X-Token": token},
    contentType: 'application/json',
    data: dataToPass,
    success: login_result
  });

  
}

function login_result(data){
  var t = "";
  for(var i=111; i<=142; i++){
    t += data[i];
  }
  token = t;
  alert('Login successful' + token);
}
//------------------------------------------------------------------------------


//-----------------RULES SECTION------------------------------------------------
var Rules_counter = true;

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
var myDeck = new deck();
var pos_1_x = 1;
var pos_1_y = 1;
var pos_2_x = 1;
var pos_2_y = 1;

function shuffle_deck() {

  handle_shuffle_buttons();

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

      fill_board_1(i, pos_1_x, pos_1_y);

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

      fill_board_2(i, pos_2_x, pos_2_y);

      if (pos_2_y == 12) {
        pos_2_x++;
        pos_2_y = 0;
      }
      pos_2_y++;
    }
  }

} //------------------------------------------------------------------------------


//------SHUFFLE BUTTONS SPECIAL_EFFECTS SECTION---------------------------------
function handle_shuffle_buttons() {
  $("#shuffle_card_img").attr("src", "extras/shuffled_card.png").stop(true, true).hide().fadeIn();
  document.getElementById("shuffle_card_img").style.transform = "rotate(" + 90 + "deg)";

  $('#shuffle_cards_btn').prop('disabled', true);
  $('#shuffle_cards_btn').fadeTo("slow", 0.4);
}

function shuffle(o) {
  for (var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
  return o;
};

function clear_board() {
  $.ajax({
    url: "methods.php/cards_clear/",
    method: 'POST',
    headers: {"X-Token": token},
    contentType: 'application/json',
    success: clear_real_board
  });
}
//------------------------------------------------------------------------------


//-------Fill board_1 of the MYSQL database with data---------------------------
function fill_board_1(i, x1, y1) {

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

  var data = JSON.stringify({
    x: x1,
    y: y1,
    symbol: cs,
    number: cn
  });

  $.ajax({
    url: "methods.php/cards_1/",
    method: 'POST',
    headers: {"X-Token": token},
    contentType: 'application/json',
    data: data,
    success: fill_real_board_1
  });
}
//------------------------------------------------------------------------------


//-------Fill board_2 of the MYSQL database with data---------------------------
function fill_board_2(i, x2, y2) {

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

  var data = JSON.stringify({
    x: x2,
    y: y2,
    symbol: cs,
    number: cn
  });

  $.ajax({
    url: "methods.php/cards_2/",
    method: 'POST',
    headers: {"X-Token": token},
    contentType: 'application/json',
    data: data,
    success: fill_real_board_2
  });
}

function fill_real_board_1() {}

function fill_real_board_2() {}

function clear_real_board() {
  alert("! S U C C E S S !");
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
