<?php
include_once 'carton.php';
include_once 'linea.php';
include_once 'juego.php';
?>  
<?php

class linea {

//atributos
    private $numeros = array();
    private $marcados = array();

//metodos
    public function __construct($numeros) {
        //metodo constructor
        $this->numeros = $numeros;
        array_push($this->marcados, FALSE,
                FALSE, FALSE, FALSE, FALSE);
    }

    public function getNumeros() {
        return $this->numeros;
    }

    public function getMarcados() {
        return $this->marcados;
    }

    public function setNumeros($numeros): void {
        $this->numeros = $numeros;
    }

    public function setMarcados($marcados): void {
        $this->marcados = $marcados;
    }


//---------
    public function marcar($numero) {
        for ($i = 0; $i <= 4; $i++) {
            if ($this->numeros[$i] == $numero) {
                $this->marcados[$i] = TRUE;
            }
        }
    }

//cierre de marcar
//-----

    public function completo() {
        $estaCompleto = FALSE;
        for ($i = 0; $i < 5; $i++) {
            if ($this->marcados[$i] == TRUE) {
                $estaCompleto = TRUE;
            } else {//$this->marcados[$i]==FALSE
                $estaCompleto = FALSE;
                break;
            }
        }
        return $estaCompleto;
    }

//cierre completo
//-----

    public function mostrarLinea() {
        $resultado = '<section class="bg-info text-dark">';
        $numero = 0;
        for ($i = 0; $i < 5; $i++) {
            $numero = $this->numeros[$i];
            if ($numero < 10) {
                $numero = '0' . $numero;
            }
            if ($this->marcados[$i] == TRUE) {
                $resultado = $resultado .
                        '<div><b class="danger fw-bold">' . $numero . '</b></div>';
            } else {
                $resultado = $resultado .
                        '<div class="dark fw-bold">' . $numero . '</div>';
            }
        }
        $resultado = $resultado . '</section>';
        return $resultado;
    }

//cierre mostrarLinea
}

//cierre de linea
?>