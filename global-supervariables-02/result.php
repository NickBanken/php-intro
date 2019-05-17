<?php session_start();

if(isset($_POST['send'])){
    $movies = ['movies'=>[$_POST['movie']]];
}

if(!isset($_GET['country'])){
    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<ul class="nav nav-tabs">
  <li><a data-toggle="tab" href="#menu1">$_GET</a></li>
  <li><a data-toggle="tab" href="#menu2">$_POST</a></li>
</ul>

<div class="tab-content">
  <div id="menu1" class="tab-pane fade in active">
  <h3>$_GET</h3>
    <ul>
    <?php
    $country = $_GET;
    foreach($country as $key => $value) {
        if($key !='send')
     echo '<li>'.$key.': '.$value.'</li>';} ?>
    </ul>
  </div>
  <div id="menu2" class="tab-pane fade">
    <h3>$_POST</h3>
        <ul>
            <h3>movies</h3>
            <?php
            $movie = $_POST['movie'];
            

            foreach($movie as $key => $value) {
             echo '<li>'.$key.': '.$value.'</li>';} ?>
            
        </ul>
        <ul>
        <h3>series</h3>
            <?php $serie = $_POST['serie'];
            foreach($serie as $key => $value) {
                echo '<li>'.$key.': '.$value.'</li>';} ?>
        </ul>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>