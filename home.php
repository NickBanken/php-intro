<?php

$normalArray = array('Jason','Freddy','Michael');

$AssocArr = array(
  "Alcohol" => array("beer","Wine"),
  "Soda" => array("Sprite","Coca cola")
);

class strawberry{
  var $weight = 12;
  var $color = 'red';
};

$fruit = new strawberry;







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

  print_r($fruit);
  echo '<pre>'.print_r($normalArray,true).'</br>'.print_r($AssocArr,true).'</br>'.print_r($fruit,true).'</br>'.'</pre>';
?>