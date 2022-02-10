<?php

include_once'carton.php';
include_once 'linea.php';
include_once 'juego.php';
?>  
<?php

//CLASE CARTON
class carton {

//atributos
    private $lineas = array();

//Constructor
    public function __construct() {
        $tresLineas = $this->genera3Lineas();
        $lineaUno = new linea($tresLineas[0]);
        $lineaDos = new linea($tresLineas[1]);
        $lineaTres = new linea($tresLineas[2]);
        array_push($this->lineas, $lineaUno,
                $lineaDos, $lineaTres);
    }

//Getter y Setter

    public function getLineas() {
        return $this->lineas;
    }

    public function setLineas($lineas): void {
        $this->lineas = $lineas;
    }

//---
    public function marcar($numero) {
        $totalCompletos = 0;
        for ($j = 0; $j < sizeof($this->lineas); $j++) {
            $this->lineas[$j]->marcar($numero);
            if ($this->lineas[$j]->completo() == TRUE) {
                $totalCompletos++; /* $totalCompletos=$totalCompletos+1 */
            }
        }
        return $totalCompletos;
    }

//cierre de marcar
//-----

    public function bingo() {
        $esBingo = FALSE;
        if ($this->marcar(7) == 3) {
            $esBingo = TRUE;
        } else {
            $esBingo = FALSE;
        }
        return $esBingo;
    }

//cierre de bingo
//----

    function generaDecenas() {
        $decenas = array();
        for ($i = 10; $i <= 90; $i += 10) {
            array_push($decenas, $i);
        }//cierre for
        /* 1-10
          11-20
          21-30 */
        return $decenas;
    }

//cierre de generaDecenas()
//------

    function generaLinea() {
        $laLinea = array();
        $numeroInicial = 0;
        $numeroFinal = 0;
        $lasDecenas = $this->generaDecenas();
        shuffle($lasDecenas);
        for ($i = 0; $i < 5; $i++) {
            $numeroInicial = $lasDecenas[$i] - 9;
            $numeroFinal = $lasDecenas[$i];
            array_push($laLinea,
                    rand($numeroInicial, $numeroFinal));
        }//cierre for
        return $laLinea;
    }

//cierre generaLinea
//-----

    function identificaDecenas($linea) {
        $decenasDeLinea = array();
        $numero = 0;
        $decena = 0;
        for ($i = 0; $i < 5; $i++) {
            $numero = $linea[$i];
            $decena = intval($numero / 10);
            if ($decena == 0) {
                $decena = 1;
            }
            if ($numero % 10 == 0) {
                $decena = $decena * 10;
            } else {
                if ($numero >= 10) {
                    $decena = $decena * 10 + 10;
                } else {
                    $decena = $decena * 10;
                }
            }
            array_push($decenasDeLinea, $decena);
        }
        return $decenasDeLinea;
    }

//cierre de identificaDecena
//----

    function genera3Lineas() {
        $matriz = array();
        $todasDecenas = array();
        while ($todasDecenas != $this->generaDecenas() ||
        sizeof(array_unique(array_merge($L1, $L2, $L3))) != 15
        ) {
            $todasDecenas = array();
            $L1 = $this->generaLinea();
            $L2 = $this->generaLinea();
            $L3 = $this->generaLinea();
            $DL1 = $this->identificaDecenas($L1);
            $DL2 = $this->identificaDecenas($L2);
            $DL3 = $this->identificaDecenas($L3);
            for ($i = 0; $i < 5; $i++) {
                array_push($todasDecenas, $DL1[$i],
                        $DL2[$i], $DL3[$i]);
            }
            $todasDecenas = array_unique($todasDecenas);
            sort($todasDecenas);
        }//cierre de while
        array_push($matriz, $L1, $L2, $L3);
        return $matriz;
    }

//cierre genera3Lineas
//------

    public function mostrarCarton() {
        $r = '<section id="carton" >'; //resultado
        for ($i = 0; $i < 3; $i++) {
            $r = $r . $this->lineas[$i]->mostrarLinea();
        }
        $r = $r . '</section>'; //$r.='</section>'
        return $r;
    }

//cierre mostrarCarton
}

//cierre de carton
?>