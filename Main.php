<!DOCTYPE html>
<html dir="ltr" lang="eng">

<head>
  <meta charset="utf-8" />
  <title>G A M E</title>
  <link rel="stylesheet" type="text/css" href="Main.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="Main.js"> </script>

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
            <td>1-1 &nbsp;</td>
            <td>1-2 &nbsp;</td>
            <td>1-3 &nbsp;</td>
            <td>1-4 &nbsp;</td>
            <td>1-5 &nbsp;</td>
            <td>1-6 &nbsp;</td>
            <td>1-7 &nbsp;</td>
            <td>1-8 &nbsp;</td>
            <td>1-9 &nbsp;</td>
            <td>1-10 &nbsp;</td>
            <td>1-11 &nbsp;</td>
            <td>1-12 &nbsp;</td>
          </tr>
          <tr>
            <td>2-1 &nbsp;</td>
            <td>2-2 &nbsp;</td>
            <td>2-3 &nbsp;</td>
            <td>2-4 &nbsp;</td>
            <td>2-5 &nbsp;</td>
            <td>2-6 &nbsp;</td>
            <td>2-7 &nbsp;</td>
            <td>2-8 &nbsp;</td>
            <td>2-9 &nbsp;</td>
            <td>2-10 &nbsp;</td>
            <td>2-11 &nbsp;</td>
            <td>2-12 &nbsp;</td>
          </tr>
          <tr>
            <td>3-1 &nbsp;</td>
            <td>3-2 &nbsp;</td>
            <td>3-3 &nbsp;</td>
            <td>3-4 &nbsp;</td>
            <td>3-5 &nbsp;</td>
            <td>3-6 &nbsp;</td>
            <td>3-7 &nbsp;</td>
            <td>3-8 &nbsp;</td>
            <td>3-9 &nbsp;</td>
            <td>3-10 &nbsp;</td>
            <td>3-11 &nbsp;</td>
            <td>3-12 &nbsp;</td>
          </tr>
          <tr>
            <td>4-1 &nbsp;</td>
            <td>4-2 &nbsp;</td>
            <td>4-3 &nbsp;</td>
            <td>4-4 &nbsp;</td>
            <td>4-5 &nbsp;</td>
            <td>4-6 &nbsp;</td>
            <td>4-7 &nbsp;</td>
            <td>4-8 &nbsp;</td>
            <td>4-9 &nbsp;</td>
            <td>4-10 &nbsp;</td>
            <td>4-11 &nbsp;</td>
            <td>4-12 &nbsp;</td>
          </tr>
          <tr>
            <td>5-1 &nbsp;</td>
            <td>5-2 &nbsp;</td>
            <td>5-3 &nbsp;</td>
            <td>5-4 &nbsp;</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="Player2_div">
      <b>
        <p class="Player2_name">----- PLAYER 2 -----</p>
      </b> <br>
      <table id="player1_cards" border="1">
        <tbody>
          <tr>
            <td>1-1 &nbsp;</td>
            <td>1-2 &nbsp;</td>
            <td>1-3 &nbsp;</td>
            <td>1-4 &nbsp;</td>
            <td>1-5 &nbsp;</td>
            <td>1-6 &nbsp;</td>
            <td>1-7 &nbsp;</td>
            <td>1-8 &nbsp;</td>
            <td>1-9 &nbsp;</td>
            <td>1-10 &nbsp;</td>
            <td>1-11 &nbsp;</td>
            <td>1-12 &nbsp;</td>
          </tr>
          <tr>
            <td>2-1 &nbsp;</td>
            <td>2-2 &nbsp;</td>
            <td>2-3 &nbsp;</td>
            <td>2-4 &nbsp;</td>
            <td>2-5 &nbsp;</td>
            <td>2-6 &nbsp;</td>
            <td>2-7 &nbsp;</td>
            <td>2-8 &nbsp;</td>
            <td>2-9 &nbsp;</td>
            <td>2-10 &nbsp;</td>
            <td>2-11 &nbsp;</td>
            <td>2-12 &nbsp;</td>
          </tr>
          <tr>
            <td>3-1 &nbsp;</td>
            <td>3-2 &nbsp;</td>
            <td>3-3 &nbsp;</td>
            <td>3-4 &nbsp;</td>
            <td>3-5 &nbsp;</td>
            <td>3-6 &nbsp;</td>
            <td>3-7 &nbsp;</td>
            <td>3-8 &nbsp;</td>
            <td>3-9 &nbsp;</td>
            <td>3-10 &nbsp;</td>
            <td>3-11 &nbsp;</td>
            <td>3-12 &nbsp;</td>
          </tr>
          <tr>
            <td>4-1 &nbsp;</td>
            <td>4-2 &nbsp;</td>
            <td>4-3 &nbsp;</td>
            <td>4-4 &nbsp;</td>
            <td>4-5 &nbsp;</td>
            <td>4-6 &nbsp;</td>
            <td>4-7 &nbsp;</td>
            <td>4-8 &nbsp;</td>
            <td>4-9 &nbsp;</td>
            <td>4-10 &nbsp;</td>
            <td>4-11 &nbsp;</td>
            <td>4-12 &nbsp;</td>
          </tr>
          <tr>
            <td>5-1 &nbsp;</td>
            <td>5-2 &nbsp;</td>
            <td>5-3 &nbsp;</td>
            <td>5-4 &nbsp;</td>
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
      <div class="shuffle_deck_div">
        <img id="shuffle_card_img" src="shuffle_card.png" alt="card_back">
      </div>
      <input type="button" id="shuffle_btn" name="" value="SHUFFLE" onclick="shuffle_deck()">
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

  <container id="shuffled_deck">

  </container>


</body>

</html>
