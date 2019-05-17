<?php
//load in the class file to create objects inside this page.
require_once 'class.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Black Jack</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
  <div class="container">
    <form action="" method="POST">
      <button type="submit" name="reset" class="btn btn-link">reset</button>
    </form>
    <div class="row d-flex justify-content-between m-5">
      <div class="playerScore d-flex align-items-center flex-column">
        <h3 class="text-center">This is your score: </h3>
        <h1><?php echo $_SESSION['player']->totalScore ?></h1>
      </div>
      <h1>Black Jack</h1>
      <div class="dealerScore d-flex align-items-center flex-column">
        <h2 class="text-center">Computer score: </h2>
        <h1><?php echo $_SESSION['dealer']->totalScore ?></h1>
      </div>
    </div>
    <div class="row d-flex justify-content-center mb-5">
      <h2><?php echo $_SESSION['message']; ?></h2>
      <form action="" method="POST">

      </form>
    </div>
    <div class="row d-flex justify-content-center ">
      <div class="player col-md-6 mt-5">

        <h3 class="text-center">Your current hand: <?php echo $_SESSION['player']->score ?></h3>
        <ul class="d-flex justify-content-center">
          <?php
          foreach ($_SESSION['playerHand'] as $playerhand) {
            echo '<li class="li m-4 text-center list-unstyled">' . $playerhand . '</li>';
          } ?>
        </ul>
      </div>
      <div class="computer col-md-6 mt-5">

        <h3 class="text-center">Computers current hand: <?php echo $_SESSION['dealer']->score ?></h3>
        <ul class="d-flex justify-content-center">
          <?php
          foreach ($_SESSION['dealerHand'] as $hand) {
            echo '<li class="li m-4 text-center list-unstyled">' . $hand . '</li>';
          } ?>
        </ul>
      </div>
    </div>
    <div class="row d-flex justify-content-center mt-5">
      <form action="" method="POST">
        <button type="submit" name="hit" class="btn  btn-primary">Hit</button>
        <button type="submit" name="stand" class="btn btn-warning">Stand</button>
        <button type="submit" name="surrender" class="btn btn-danger">Surrender</button>
      </form>
    </div>
    <div class="row d-flex justify-content-center mt-5">
      <form action="" method="POST">
        <?php echo $_SESSION['restart']; ?>
      </form>

    </div>
  </div>
</body>

</html>
<?php
//Early check if the player does not have blackjack already.

//If there is no SESSION, Create all needed SESSIONS.
if (!isset($_SESSION['player'])) {
  startSession();
}

//When won,lost or surrendered the player can press a restart button to go back to the page.

if (isset($_POST['restart'])) {
  restart();
  header('location: game.php');
}

if (isset($_POST['reset'])||isset($_POST['play'])) {
  startSession();
  header('location: game.php');
}

//If its the players turn, he can press the buttons.
if ($_SESSION['player']->turn === true) {
  //If the player selects hit, he will execute the objects method and a function that will display a message in our html.
  if (isset($_POST['hit'])) {
    $_SESSION['player']->hit();
    array_push($_SESSION['playerHand'], $_SESSION['player']->hand);
    gameLogicPlayer();
    header('location: game.php');
  }

  //If the player select stand, he will end his turns and a restart button will appear. The dealer place cards untill he reaches < 15.
  if (isset($_POST['stand'])) {
    $_SESSION['player']->stand();
    $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
    while ($_SESSION['dealer']->score < 15) {
      gameLogicDealer();
      array_push($_SESSION['dealerHand'], $_SESSION['dealer']->hand);
    }
    //Endresult prints out the outcome of the game. Did the player win?
    endresult();
    header('location: game.php');
  }
  //If the player somehow feels like he does not want to play anymore (For you could always stand...) The dealer automaticly wins, even if he goes above 21.
  if (isset($_POST['surrender'])) {
    $_SESSION['player']->surrender();
    while ($_SESSION['dealer']->score < 15) {
      gameLogicDealer();
      $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
      array_push($_SESSION['dealerHand'], $_SESSION['dealer']->hand);
      endresult();
    }
  }
}


//========================================================================================================
//                                   All functions down here
//========================================================================================================

//thegamelogic keeps track of the score of the player, the message at the top of the screen will change 
//according to tbe score the player has.

function gameLogicPlayer()
{


  switch (true) {
    case ($_SESSION['player']->score <= 10):
      $message = 'your turn!';
      $_SESSION['message'] = $message;
      break;

    case ($_SESSION['player']->score > 10 && $_SESSION['player']->score <= 16):
      $message = 'You are getting close now!';
      $_SESSION['message'] = $message;
      break;

    case ($_SESSION['player']->score > 16 && $_SESSION['player']->score < 21):
      $message = "I'd stop if I were you.";
      $_SESSION['message'] = $message;
      break;

    case ($_SESSION['player']->score === 21):
      $message = "BLACK JACK!";
      $_SESSION['player']->stand();
      $_SESSION['message'] = $message;
      $_SESSION['player']->totalScore += 1;
      $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
      break;

    case ($_SESSION['player']->score > 21):
      $_SESSION['player']->stand();
      $message = 'The Dealer wins!';
      $_SESSION['dealer']->totalScore += 1;
      $_SESSION['message'] = $message;
      $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
      break;
  }
}

//When the player stands or surrenders these messages will be send to the top.
function endresult()
{
  if ($_SESSION['player']->surr === true) {
    $message = 'You surrendered, The dealer wins!';
    $_SESSION['message'] = $message;
    $_SESSION['dealer']->totalScore += 1;
  } elseif ($_SESSION['dealer']->score >= $_SESSION['player']->score && $_SESSION['dealer']->score <= 21) {
    $message = 'The Dealer wins!';
    $_SESSION['message'] = $message;
    $_SESSION['dealer']->totalScore += 1;
  } elseif ($_SESSION['dealer']->score < $_SESSION['player']->score || $_SESSION['dealer']->score > 21) {
    $_SESSION['player']->totalScore += 1;
    $message = "You win!";
    $_SESSION['message'] = $message;
  }
}

function gameLogicDealer()
{
  $_SESSION['dealer']->hit();
  header('location: game.php');
}

function startSession()
{
  $player = new Blackjack;
  $dealer = new Blackjack;
  $_SESSION['player'] = $player;
  $_SESSION['dealer'] = $dealer;
  $_SESSION['message'] = $message;
  $_SESSION['playerHand'] = array();
  $_SESSION['dealerHand'] = array();
  $_SESSION['restart'] = '';
  $_SESSION['dealer']->hit();
  array_push($_SESSION['dealerHand'], $_SESSION['dealer']->hand);
  for ($i = 0; $i < 2; $i++) {
    $_SESSION['player']->hit();
    array_push($_SESSION['playerHand'], $_SESSION['player']->hand);
  };
  gameLogicPlayer();
}


function restart()
{
  $_SESSION['player']->score = 0;
  $_SESSION['dealer']->score = 0;
  $_SESSION['player']->turn = true;
  $_SESSION['player']->surr = false;

  $_SESSION['playerHand'] = array();
  $_SESSION['dealerHand'] = array();
  $_SESSION['restart'] = '';
  $_SESSION['dealer']->hit();
  array_push($_SESSION['dealerHand'], $_SESSION['dealer']->hand);
  for ($i = 0; $i < 2; $i++) {
    $_SESSION['player']->hit();
    array_push($_SESSION['playerHand'], $_SESSION['player']->hand);
  };
  gameLogicPlayer();
}

?>