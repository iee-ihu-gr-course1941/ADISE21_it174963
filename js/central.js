//-----------------LOGIN SECTION------------------------------------------------
function login_to_game() {
  $('#formModal').hide();
  $('.Player1_name').text($('#username').val());
}



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


//-----------------SHUFFLE CARDS SECTION SECTION--------------------------------
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

var myDeck = new deck();

function shuffle_deck() {
  $('#shuffle_card_img').fadeTo( "slow", 0.40 );
  $('#shuffled_deck').empty();

  $('#insert_to_board_btn').removeAttr('disabled');

  myDeck = shuffle(myDeck);

  for (var i = 0; i < myDeck.length; i++) {
    div = document.createElement('div');
    div.className = 'card';
    div.id = 'div_card_' + i;

    if (myDeck[i].suit == 'Diamonds') {
      var ascii_char = '&diams;';
    } else {
      var ascii_char = '&' + myDeck[i].suit.toLowerCase() + ';';
    }

    div.innerHTML = '<span class="number">' + myDeck[i].name + '</span><span class="suit">' + ascii_char + '</span>';
    document.getElementById("shuffled_deck").appendChild(div);
  }

}

function shuffle(o) {
  for (var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
  return o;
};

function fill_board(){

  for(i=0; i<=51; i++){
    if( i%2 == 0 ){

      var var_card = $('#div_card_'+ i).find('span');
      var cn = var_card[0].innerHTML;
      var cs = var_card[1].innerHTML;

      switch(cs) {
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

      var data =JSON.stringify( { symbol: cs , number:  cn } );

      $.ajax({url: "methods.php/cards_1/",
              method: 'POST',
              data:  data ,
              success: fill_real_board_1 });

    }else{

      var var_card = $('#div_card_'+ i).find('span');
      var cn = var_card[0].innerHTML;
      var cs = var_card[1].innerHTML;

      switch(cs) {
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

      var data =JSON.stringify( { symbol: cs , number:  cn } );

      $.ajax({url: "methods.php/cards_2/",
              method: 'POST',
              data:  data ,
              success: fill_real_board_2 });
    }
  }

}

function fill_real_board_1(){
  // $('#insert_to_board_btn').attr('disabled', 'disabled');
  // alert("! S U C C E S S board_1 !");
}

function fill_real_board_2(){
  // $('#insert_to_board_btn').attr('disabled', 'disabled');
  // alert("! S U C C E S S board_2 !");
}
