<?php
include 'class.php';
session_start();


//                      CREATION OF ARRAY,ASSOCIATIVE ARRAY AND AN OBJECT.
//===========================================================================================

//Normal array **NOTE you can also write [] instead of array()
$normalArray = array('Jason', 'Freddy', 'Michael');

//Associative Array 
$AssocArr = array(
  "Alcohol" => array("beer", "Wine"),
  "Soda" => array("Sprite", "Coca cola")
);

//Object class.
class strawberry
{
  var $weight = 12;
  var $color = 'red';
};

$fruit = new strawberry;

//--------------------------------------------------------------------------------------------
//                      PUSH ITEMS IN ALL ABOVE WITH A FOR LOOP
//--------------------------------------------------------------------------------------------

//loops through the given numbers of items.(array1,array2 and object).
for ($i = 0; $i <= 3; $i++) {
  if ($i === 1) {
    array_push($normalArray, 'Leatherface');
  } else if ($i === 2) {
    array_push($AssocArr["Alcohol"], 'Cider', 'Rum');
    array_push($AssocArr["Soda"], 'Fanta', 'Schweps');
    $AssocArr["Juice"] = array('Orange', 'apple');
  } else if ($i === 3) {
    $fruit->taste = 'sweet';
  }
}

//=============================================================================================
//                            STORE THE ARRAYS IN A SESSION
//=============================================================================================
$_SESSION['Normal array'] = $normalArray;
$_SESSION['Associative array'] = $AssocArr;
$_SESSION['Object'] = $fruit;



//----------------------------------------------------------------------------------------------
//              20% chance of changing an random item in a random array/objects.
//----------------------------------------------------------------------------------------------


//selects a number between 1 and 100, if below 20 we change something.
if (rand(1, 100 <= 20)) {
  switch (rand(1, 3)) {
    case 1:
      $normalArray[array_rand($normalArray)] = "replaced";
      $_SESSION['Normal array'] = $normalArray;
      break;

    case 2:
      //selects a random key
      $random = array_rand($AssocArr);
      //then uses the random key to select a random value inside the array and replace the word.
      $AssocArr[$random][array_rand($AssocArr[$random])] = "replaced";
      $_SESSION['Associative array'] = $AssocArr;
      // [rand(0,$AssocArr)] = "replaced";
      break;

    case 3:
      //convert the object back to an array
      $arrayfruit = (array)$fruit;
      //selects a random key
      $random = array_rand($arrayfruit);
      //then uses the random key to select a random value inside the array and replace the word.
      $arrayfruit[$random] = "replaced";
      //rewrite the $fruit variable with a brandnew object
      $fruit = new strawberry;
      //push the array valuables into the new object
      foreach ($arrayfruit as $key => $value) {
        $fruit->$key = $value;
      }

      $_SESSION['Object'] = $fruit;

      break;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Php-intro</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body class="bg-dark">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <form action="game.php" method="POST" class="m-5">
        <button type="submit" class="btn btn-primary m-5">Play</button>
      </form>
      <div class="table-responsive">
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">Array:</th>
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php foreach ($_SESSION['Normal array'] as $normalArray) {
                echo '<td class="text-center">' . $normalArray . '</td>';
              } ?>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="table-responsive">
        <table class="table table-dark table-bordered">
          <thead>
            <tr>
              <th scope="col-md-2">Associative array:</th>
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($_SESSION['Associative array'] as $key => $value) {
              echo '<tr><td><strong>' . $key . '</strong></td></rtr>';
              foreach ($_SESSION['Associative array'][$key] as $name) {
                echo '<td>' . $name . '</td>';
              }
            }
            ?>
            <td></td>
            <td></td>
          </tbody>
        </table>
      </div>
      <div class="table-responsive">
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">object:</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              $fruitArray = (array)$_SESSION['Object'];
              foreach ($fruitArray as $key => $fruit) {
                echo '<th class="text-center">' . $key . '</th>';
              } ?>
            <tr>
              <?php
              foreach ($fruitArray as $key => $fruit) {
                echo '<td class="text-center">' . $fruit . '</td>';
              } ?>
            </tr>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>