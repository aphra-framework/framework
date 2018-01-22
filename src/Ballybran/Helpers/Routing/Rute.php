<?php
/**
 * KNUT7 K7F (http://framework.artphoweb.com/)
 * KNUT7 K7F (tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2015.  KNUT7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.2
 */

namespace Ballybran\Helpers\Routing;


use Ballybran\Helpers\vardump\Vardump;
use const DIR_FILE;

class Rute
{

    //metodo que nos permite ingresar controladores con sus
    //respectivas rutas.
    private $_controladores = array();
    public function controladores($controlador)
    {
        $this->_controladores = $controlador;
        //llamada al metodo que hace el proceso de rutas
        self::submit();
    }
    //funcion o metodo que se ejecuta cada vez que se envia la peticion en la url
    public function submit()
    {
        $uri   = isset($_GET["uri"]) ? $_GET["uri"] : "/"; //recupera la url del proyecto
        $paths = explode("/", $uri); // divide la url en partes y forma un array
        // hacer consdicional para saber si esta en un
        //controllador o en la ruta principal
        if ($uri == "/") {
            //principal
            $res = array_key_exists("/", $this->_controladores); // buscando si existe la ruta (/) en el array de _controladores
            if ($res != "" && $res == 1) {
                // comprobando
                foreach ($this->_controladores as $ruta => $controller) {
                    // recorriendo los _controladores
                    if ($ruta == "/") { // comprobamos si las rutas con iguales
                        $controlador = $controller; // asignamos a una variable el controlador
                    }
                }
                $this->getController("index", $controlador); // llamamos al metodo que nos recupera el controlador
            }
        } else {
            //controladores y metodos
            echo "<b>Url:</b> ".$uri."<br><hr>";
            $estado = false;
            foreach ($this->_controladores as $ruta => $cont) {
                //echo "<br><b>Ruta:</b> ".$ruta."<br>";
                if (trim($ruta, "/") != "") {
                    $pos = strpos($uri, trim($ruta, "/"));

                    if ($pos === false) {
                        //echo "<small style='color:red;'>no se encontro</small><br>";
                    } else {
                        //echo "<small style='color:green;'>se econtro </small><br>";
                        $arrayParams  = array(); //array donde se guardaran los parametros de la web
                        $estado       = true; // estado de ruta
                        $controlador  = $cont;
                        $metodo       = "";
                        $cantidadRuta = count(explode("/", trim($ruta, "/")));
                        $cantidad     = count($paths);
                        if ($cantidad > $cantidadRuta) {
                            $metodo = $paths[$cantidadRuta];
                            for ($i = 0; $i < count($paths); $i++) {
                                if ($i > $cantidadRuta) {
                                    $arrayParams[] = $paths[$i];
                                }
                            }
                        }
                        //echo "<b>Parametros: </b>".json_encode($arrayParams);
                        //echo "<br><b>cantidad Rutas</b>: ".count(explode("/",trim($ruta,"/")))."<br>";
                        //echo "<br><b>cantidad Uris</b>: ".count($paths)."<br>";
                        /*if(count($paths) > 1){
                        $metodo = $paths[1];
                        }*/
                        $this->getController($metodo, $controlador, $arrayParams);

                    }
                }
                //echo "<hr>";
            }

            if ($estado == false) {
                die("error en la ruta");
            }

        }
    }
    public function getController($metodo, $controlador, $params = null)
    {
        $metodoController = ""; // metodo
        // comprobamos si es index o no el metodo o funcion del controlador

        if ($metodo == "index" || $metodo == "" || is_null($metodo)) {
            $metodoController = "index";
        } else {
            $metodoController = $metodo;
        }
        // incluimos el controlador
        $this->incluirControlador($controlador);
        //comprobamos si la clase existe
        if (class_exists($controlador)) {
            //creamos una clase temporal en base la variable controlador =(WelcomeController)
            // $clase = new WelcomeController();
            $ClaseTemp = new $controlador();
            //comprobamos si se puede llamar a la funcion o metodo de esa clase
            if (is_callable(array($ClaseTemp, $metodoController))) {
                //hacemos una llamada al metodo de esa clase
                //Clase->index();
                // $ClaseTemp->$metodoController();
                if ($metodoController == "index") {
                    if (count($params) == 0) {
                        $ClaseTemp->$metodoController();
                    } else {
                        die("error en parametros");
                    }
                } else {
                    call_user_func_array(array($ClaseTemp, $metodoController), $params);
                }
            } else {
                die(" no existe el metodo");
            }
        } else {
            die("no existe la clase");
        }

    }
    public function incluirControlador($controlador)
    {
        // validando si existe el archivo o no
        if (file_exists( "Module/Clinica/Controllers/" . $controlador . ".php")) {
            // si existe lo incluimos
            $c = include "Module/Clinica/Controllers/" . $controlador . ".php";

            Vardump::dump($c);
        } else {
            $c = include "Module/Clinica/Controllers/" . $controlador . ".php";

            Vardump::dump($c);
            die("error al encontrar el archivo de controlador");
        }
    }

}