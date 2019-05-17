<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Super Globals - Setup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
    <?php $country = $_GET;

    $country = preg_replace('/\s+/', '+', $country);

    
    ?>
    <div class="container">
        <form action="result.php?<?php foreach($country as $key => $value) {
        if($key==='send'){
            echo "$key=$value";
        }else{
            echo "$key=$value&";}
        
      }; ?>" method="post">  
            <div class="row">
                <div class="col-md-12">
                    <h2>Movies</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row align-items-center">
                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">1</div>
                                </div>
                                <input type="text" name="movie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">2</div>
                                </div>
                                <input type="text" name="movie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">3</div>
                                </div>
                                <input type="text" name="movie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">4</div>
                                </div>
                                <input type="text" name="movie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">5</div>
                                </div>
                                <input type="text" name="movie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>   
                    </div> 
                    
                </div>   
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2>Series</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row align-items-center">
                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">1</div>
                                </div>
                                <input type="text" name="serie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">2</div>
                                </div>
                                <input type="text" name="serie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">3</div>
                                </div>
                                <input type="text" name="serie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">4</div>
                                </div>
                                <input type="text" name="serie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">5</div>
                                </div>
                                <input type="text" name="serie[]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Movie">
                            </div>
                        </div>   
                    </div> 
                    
                </div>   
            </div>
            <div class="row mt-5">
                <button  type="submit" name='send' id='Link' class="btn btn-primary">Submit</button>
            </div>
        </form>
    
        <form action="" method="GET">
            <div class="row mt-5">
                <div class="col-md-6">
                    <h2>Favourite country</h2>
                </div>
                <div class="col-md-6">
                    <h2>Worst movie</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">1</div>
                        </div>
                        <input type="text" name="country" class="form-control" id="country" placeholder="Best country">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">1</div>
                        </div>
                        <input type="text" name="bMovie" class="form-control" id="inlineFormInputGroupUsername" placeholder="Worst movie">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <button onclick="sendData()" type="submit" name='send' id='Link' class="btn btn-primary">Submit</button>
            </div>
                
            
            
        </form>
    </div>

</body>
</html>