<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 10/11/14
 * Time: 22:38
 */

include "Pagina.php";
include_once "Db.php";

class Controller {

    /**
     * Verifica se a rota passada está mapeada
     **/
    public function checaRota($rota) {

        $rotas = [
            ""         => "/home",
            "home"     => "/home",
            "empresa"  => "/empresa",
            "servicos" => "/servicos",
            "contato"  => "/contato",
            "busca"    => "/busca"
        ];

        if(array_key_exists($rota, $rotas))
            return $rota;
        return false;

    }

    public function escolhePagina($rota) {

        $pdo = new Db("localhost", "pdo", "user", "asus.pass");

        $pagina = new Pagina($pdo);

        switch($rota) {
            case "home":
                $pagina->home($rota);
                break;
            case "servicos":
                $pagina->servicos($rota);
                break;
            case "empresa":
                $pagina->empresa($rota);
                break;
            case "busca":
                $pagina->busca($_GET['busca']);
                break;
            case "contato";
                $pagina->contato();
                break;
            default:
                $pagina->home($rota);
                break;
        }

    }

} 