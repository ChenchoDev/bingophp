
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
    public function marcar($numero) {//Recibe un numero entero
        $totalCompletos = 0;
        for ($j = 0; $j < sizeof($this->lineas); $j++) {//Recorre las lineas a traves del indice
            $this->lineas[$j]->marcar($numero);//Marca el numero en caso de existir
            if ($this->lineas[$j]->completo() == TRUE) {//Si marcado nos da completo le damos valor TRUE
                $totalCompletos++; /* $totalCompletos=$totalCompletos+1 *///Si nos da completos sumamos uno
            }
        }
        return $totalCompletos;//Devuelve el total de numeros marcados
    }

//cierre de marcar
//-----

    public function bingo() {
        $esBingo = FALSE;//Inicialmente lo ponemos FALSE
        if ($this->marcar(7) == 3) {//Si hay 3 lineas marcadas 
            $esBingo = TRUE;//Le damos valor TRUE
        } else {
            $esBingo = FALSE;//En caso contrario le damos valor FALSE
        }
        return $esBingo;
    }

//cierre de bingo
//----

    function generaDecenas() {
        $decenas = array();//Esta variable guarda los numeros limites de las decenas 
        for ($i = 10; $i <= 90; $i += 10) {//Obtenemos esos numeros limites de las decenas(10, 20, 30..)
            array_push($decenas, $i);
        }//cierre for
        /* 1-10 //Ejemplos de los numeros limites de las decenas
          11-20
          21-30 */
        return $decenas;//Nos devuelve esas decenas
    }

//cierre de generaDecenas()
//------

    function generaLinea() {
        $laLinea = array();
        $numeroInicial = 0;
        $numeroFinal = 0;
        $lasDecenas = $this->generaDecenas();
        shuffle($lasDecenas);
        for ($i = 0; $i < 5; $i++) {//Recorremos las decenas que ya han sido creadas de forma aleatoria y barajadas
            $numeroInicial = $lasDecenas[$i] - 9;
            $numeroFinal = $lasDecenas[$i];
            array_push($laLinea,
                    rand($numeroInicial, $numeroFinal));//Obtenemos un numero aleatorio en ese rango
        }//cierre for
        return $laLinea;
    }

//cierre generaLinea
//-----

    function identificaDecenas($linea) {
        $decenasDeLinea = array();
        $numero = 0;
        $decena = 0;
        for ($i = 0; $i < 5; $i++) {//Recorremos la linea
            $numero = $linea[$i];//Obtenemos el numero de la linea
            $decena = intval($numero / 10);//Obtenemos la parte entera
            if ($decena == 0) {//Numero menores de 10 (decena 0)
                $decena = 1; //Le asignamos la decena del 1
            }
            if ($numero % 10 == 0) {//
                $decena = $decena * 10;
            } else {
                if ($numero >= 10) {//Si el numero es mayor que 10
                    $decena = $decena * 10 + 10;//Le sumamos 10
                } else {
                    $decena = $decena * 10; //En caso contrario lo multiplicamos por 10
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
        while ($todasDecenas != $this->generaDecenas() ||//Mientras todas la decenas estén fuera del rango (10-90)
        sizeof(array_unique(array_merge($L1, $L2, $L3))) != 15 //Evitamos que salgan valores repetidos
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
                        $DL2[$i], $DL3[$i]);//Cogemos los elementos de cada decena y se lo añadimos a todas las decenas
            }
            $todasDecenas = array_unique($todasDecenas);
            sort($todasDecenas);
        }//cierre de while
        array_push($matriz, $L1, $L2, $L3);//Creamos una matriz con las lineas
        return $matriz;//Devolvemos esa matriz
    }

//cierre genera3Lineas
//------

    public function mostrarCarton() {//Dibujamos el carton
        $r = '<section id="carton" class="d-flex m-3" >'; //resultado
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