<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 10/11/14
 * Time: 22:38
 */

include_once "Pagina.php";
include_once "Db.php";
include_once "Config.php";

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

    public function escolhePagina($rota, $config) {

        //$pdo = new Db("localhost", "pdo", "user", "asus.pass");
        $config = new Config();
        $dados = $config->parametrosParaConexaoComMysql();

        $pdo = new Db($dados["host"], $dados["dbname"], $dados["user"], $dados["password"]);

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