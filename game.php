<?php
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
    <div class="row d-flex justify-content-center m-5">
      <h1>Black Jack</h1>
    </div>
    <div class="row d-flex justify-content-center mb-5">
      <h2><?php echo $_SESSION['message']; ?></h2>
      <form action="" method="POST">

      </form>
    </div>
    <div class="row d-flex justify-content-center ">
      <div class="player col-md-6 mt-5">
        <h3 class="text-center">This is your score: <?php echo $_SESSION['player']->score ?></h3>
      </div>
      <div class="computer col-md-6 mt-5">
        <h3 class="text-center">Computer score: <?php echo $_SESSION['dealer']->score ?></h3>
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

if (!isset($_SESSION['player'])) {
  startSession();
}

if (isset($_POST['restart'])) {
  resetAll();
  $_SESSION['turn'] = true;
  header('location: game.php');
}

var_dump($_SESSION['player']->turn);
var_dump($_SESSION['dealer']->score);

if ($_SESSION['player']->turn === true) {
  playerTurn();
} elseif ($_SESSION['player']->turn === false) { }

function playerTurn()
{
  $player = $_SESSION['player'];
  if (isset($_POST['hit'])) {
    $player->hit();
    gameLogicPlayer();
    header('location: game.php');
  }
  if (isset($_POST['stand'])) {
    $_SESSION['player']->stand();
    $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
    while ($_SESSION['dealer']->score < 15) {
      gameLogicDealer();
    }
    endresult();
    header('location: game.php');
  }
  if (isset($_POST['surrender'])) {
    resetAll();
    header('location: game.php');
  }
}



function gameLogicPlayer()
{
  $dealer = $_SESSION['dealer'];
  $player = $_SESSION['player'];
  switch (true) {
    case ($player->score < 10):
      $message = 'what will you pick?';
      $_SESSION['message'] = $message;
      break;

    case ($player->score > 10 && $player->score < 16):
      $message = 'You are getting close now!';
      $_SESSION['message'] = $message;
      break;

    case ($player->score > 16 && $player->score < 20):
      $message = "I'd stop if I were you.";
      $_SESSION['message'] = $message;
      break;

    case ($player->score === 21):
      $message = "BLACK JACK!";
      $_SESSION['player']->stand();
      $_SESSION['message'] = $message;
      $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
      break;

    case ($player->score > 21):
      $_SESSION['player']->stand();
      $message = 'The Dealer wins!';
      $_SESSION['message'] = $message;
      $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
      break;
  }
}

function endresult()
{
  $dealer = $_SESSION['dealer'];
  $player = $_SESSION['player'];
  if ($dealer->score >= $player->score && $dealer->score <= 21) {
    $message = 'The Dealer wins!';
    $_SESSION['message'] = $message;
    $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
  } elseif ($dealer->score < $player->score) {
    $message = "You win!";
    $_SESSION['message'] = $message;
  }
}

function gameLogicDealer()
{
  switch (true) {
    case ($_SESSION['dealer']->score < 15):
      $_SESSION['dealer']->hit();
      header('location: game.php');

    case ($_SESSION['dealer']->score > 15):
  }
}


function startSession()
{
  $player = new Blackjack;
  $dealer = new Blackjack;
  $message = "your turn!";
  $_SESSION['player'] = $player;
  $_SESSION['dealer'] = $dealer;

  $_SESSION['message'] = $message;
  $_SESSION['restart'] = '';
}

function resetAll()
{
  session_destroy();
  session_start();
  startSession();
  header('location: game.php');
}
?>