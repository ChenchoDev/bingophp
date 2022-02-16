
<?php

//CLASE JUEGO
class juego {

//atributos
    private $cartones = array();
    private $bolas = array();
    private $lineaCantada;//Valor booleano

//Constructor
    public function __construct() { 
        $carton1 = new carton();//creamos 3 objetos de tipo carton
        $carton2 = new carton();
        $carton3 = new carton();
        array_push($this->cartones, $carton1, $carton2, $carton3);//Añadimos esos cartones al vector
        $this->lineaCantada = FALSE;//VAlor inicial del boolean FALSE
    }//cierre de constructor

    public function getBolas() {
        return $this->bolas;
    }

//---
    public function getCartones() {
        return $this->cartones;
    }

//----
    public function getLineaCantada() {
        return $this->lineaCantada;
    }

//------
    public function setBolas($nuevoArregloBolas) {
        $this->bolas = $nuevoArregloBolas;
    }

//-----
    public function setLineaCantada($nuevoValorLinea) {
        $this->lineaCantada = $nuevoValorLinea;
    }

//---
    public function setCartones($nuevoArregloCartones) {
        $this->$cartones = $nuevoArregloCartones;
    }


//--------

    public function bola() {
        if (sizeof($this->bolas) < 90) {
            $numeroAzar = rand(1, 90);//Numero al azar entre 1 y 90
            while (in_array($numeroAzar, $this->bolas) == TRUE) {
                $numeroAzar = rand(1, 90);
            }
            array_push($this->bolas,//Añadimos las bolas al vector
                    $numeroAzar);
            for ($i = 0; $i < 3; $i++) {//Recorremos los 3 cartones
                if ($this->cartones[$i]->marcar($numeroAzar) == 1 && //A cada carton le marcamos los numeros dentro de las lineas
                        $this->lineaCantada == FALSE) {//
                    $this->lineaCantada = TRUE;
                    echo '<div id="cantaLinea" class="alert alert-primary fs-2 fw-bold">LINEA EN CARTÓN ' . ($i + 1) . '</div>';
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

    public function mostrar3Cartones(){//Dibujamos los 3 cartones
        $r = '<section id="tresCartones" class="d-flex  flex-wrap ">';
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