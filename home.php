<?php
session_start();

//Normal array
$normalArray = array('Jason','Freddy','Michael');

//Associative Array
$AssocArr = array(
  "Alcohol" => array("beer","Wine"),
  "Soda" => array("Sprite","Coca cola")
);

//Object class.
class strawberry{
  var $weight = 12;
  var $color = 'red';
};

$fruit = new strawberry;


//loops through the given numbers of items.(array1,array2 and object).
for($i = 0; $i <= 3; $i++){
  if($i === 1){
    array_push($normalArray,'Leatherface');
  }
  else if($i === 2){
    array_push($AssocArr["Alcohol"], 'Cider', 'Rum');
    array_push($AssocArr["Soda"], 'Fanta', 'Schweps');
    $AssocArr["Juice"]= array('Orange', 'apple');
    
  }
  else if($i === 3){
    $fruit->taste = 'sweet';
  }
}

$_SESSION['Normal array'] = $normalArray;
$_SESSION['Associative array '] = $AssocArr;
$_SESSION['Object'] = $fruit;


//selects a number between 1 and 100, if below 20 we change something.
if(rand(1,100<=20)){
  switch(rand(1,3)){
    case 1:
    $normalArray[array_rand($normalArray)] = "replaced";
    $_SESSION['Normal array'] = $normalArray;
    break;

    case 2:
    //selects a random key
    $random = array_rand($AssocArr);
    //then uses the random key to select a random value inside the array and replace the word.
    $AssocArr[$random][array_rand($AssocArr[$random])] = "replaced";
    $_SESSION['Associative array '] = $AssocArr;
    // [rand(0,$AssocArr)] = "replaced";
    break;

    case 3:
    //convert the object back to an array
    $arrayfruit = (array) $fruit;
    //selects a random key
    $random = array_rand($arrayfruit);
    //then uses the random key to select a random value inside the array and replace the word.
    $arrayfruit[$random] = "replaced";
    //rewrite the $fruit variable with a brandnew object
    $fruit = new strawberry;
    //push the array valuables into the new object
    foreach ($arrayfruit as $key => $value)
    {
        $fruit->$key = $value;
    }
    
    $_SESSION['Object'] = $fruit;

    break;


  }
}

  echo'<br><pre>'.var_dump($_SESSION)."</pre>";
  echo '<pre>'.print_r($normalArray,true).'</br>'.print_r($AssocArr,true).'</br>'.print_r($fruit,true).'</br>'.'</pre>';
  session_destroy();
?>