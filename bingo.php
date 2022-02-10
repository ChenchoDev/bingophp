
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Bingo</title>
        <style>
            section{	display:flex;}

            #carton{
                display:flex;
                flex-direction: column;
            }
            #tresCartones{
                display: flex;
                justify-content: space-around;
            }
            b{
                color:red;
            }
            .container{
                margin:0 auto;
            }
        </style>

    </head>
    <body>
        <div class="container d-flex justify-content-center">

            <div class="container d-flex align-items-center justify-content-center">
                <?php
                echo '<img src="bingo.jpg" alt="alt" class="w-50"/>';
                echo '<div class="row-6 align-items-center justify-content-center"  >';
                echo '<form action="JuegoPrincipal.php" ' .
                ' method="POST">';

                echo '<br><input type="submit" name="jugar" value="Jugar" class="btn btn-info  btn-lg fs-1 fw-bold  position-absolute top-60 start-50 translate-middle ">';
                echo '</form>';
                echo '</div>';
                ?>

            </div>


        </div> 
    </body>
    <?php
    session_start();
    
    include_once'carton.php';
    include_once 'linea.php';
    include_once 'juego.php';

    

    $miJuego = new juego();
    $_SESSION['miJuego'] = $miJuego;
    ?>


</html>

