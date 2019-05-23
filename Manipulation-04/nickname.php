<?php 
    if(isset($_POST['send'])){
        $username = $_POST['name'];

        $reversed = strrev($username);

        $UPPERCASE = strtoupper($reversed);

        $rereversed = strrev($UPPERCASE);

        $lines = '--'.$rereversed.'--';

        $cross = 'x'.$lines;

        $randomChar = str_split('abcdefghijklmnopqrstuvwxyz'
        .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
        .'0123456789!@#$%^&*()');
        shuffle($randomChar);
        foreach(array_rand($randomChar,mt_rand(2,4)) as $char){
            $rand .= $randomChar[$char];
        }
        $randomLetters = $rand.$cross;

        $addBrackets = '['.$rand.']'.$cross;

        $splitted = str_split($addBrackets);

        for ($i=0,$c=strlen($addBrackets);$i<$c;$i++){
          $random = rand(1,3);
          if($random === 3){
            if(ctype_lower($splitted[$i])){  
                $splitted[$i] = strtoupper($splitted[$i]);        
             }
             else if(ctype_upper($splitted[$i])){
                $splitted[$i] = strtolower($splitted[$i]);
             }   
            }
            $complete .= $splitted[$i]; 
        }


        

        
        
        function generateNameGradient(){


        $color = ['red' => rand(0,255), 'green' => rand(0,255), 'blue'=> rand(0,255)];
        
        $decRed = false;
        
        $decGreen = false;
    
        $decBlue = false;

        $power = 8;

        global $complete;

        $splitted = str_split($complete);

            //for loop to generate a name
            for ($i=0,$c=strlen($complete);$i<$c;$i++){
                echo '<span style="color:rgb('.$color['red'].','.$color['green'].','.$color['blue'].')">'.$splitted[$i]."</span>";
    
    
                if($color['red'] <= 230 && $decRed === false){
                    $color['red'] +=$power;
                    
                    if($color['red'] >= 230){
                        $decRed = true;
                    }
                }else if($color['red'] >= 0 && $decRed === true){
                    $color['red'] -=$power;
                    if($color['red'] <= 0){
                        $decRed = false;
                    }
                }
    
    
                if($color['green'] <= 230 && $decGreen === false){
                    $color['green'] +=$power;
                    
                    if($color['green'] >= 230){
                        $decGreen = true;
                    }
                }else if($color['green'] >= 50 && $decGreen === true){
                    $color['green'] -=$power;
                    if($color['green'] <= 50){
                        $decGreen = false;
                    }
                }
    
    
                if($color['blue'] <= 230 && $decBlue === false){
                    $color['blue'] +=$power;
                    
                    if($color['blue'] >= 230){
                        $decBlue = true;
                    }
                }else if($color['blue'] >= 50 && $decBlue === true){
                    $color['blue'] -=$power;
                    if($color['blue'] <= 50){
                        $decBlue = false;
                    }
                }
            }

        }
       

    }


    
        

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Name Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="card bg-dark w-50 m-5">
                <div class="card-body">
                <h1 class="m-3 text-center text-white font-weight-bold">Cool NickName Generator</h1>
                    <form action="" method="POST">
                        <div class="form-group text-white font-weight-bold">
                           
                            <input type="text" class="form-control" pattern=".{5,}" title="Minmimum 5 letters or numbers." name='name' placeholder="Enter Name" required>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" name="send" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body text-white colors">
                    <h5 class="card-title">Turn the name around</h5>
                    <p class="card-tex colors"><?php echo $reversed;?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-white">
                    <h5 class="card-title">Turn the name in uppercases</h5>
                    <p class="card-text"><?php echo $UPPERCASE;?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-white">
                    <h5 class="card-title">Reverse the reverse (<?php echo $reversed?>) again.</h5>
                    <p class="card-text"><?php echo $rereversed;?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-white">
                    <h5 class="card-title">Add -- to the start and the end of the name.</h5>
                    <p class="card-text"><?php echo $lines;?></p>
                    </div>
                </div>
            </div>
            <div class="card-deck mt-5">
                <div class="card">
                    <div class="card-body text-white">
                    <h5 class="card-title">Add x to the start and the end of the name.</h5>
                    <p class="card-text"><?php echo $cross;?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-white">
                    <h5 class="card-title">Add 2-4 random letters to the beginning of the name</h5>
                    <p class="card-text"><?php echo $randomLetters;?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-white">
                    <h5 class="card-title">Add [] so that the random letters are between them</h5>
                    <p class="card-text"><?php echo $addBrackets;?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-white">
                    <h5 class="card-title">Randomizely make the letters uppercased.</h5>
                    <p class="card-text"><?php echo $complete;?></p>
                    </div>
                </div>
            </div>

            <div class="card w-100">
                    <div class="card-body text-white text-center">
                    <h5 class="card-title">Create a gradient map for each letter.</h5>
                    <p class="card-text"><?php generateNameGradient();?></p>
                    </div>
                </div>

        </div>
    </div>
</body>
</html>

