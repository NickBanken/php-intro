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
        <ul class="d-flex justify-content-center">
          <?php
          foreach ($_SESSION['playerHand'] as $hand) {
            echo '<li class="li m-4 text-center list-unstyled">' . $hand . '</li>';
          } ?>
        </ul>
      </div>
      <div class="computer col-md-6 mt-5">
        <h3 class="text-center">Computer score: <?php echo $_SESSION['dealer']->score ?></h3>
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
if (!isset($_SESSION['player'])) {
  startSession();
}
if (isset($_POST['restart'])) {
  resetAll();
  header('location: game.php');
}
if ($_SESSION['player']->turn === true) {
  if (isset($_POST['hit'])) {
    $_SESSION['player']->hit();
    gameLogicPlayer();
    header('location: game.php');
  }
  if (isset($_POST['stand'])) {
    $_SESSION['player']->stand();
    $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
    while ($_SESSION['dealer']->score < 15) {
      gameLogicDealer();
      array_push($_SESSION['dealerHand'], $_SESSION['dealer']->hand);
    }
    endresult();
    header('location: game.php');
  }
  if (isset($_POST['surrender'])) {
    resetAll();
    header('location: game.php');
  }
}
//========================================================================================================
//                                   All functions down here
//========================================================================================================
function gameLogicPlayer()
{
  array_push($_SESSION['playerHand'], $_SESSION['player']->hand);
  switch (true) {
    case ($_SESSION['player']->score < 10):
      $message = 'what will you pick?';
      $_SESSION['message'] = $message;
      break;
    case ($_SESSION['player']->score > 10 && $_SESSION['player']->score < 16):
      $message = 'You are getting close now!';
      $_SESSION['message'] = $message;
      break;
    case ($_SESSION['player']->score > 16 && $_SESSION['player']->score < 20):
      $message = "I'd stop if I were you.";
      $_SESSION['message'] = $message;
      break;
    case ($_SESSION['player']->score === 21):
      $message = "BLACK JACK!";
      $_SESSION['player']->stand();
      $_SESSION['message'] = $message;
      $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
      break;
    case ($_SESSION['player']->score > 21):
      $_SESSION['player']->stand();
      $message = 'The Dealer wins!';
      $_SESSION['message'] = $message;
      $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
      break;
  }
}
function endresult()
{
  if ($_SESSION['dealer']->score >= $_SESSION['player']->score && $_SESSION['dealer']->score <= 21) {
    $message = 'The Dealer wins!';
    $_SESSION['message'] = $message;
    $_SESSION['restart'] = "<button type='submit' name='restart' class='btn btn-danger'>restart</button>";
  } elseif ($_SESSION['dealer']->score < $_SESSION['player']->score || $_SESSION['dealer']->score > 21) {
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
  $message = "your turn!";
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
}
function resetAll()
{
  session_destroy();
  session_start();
  startSession();
  header('location: game.php');
}
?>