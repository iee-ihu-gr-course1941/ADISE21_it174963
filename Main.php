<!DOCTYPE html>
<html dir="ltr" lang="eng">

<head>
  <meta charset="utf-8" />
  <title>G A M E</title>
  <link rel="icon" type="image/x-icon" href="extras/favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="js/central.js"> </script>



</head>

<body>
  <h1 id="h1">🃏 G A M E 🃏</h1>

  <!--Log In SECTION-->
  <div class="LogIn" id="formModal" style="display: block;">
    <div class="LogIn_content">
      <h1>LOG IN</h1>

      <label for="name"><b>Name</b></label>
      <input id="username" type="text" title="3-10 letters" pattern="^[α-ωa-z]{3,10}$" placeholder="Enter Name" name="username" required=""><br><br>

      <button id="LogIn-btn" class="btn" onclick="login_to_game()">E N T E R</button>
    </div>
  </div>

  <!--Main Page SECTION -->
  <div class="Game_div">
    <div class="Player1_div">
      <b>
        <p class="Player1_name">----- PLAYER 1 -----</p>
      </b> <br>

      <table id="player1_cards" border="1">
        <tbody>
          <tr>
            <td id="c1-1" onclick="card_picked(1)">1-1 &nbsp;</td>
            <td id="c1-2" onclick="card_picked()">1-2 &nbsp;</td>
            <td id="c1-3" onclick="card_picked()">1-3 &nbsp;</td>
            <td id="c1-4" onclick="card_picked()">1-4 &nbsp;</td>
            <td id="c1-5" onclick="card_picked()">1-5 &nbsp;</td>
            <td id="c1-6" onclick="card_picked()">1-6 &nbsp;</td>
            <td id="c1-7" onclick="card_picked()">1-7 &nbsp;</td>
            <td id="c1-8" onclick="card_picked()">1-8 &nbsp;</td>
            <td id="c1-9" onclick="card_picked()">1-9 &nbsp;</td>
            <td id="c1-10" onclick="card_picked()">1-10 &nbsp;</td>
            <td id="c1-11" onclick="card_picked()">1-11 &nbsp;</td>
            <td id="c1-12" onclick="card_picked()">1-12 &nbsp;</td>
          </tr>
          <tr>
            <td id="c1-13" onclick="card_picked()">2-1 &nbsp;</td>
            <td id="c1-14" onclick="card_picked()">2-2 &nbsp;</td>
            <td id="c1-15" onclick="card_picked()">2-3 &nbsp;</td>
            <td id="c1-16" onclick="card_picked()">2-4 &nbsp;</td>
            <td id="c1-17" onclick="card_picked()">2-5 &nbsp;</td>
            <td id="c1-18" onclick="card_picked()">2-6 &nbsp;</td>
            <td id="c1-19" onclick="card_picked()">2-7 &nbsp;</td>
            <td id="c1-20" onclick="card_picked()">2-8 &nbsp;</td>
            <td id="c1-21" onclick="card_picked()">2-9 &nbsp;</td>
            <td id="c1-22" onclick="card_picked()">2-10 &nbsp;</td>
            <td id="c1-23" onclick="card_picked()">2-11 &nbsp;</td>
            <td id="c1-24" onclick="card_picked()">2-12 &nbsp;</td>
          </tr>
          <tr>
            <td id="c1-25" onclick="card_picked()">3-1 &nbsp;</td>
            <td id="c1-26" onclick="card_picked()">3-2 &nbsp;</td>
            <td id="c1-27" onclick="card_picked()">3-3 &nbsp;</td>
            <td id="c1-28" onclick="card_picked()">3-4 &nbsp;</td>
            <td id="c1-29" onclick="card_picked()">3-5 &nbsp;</td>
            <td id="c1-30" onclick="card_picked()">3-6 &nbsp;</td>
            <td id="c1-31" onclick="card_picked()">3-7 &nbsp;</td>
            <td id="c1-32" onclick="card_picked()">3-8 &nbsp;</td>
            <td id="c1-33" onclick="card_picked()">3-9 &nbsp;</td>
            <td id="c1-34" onclick="card_picked()">3-10 &nbsp;</td>
            <td id="c1-35" onclick="card_picked()">3-11 &nbsp;</td>
            <td id="c1-36" onclick="card_picked()">3-12 &nbsp;</td>
          </tr>
          <tr>
            <td id="c1-37" onclick="card_picked()">4-1 &nbsp;</td>
            <td id="c1-38" onclick="card_picked()">4-2 &nbsp;</td>
            <td id="c1-39" onclick="card_picked()">4-3 &nbsp;</td>
            <td id="c1-40" onclick="card_picked()">4-4 &nbsp;</td>
            <td id="c1-41" onclick="card_picked()">4-5 &nbsp;</td>
            <td id="c1-42" onclick="card_picked()">4-6 &nbsp;</td>
            <td id="c1-43" onclick="card_picked()">4-7 &nbsp;</td>
            <td id="c1-44" onclick="card_picked()">4-8 &nbsp;</td>
            <td id="c1-45" onclick="card_picked()">4-9 &nbsp;</td>
            <td id="c1-46" onclick="card_picked()">4-10 &nbsp;</td>
            <td id="c1-47" onclick="card_picked()">4-11 &nbsp;</td>
            <td id="c1-48" onclick="card_picked()">4-12 &nbsp;</td>
          </tr>
          <tr>
            <td id="c1-49" onclick="card_picked()">5-1 &nbsp;</td>
            <td id="c1-50" onclick="card_picked()">5-2 &nbsp;</td>
            <td id="c1-51" onclick="card_picked()">5-3 &nbsp;</td>
            <td id="c1-52" onclick="card_picked()">5-4 &nbsp;</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="Player2_div">
      <b>
        <p class="Player2_name">----- PLAYER 2 -----</p>
      </b> <br>
      <table id="player2_cards" border="1">
        <tbody>
          <tr>
            <td id="c2-1">1-1 &nbsp;</td>
            <td id="c2-2">1-2 &nbsp;</td>
            <td id="c2-3">1-3 &nbsp;</td>
            <td id="c2-4">1-4 &nbsp;</td>
            <td id="c2-5">1-5 &nbsp;</td>
            <td id="c2-6">1-6 &nbsp;</td>
            <td id="c2-7">1-7 &nbsp;</td>
            <td id="c2-8">1-8 &nbsp;</td>
            <td id="c2-9">1-9 &nbsp;</td>
            <td id="c2-10">1-10 &nbsp;</td>
            <td id="c2-11">1-11 &nbsp;</td>
            <td id="c2-12">1-12 &nbsp;</td>
          </tr>
          <tr>
            <td id="c2-13">2-1 &nbsp;</td>
            <td id="c2-14">2-2 &nbsp;</td>
            <td id="c2-15">2-3 &nbsp;</td>
            <td id="c2-16">2-4 &nbsp;</td>
            <td id="c2-17">2-5 &nbsp;</td>
            <td id="c2-18">2-6 &nbsp;</td>
            <td id="c2-19">2-7 &nbsp;</td>
            <td id="c2-20">2-8 &nbsp;</td>
            <td id="c2-21">2-9 &nbsp;</td>
            <td id="c2-22">2-10 &nbsp;</td>
            <td id="c2-23">2-11 &nbsp;</td>
            <td id="c2-24">2-12 &nbsp;</td>
          </tr>
          <tr>
            <td id="c2-25">3-1 &nbsp;</td>
            <td id="c2-26">3-2 &nbsp;</td>
            <td id="c2-27">3-3 &nbsp;</td>
            <td id="c2-28">3-4 &nbsp;</td>
            <td id="c2-29">3-5 &nbsp;</td>
            <td id="c2-30">3-6 &nbsp;</td>
            <td id="c2-31">3-7 &nbsp;</td>
            <td id="c2-32">3-8 &nbsp;</td>
            <td id="c2-33">3-9 &nbsp;</td>
            <td id="c2-34">3-10 &nbsp;</td>
            <td id="c2-35">3-11 &nbsp;</td>
            <td id="c2-36">3-12 &nbsp;</td>
          </tr>
          <tr>
            <td id="c2-37">4-1 &nbsp;</td>
            <td id="c2-38">4-2 &nbsp;</td>
            <td id="c2-39">4-3 &nbsp;</td>
            <td id="c2-40">4-4 &nbsp;</td>
            <td id="c2-41">4-5 &nbsp;</td>
            <td id="c2-42">4-6 &nbsp;</td>
            <td id="c2-43">4-7 &nbsp;</td>
            <td id="c2-44">4-8 &nbsp;</td>
            <td id="c2-45">4-9 &nbsp;</td>
            <td id="c2-46">4-10 &nbsp;</td>
            <td id="c2-47">4-11 &nbsp;</td>
            <td id="c2-48">4-12 &nbsp;</td>
          </tr>
          <tr>
            <td id="c2-49">5-1 &nbsp;</td>
            <td id="c2-50">5-2 &nbsp;</td>
            <td id="c2-51">5-3 &nbsp;</td>
            <td id="c2-52">5-4 &nbsp;</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!--CARD SHUFFLE SECTION-->
  <div class="Card_OnTop_div">

  </div>

  <div class="Game_Details_div">
    <!--CARD SHUFFLE SECTION-->
    <div class="Card_Shuffle_div">
      <div class="Card_Shuffle_img_div">
        <img id="shuffle_card_img" src="extras/shuffle_card.png" alt="card_back">
      </div>
      <div class="Card_Shuffle_buttons_div">
        <input type="button" id="shuffle_cards_btn" name="" value="SHUFFLE" onclick="shuffle_deck()">
        <input type="button" id="clear_board_btn" name="" value="CLEAR BOARD" onclick="clear_board()"  >
      </div>

    </div>

    <!--COMMANDS SECTION-->
    <div class="Commands_div">
      <h3>Pick A Card From The Opponent's Hand</h3>
      <input type="text" placeholder="row" name="" value="" >
      <input type="text" placeholder="column" name="" value="">
    </div>

    <!--RULES SECTION-->
    <div class="Rules_div">
      <button id="Rules-btn" type="button" onclick="ShowRules()">Show Rules</button>
      <div id="Rules_box" style="display: none;">
        <b>----- RULES -----</b> <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc venenatis cursus ex ut vestibulum. Donec sollicitudin nisi sapien, eget tristique tellus vehicula at. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla id
          dolor fermentum, luctus magna non, aliquet lacus. Nam justo libero, egestas et tempor eu, porttitor sed magna. Fusce diam justo, feugiat sed semper sed, sollicitudin ac arcu. Phasellus et nulla rhoncus, aliquam mauris quis, congue nisi.
          Maecenas mi purus, gravida ut nisi eu, euismod volutpat ex. </p>
      </div>
    </div>
  </div>


</body>

</html>
