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
        unset($_SESSION["conteudo"], $_SESSION["msg"]);
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

    public function login($rota) {
        unset($_SESSION['logado']);
		include "paginas/login.php";
    }

    public function valida_login($rota) {
        unset($_SESSION["msg"]);
        $pdo  = $this->getPdo()->conectar();

        $sql  = "SELECT * FROM usuarios WHERE user = :user";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":user", $_POST['username']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if(isset($result->user) && (password_verify($_POST['password'], $result->password))){
            $_SESSION['logado'] = TRUE;
			header('Location: '.PATH.'/admin');
        } else {
            $_SESSION['msg'] = "Login ou senha inválido!";
            $this->login('login');
        }
    }

    public function sair() {
        unset($_SESSION['logado']);
		$this->pivo();
    }
	
	public function pivo() {
		include "paginas/pivo.php";
	}

    public function admin($rota) {
        if(isset($_SESSION['logado'])) {
            $pdo = $this->getPdo()->conectar();

            $sql = "SELECT * FROM conteudo";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $data[] = $result;
            }


            unset($_SESSION['mensagem']);
            $_SESSION["conteudo"] = "No menu acima você pode atualizar o conteúdo de todo o site!";
            $_SESSION["data"] = $data;
            include "paginas/admin.php";
        } else {
            $this->login('login');
        }
    }

    public function salvar($data) {
        if(isset($_SESSION['logado'])) {
            try {
                $pdo = $this->getPdo()->conectar();
                $sql = "UPDATE conteudo SET description = :descricao WHERE link = :link";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":descricao", $data['descricao'], PDO::PARAM_STR);
                $stmt->bindParam(":link", $data['link'], PDO::PARAM_STR);
                $stmt->execute();

                $_SESSION["conteudo"] = "Administração!";
                $_SESSION["mensagem"] = "Conteúdo salvo com sucesso!<br />";
                include "paginas/admin.php";

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            $this->login('login');
        }

    }
	
	public function atualizacao($data) {
	
		unset($_SESSION['dados']);
	
		if(isset($_SESSION['logado'])) {
							
			$pdo = $this->getPdo()->conectar();
			$sql = "SELECT * FROM conteudo WHERE id = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id", $data);
			$stmt->execute();
			$_SESSION['dados'] = $stmt->fetch(PDO::FETCH_OBJ);
			
			include "paginas/atualizacao.php";
		}
		
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

    public function produtos($rota) {
        $pdo = $this->getPdo()->conectar();

        $sql  = "SELECT * FROM conteudo WHERE link = :rota";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":rota", $rota);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $_SESSION["conteudo"] = utf8_encode($result->description);
        include "paginas/produtos.php";
    }

    public function contato() {
        include "paginas/contato.php";
    }

    public function busca($param) {
        $pdo = $this->getPdo()->conectar();

        $like = "%".$param."%";

        $sql = "SELECT * FROM conteudo WHERE description LIKE ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1,  $like);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

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