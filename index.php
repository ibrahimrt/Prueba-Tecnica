
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body  class="container">
<form>
    <h1>Buscar Pelicula</h1>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nombre Película" name="Nombre" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
        <button type="submit" class="btn btn-outline-primary"> Enviar</button>
        </div>
    </div>   
    
</form>
    <?php if(ISSET($_GET['Nombre'])){        
        $searchTerm = $_GET['Nombre'];        
        $whiteEndSPc = rtrim($searchTerm);
        $searchTrim = str_replace(" ", "+",$whiteEndSPc);        
            if($searchTrim != ('' && '+')){
                $url      = "http://www.omdbapi.com/?apikey=6033f52&s=".$searchTrim."";
                $peticion =  file_get_contents($url);
                if($peticion){
                    $toJson = json_decode($peticion,true);
                    if(ISSET($toJson['Search'])){
                        $moviesD = $toJson['Search']; 
                        ?>
                        <div class="card-columns">
                            <?php  foreach($moviesD as $key => $value) {?>
                                <div class="card">
                                    <?php if($value['Poster'] != 'N/A'){?>
                                        <img src="<?php echo $value['Poster'];?>" class=" img-thumbnail mx-auto d-block" alt="...">
                                    <?php };?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $value['Title']; ?></h5>
                                        <p class="card-text"><small class="text-muted"><?php echo $value['Year']; ?></small></p>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    <?php }else{ ?>
                        <small class="text-danger">Película no encontrada! Por favor intente con otro Término de Búsqueda...</small>
                    <?php } ?>
                <?php }; ?>
            <?php }else{ ?>
                    <small class="text-danger">Película no encontrada! Por favor intente con otro Término de Búsqueda...</small>
            <?php } ?>
    <?php } ;?>
</body>
</html>

