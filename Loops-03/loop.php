<?php 
$array = [
    ["tv-show" => "Game Of Thrones", "rating" => 5],
    ["tv-show" => "Rick and Morty", "rating" => 4.5],
    ["tv-show" => "Stranger things", "rating" => 5],
    ["tv-show" => "Spongebob Squarepants", "rating" => 3],
    ["tv-show" => "Totally Spies!", "rating" => 3],
    ["tv-show" => "Are We There Yet?", "rating" => 3.5],
    ["tv-show" => "Adventure Time", "rating" => 5],
    ["tv-show" => "South Park", "rating" => 4]
];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tv show rating</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <div class="container-fluid">
        <div class="row  d-flex justify-content-center">
            <h1 class="mt-5 text-white"><strong>Tv-shows rating</strong></h1>
        </div>
        <div class="row d-flex justify-content-center"> 
            <table class="table table-hover table-striped table-bordered table-dark w-50 m-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($array as $row):?>
                        <tr>
                        <td><a href="https://google.com/search?q=tv+show+<?php echo $row['tv-show']?>" target="_blank"><?=$row['tv-show'];?></a></td>
                        
                        <td><?php if(is_int($row['rating'])){
                            for($i=0; $i<$row['rating'];$i++){
                                echo '<i class="fas fa-star">'.'</i>';
                            }
                        }
                        else{
                            for($i=1; $i<$row['rating'];$i++){
                                echo '<i class="fas fa-star">'.'</i>';
                            }
                            echo '<i class="fas fa-star-half-alt">'.'</i>';
                        }
                         ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>      
        </div>    
    </div>
    
</body>
</html>