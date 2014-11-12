<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 10/11/14
 * Time: 23:01
 */
session_start();

class Pagina {

    private $pdo;

    public function __construct(Db $pdo){
        $this->setPdo($pdo);
        unset($_SESSION["conteudo"]);
    }


    public function home($rota) {
        $pdo  = $this->getPdo()->conectar();

        $sql  = "SELECT * FROM conteudo WHERE link = :rota";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":rota", $rota);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $_SESSION["conteudo"] = utf8_encode($result->description);
        include "paginas/home.php";
    }

    public function servicos($rota) {
        $pdo = $this->getPdo()->conectar();

        $sql  = "SELECT * FROM conteudo WHERE link = :rota";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":rota", $rota);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $_SESSION["conteudo"] = utf8_encode($result->description);
        include "paginas/servicos.php";
    }

    public function empresa($rota) {
        $pdo = $this->getPdo()->conectar();

        $sql  = "SELECT * FROM conteudo WHERE link = :rota";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":rota", $rota);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $_SESSION["conteudo"] = utf8_encode($result->description);
        include "paginas/empresa.php";
    }

    public function contato() {
        include "paginas/contato.php";
    }

    public function busca($param) {
        $pdo = $this->getPdo()->conectar();

        $sql = "SELECT * FROM conteudo WHERE description LIKE '%:tag%'; ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tag',  $param);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        var_dump($result);
        $_SESSION["conteudo"] = $result;
        include "paginas/busca.php";
    }

    /**
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param mixed $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }



} 