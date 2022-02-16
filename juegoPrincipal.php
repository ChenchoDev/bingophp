<?php
include_once './carton.php';
include_once './linea.php';
include_once './juego.php';
session_start();
?>            
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
        <title>Bingo</title>
        <style>
            section{	display:flex;}
            div{border:5px solid white;
                padding:15px;
                font-size: 20px;
            }	
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
            #cantaLinea{	color:blue;
                         font-weight: bold;
            }
            #elBingo{ font-weight: bold; }
            #lasBolas{	
                border:1 black ;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: space-evenly;
                padding: 2px;
                margin:5px;

            }
            #bola{ 
                display:flex;
                width: 60px;
                height: 60px;
                border-radius: 70px;
                color:white;
                font-weight: bold;
                background: linear-gradient(top,  rgba(187,187,187,1) 0%,rgba(119,119,119,1) 99%);
                box-shadow: inset 0 -5px 15px rgba(255,255,255,0.4), 
                    inset -2px -1px 40px rgba(0,0,0,0.4), 
                    0 0 1px #000;
                align-items: center;
                justify-content: center;
                background-image: -moz-radial-gradient(36px 10px 45deg, circle cover, rgba(255,255,255,1), rgba(255,255,255,0) 20%, rgba(255,255,255,0) 50%, rgba(0,0,0,1) 80%);
                background-image: -webkit-gradient(radial,36 36, 72, 36 10, 0, from(rgba(0,0,0,1)), to(rgba(255,255,255,1)), color-stop(0.85, rgba(255,255,255,0)), color-stop(0.4, rgba(0,0,0,1)));

            }
            .banner{
                align-items: center;
                max-width: 55%;
            }
            .verti {
                writing-mode: vertical-lr;
                transform: rotate(180deg);
            }

        </style>

    </head>
    <body>
        <div class="container mx-auto d-flex row align-items-center  justify-content-center">
            <div class="col-auto d-flex row align-items-center  justify-content-center">
                <img class="banner d-flex justify-content-center " src="img/letras.png" alt="alt"/> 

            </div>


        </div >
        <div class=" container row mx-auto">
            
            <?php
//------

            $juego = $_SESSION['miJuego']; //Traemos la session iniciada en el la pagina princiapl
            if (isset($_REQUEST['accion'])) {
                $laAccion = $_REQUEST['accion'];
                if ($laAccion == 'Sacar Bola') {
                    $juego->bola();
                } else if ($laAccion == 'Reiniciar Juego') {
                    session_destroy();
                    unset($_SESSION);
                    header('Location:bingo.php');
                }
//echo $laAccion;
            }

//mostrar bolas
            $lasBolas = $juego->getBolas();
            $losCartones = $juego->getCartones();

            echo '<span class="fs-2 fw-bold">BOLAS</span> <br>';
            $htmlBolas = '<section id="lasBolas" class="rounded-circle">';
            for ($c = 0; $c < sizeof($lasBolas); $c++) {
                if ($lasBolas[$c] < 10) {

                    $htmlBolas .= '<div id="bola" class=" bg-secondary  ">0' . $lasBolas[$c] . '</div>';
                } else {
                    $htmlBolas .= '<div id="bola" class=" bg-secondary   ">' . $lasBolas[$c] . '</div>';
                }
            }
            $htmlBolas .= '</section>';

            echo $htmlBolas;
            echo '<br>';
            echo $juego->mostrar3Cartones();
            echo '<form action="juegoPrincipal.php" method="POST">';
            if ($losCartones[0]->marcar(102) != 3 &&
                    $losCartones[1]->marcar(102) != 3 &&
                    $losCartones[2]->marcar(102) != 3) {
                echo '<br><center><input type="submit" name="accion" value="Sacar Bola" class="btn btn-outline-primary fs-3 fw-bold"></center>';
                echo '<br><center><input type="submit" name="accion" value="Reiniciar Juego" class="btn btn-outline-warning fs-5 fw-bold"></center>';
            } else {
                echo '<br><center><input type="submit" name="accion" value="Reiniciar Juego" class="btn btn-outline-success fs-3 fw-bold"></center>';
            }
            echo '</form>';
            ?>
            
</div>
    </body>
    <footer class="text-dark fst-italic fw-bold font-monospace"><center><i>Creado por Fulgencio Marín Talavera&COPY; para DWES</i></center></footer>
</html>

