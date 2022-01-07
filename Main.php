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

      <div>
        <select id="LogIn_selected_player_side">
          <option value="1">Player - 1</option>
          <option value="2">Player - 2</option>
        </select>
      </div>

      <button id="LogIn-btn" class="btn" onclick="login_to_game()">E N T E R</button>
    </div>
  </div>


  <!--Main Page SECTION -->
  <div class="Game_div">
    <div class="Player1_div">
      <b>
        <p class="Player1_name"> PLAYER 1 </p>
      </b> <br>

      <table id="player1_cards" border="1">
        <tbody>
          <tr>
            <td id="c1-1" onclick="card_picked('1-0')"></td>
            <td id="c1-2" onclick="card_picked('1-1')"></td>
            <td id="c1-3" onclick="card_picked('1-2')"></td>
            <td id="c1-4" onclick="card_picked('1-3')"></td>
            <td id="c1-5" onclick="card_picked('1-4')"></td>
            <td id="c1-6" onclick="card_picked('1-5')"></td>
            <td id="c1-7" onclick="card_picked('1-6')"></td>
            <td id="c1-8" onclick="card_picked('1-7')"></td>
            <td id="c1-9" onclick="card_picked('1-8')"></td>
            <td id="c1-10" onclick="card_picked('1-9')"></td>
            <td id="c1-11" onclick="card_picked('1-10')"></td>
            <td id="c1-12" onclick="card_picked('1-11')"></td>
          </tr>
          <tr>
            <td id="c1-13" onclick="card_picked('1-12')"></td>
            <td id="c1-14" onclick="card_picked('1-13')"></td>
            <td id="c1-15" onclick="card_picked('1-14')"></td>
            <td id="c1-16" onclick="card_picked('1-15')"></td>
            <td id="c1-17" onclick="card_picked('1-16')"></td>
            <td id="c1-18" onclick="card_picked('1-17')"></td>
            <td id="c1-19" onclick="card_picked('1-18')"></td>
            <td id="c1-20" onclick="card_picked('1-19')"></td>
            <td id="c1-21" onclick="card_picked('1-20')"></td>
            <td id="c1-22" onclick="card_picked('1-21')"></td>
            <td id="c1-23" onclick="card_picked('1-22')"></td>
            <td id="c1-24" onclick="card_picked('1-23')"></td>
          </tr>
          <tr>
            <td id="c1-25" onclick="card_picked('1-24')"></td>
            <td id="c1-26" onclick="card_picked('1-25')"></td>
            <td id="c1-27" onclick="card_picked('1-26')"></td>
            <td id="c1-28" onclick="card_picked('1-27')"></td>
            <td id="c1-29" onclick="card_picked('1-28')"></td>
            <td id="c1-30" onclick="card_picked('1-29')"></td>
            <td id="c1-31" onclick="card_picked('1-30')"></td>
            <td id="c1-32" onclick="card_picked('1-31')"></td>
            <td id="c1-33" onclick="card_picked('1-32')"></td>
            <td id="c1-34" onclick="card_picked('1-33')"></td>
            <td id="c1-35" onclick="card_picked('1-34')"></td>
            <td id="c1-36" onclick="card_picked('1-35')"></td>
          </tr>
          <tr>
            <td id="c1-37" onclick="card_picked('1-36')"></td>
            <td id="c1-38" onclick="card_picked('1-37')"></td>
            <td id="c1-39" onclick="card_picked('1-38')"></td>
            <td id="c1-40" onclick="card_picked('1-39')"></td>
            <td id="c1-41" onclick="card_picked('1-40')"></td>
            <td id="c1-42" onclick="card_picked('1-41')"></td>
            <td id="c1-43" onclick="card_picked('1-42')"></td>
            <td id="c1-44" onclick="card_picked('1-43')"></td>
            <td id="c1-45" onclick="card_picked('1-44')"></td>
            <td id="c1-46" onclick="card_picked('1-45')"></td>
            <td id="c1-47" onclick="card_picked('1-46')"></td>
            <td id="c1-48" onclick="card_picked('1-47')"></td>
          </tr>
          <tr>
            <td id="c1-49" onclick="card_picked('1-48')"></td>
            <td id="c1-50" onclick="card_picked('1-49')"></td>
            <td id="c1-51" onclick="card_picked('1-50')"></td>
            <td id="c1-52" onclick="card_picked('1-51')"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="Player2_div">
      <b>
        <p class="Player2_name"> PLAYER 2 </p>
      </b> <br>
      <table id="player2_cards" border="1">
        <tbody>
          <tr>
            <td id="c2-1" onclick="card_picked('2-0')"></td>
            <td id="c2-2" onclick="card_picked('2-1')"></td>
            <td id="c2-3" onclick="card_picked('2-2')"></td>
            <td id="c2-4" onclick="card_picked('2-3')"></td>
            <td id="c2-5" onclick="card_picked('2-4')"></td>
            <td id="c2-6" onclick="card_picked('2-5')"></td>
            <td id="c2-7" onclick="card_picked('2-6')"></td>
            <td id="c2-8" onclick="card_picked('2-7')"></td>
            <td id="c2-9" onclick="card_picked('2-8')"></td>
            <td id="c2-10" onclick="card_picked('2-9')"></td>
            <td id="c2-11" onclick="card_picked('2-10')"></td>
            <td id="c2-12" onclick="card_picked('2-11')"></td>
          </tr>
          <tr>
            <td id="c2-13" onclick="card_picked('2-12')"></td>
            <td id="c2-14" onclick="card_picked('2-13')"></td>
            <td id="c2-15" onclick="card_picked('2-14')"></td>
            <td id="c2-16" onclick="card_picked('2-15')"></td>
            <td id="c2-17" onclick="card_picked('2-16')"></td>
            <td id="c2-18" onclick="card_picked('2-17')"></td>
            <td id="c2-19" onclick="card_picked('2-18')"></td>
            <td id="c2-20" onclick="card_picked('2-19')"></td>
            <td id="c2-21" onclick="card_picked('2-20')"></td>
            <td id="c2-22" onclick="card_picked('2-21')"></td>
            <td id="c2-23" onclick="card_picked('2-22')"></td>
            <td id="c2-24" onclick="card_picked('2-23')"></td>
          </tr>
          <tr>
            <td id="c2-25" onclick="card_picked('2-24')"></td>
            <td id="c2-26" onclick="card_picked('2-25')"></td>
            <td id="c2-27" onclick="card_picked('2-26')"></td>
            <td id="c2-28" onclick="card_picked('2-27')"></td>
            <td id="c2-29" onclick="card_picked('2-28')"></td>
            <td id="c2-30" onclick="card_picked('2-29')"></td>
            <td id="c2-31" onclick="card_picked('2-30')"></td>
            <td id="c2-32" onclick="card_picked('2-31')"></td>
            <td id="c2-33" onclick="card_picked('2-32')"></td>
            <td id="c2-34" onclick="card_picked('2-33')"></td>
            <td id="c2-35" onclick="card_picked('2-34')"></td>
            <td id="c2-36" onclick="card_picked('2-35')"></td>
          </tr>
          <tr>
            <td id="c2-37" onclick="card_picked('2-36')"></td>
            <td id="c2-38" onclick="card_picked('2-37')"></td>
            <td id="c2-39" onclick="card_picked('2-38')"></td>
            <td id="c2-40" onclick="card_picked('2-39')"></td>
            <td id="c2-41" onclick="card_picked('2-40')"></td>
            <td id="c2-42" onclick="card_picked('2-41')"></td>
            <td id="c2-43" onclick="card_picked('2-42')"></td>
            <td id="c2-44" onclick="card_picked('2-43')"></td>
            <td id="c2-45" onclick="card_picked('2-44')"></td>
            <td id="c2-46" onclick="card_picked('2-45')"></td>
            <td id="c2-47" onclick="card_picked('2-46')"></td>
            <td id="c2-48" onclick="card_picked('2-47')"></td>
          </tr>
          <tr>
            <td id="c2-49" onclick="card_picked('2-48')"></td>
            <td id="c2-50" onclick="card_picked('2-49')"></td>
            <td id="c2-51" onclick="card_picked('2-50')"></td>
            <td id="c2-52" onclick="card_picked('2-51')"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!--CARD SHUFFLE SECTION-->
  <div class="Card_OnTop_div">    </div>

  <div class="Game_Details_div">
    <!--CARD SHUFFLE SECTION-->
    <div class="Card_Shuffle_div">
      <div class="Card_Shuffle_img_div">
        <img id="shuffle_card_img" src="extras/shuffle_card.png" alt="card_back">
      </div>
      <div class="Card_Shuffle_buttons_div">
        <!-- <input type="button" id="shuffle_cards_btn" name="" value="SHUFFLE" onclick="shuffle_deck()"> -->
        <!-- <input type="button" id="clear_board_btn" name="" value="RESET" onclick="reset_everything()"  > -->
      </div>

    </div>

    <div class="div_players_turn_txt">
      <h2 class="players_turn_txt"></h2>
    </div>

    <!--RULES SECTION-->
    <div class="Rules_div">
      <button id="Rules-btn" type="button" onclick="ShowRules()">Show Rules</button>
      <div id="Rules_box" style="display: none;">
        <b>⥤ RULES ⥢</b> <br>
        <p><b>Στόχος :</b>
            Ο στόχος του παιχνιδιού είναι να μείνεις χωρίς φύλλα στο χέρι. Αυτός που θα μείνει με ένα φύλλο είναι ο χαμένος.<br><br>
           <b>Διαδικασία παιχνιδιού :</b>
             Ο πρώτος παίχτης τραβάει ένα φύλλο από αυτόν που κάθετε απέναντί του, αν κάνει ζευγάρι το νέο χαρτί με κάποια από τα δικά του τότε τα ρίχνει,
             αλλιώς τα κρατάει και συνεχίζει ο αντίπαλος. Όποιος ζευγαρώσει όλα τα φύλλα του βγαίνει από το παιχνίδι. Όποιος μείνει τελευταίος
             με τον Ρήγα Μπαστούνι (τον Μουτζούρη) στο χέρι του είναι ο χαμένος, και οι υπόλοιποι παίχτες αποφασίζουν την ποινή του.
        </p>
      </div>
    </div>
  </div>


</body>

</html>
