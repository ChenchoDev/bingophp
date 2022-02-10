<?php
include_once 'carton.php';
include_once 'linea.php';
include_once 'juego.php';

?>   
<?php

//CLASE JUEGO
class juego {

//atributos
    private $cartones = array();
    private $bolas = array();
    private $lineaCantada;

//Constructor
    public function __construct() {
        $carton1 = new carton();
        $carton2 = new carton();
        $carton3 = new carton();
        array_push($this->cartones, $carton1, $carton2, $carton3);
        $this->lineaCantada = FALSE;
    }

    public function getCartones() {
        return $this->cartones;
    }

    public function getBolas() {
        return $this->bolas;
    }

    public function getLineaCantada() {
        return $this->lineaCantada;
    }

    public function setCartones($cartones): void {
        $this->cartones = $cartones;
    }

    public function setBolas($bolas): void {
        $this->bolas = $bolas;
    }

    public function setLineaCantada($lineaCantada): void {
        $this->lineaCantada = $lineaCantada;
    }





//cierre de constructor
//--------

    public function bola() {
        if (sizeof($this->bolas) < 90) {
            $numeroAzar = rand(1, 90);
            while (in_array($numeroAzar, $this->bolas) == TRUE) {
                $numeroAzar = rand(1, 90);
            }
            array_push($this->bolas,
                    $numeroAzar);
            for ($i = 0; $i < 3; $i++) {
                if ($this->cartones[$i]->marcar($numeroAzar) == 1 && //Si existe una lines entera marcada, salta el aviso de LINEA
                        $this->lineaCantada == FALSE) {
                    $this->lineaCantada = TRUE;
                    echo '<div id="cantaLinea" class="alert alert-primary fs-2 fw-bold">LINEA EN CARTÓN ' .($i + 1) . '</div>';
                   
                } else if ($this->
                        cartones[$i]->marcar($numeroAzar) == 3) {//Si son tres las lineas marcada, salta el aviso BINGO
                     
                    echo '<div id="elBingo" class="alert alert-success fs-2 fw-bold"> BINGO EN CARTON ' .
                    ($i + 1) . '</div>';
                }
            }//cierre de for
        }
    }

//cierre de bola
//--------

    public function mostrar3Cartones() {
        $r = '<section id="tresCartones">';
        for ($i = 0; $i < 3; $i++) {
            
            $r .= $this->cartones[$i]->mostrarCarton();
        }
        $r = $r . '</section>';
        return $r;
    }

//cierre mostrar3Cartones
}

//cierre juego
?>