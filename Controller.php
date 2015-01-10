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

        $rota = ($rota == "") ? "home" : $rota;

        $rotas = [
            "home"     => "/home",
            "empresa"  => "/empresa",
            "servicos" => "/servicos",
            "contato"  => "/contato",
            "busca"    => "/busca",
            "produtos" => "/produtos",
            "admin"    => "/admin",
            "login"    => "/login",
            "valida-login" => "/valida-login",
            "sair"     => "/sair",
            "salvar"   => "/salvar"
        ];

        if(array_key_exists($rota, $rotas))
            return $rota;
        return false;

    }

    public function geraItensDeMenu(){
        $config = new Config();
        $dados = $config->parametrosParaConexaoComMysql();

        $db = new Db($dados["host"], $dados["dbname"], $dados["user"], $dados["password"]);
        $pdo = $db->conectar();

        $sql  = "SELECT link FROM conteudo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function escolhePagina($rota) {

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
            case "produtos":
                $pagina->produtos($rota);
                break;
            case "admin":
                $pagina->admin($rota);
                break;
            case "login":
                $pagina->login($rota);
                break;
            case "sair":
                $pagina->sair();
                break;
            case "valida-login":
                $pagina->valida_login($rota);
                break;
            case "salvar":
                $pagina->salvar($_POST);
                break;
            default:
                $pagina->home($rota);
                break;
        }

    }

} 