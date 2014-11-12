<?php

include "Db.php";

$db = new Db("localhost", "pdo", "user", "asus.pass");
$pdo = $db->conectar();

echo "#### EXECUTANDO FIXTURE ####\n";

echo "Removendo tabelas\n";
$pdo->query("DROP TABLE IF EXISTS conteudo;");
echo " - OK \n";

echo "Criando tabela\n";
$pdo->query("CREATE TABLE conteudo (
  id INT NOT NULL AUTO_INCREMENT,
  link VARCHAR(100) NOT NULL,
  description VARCHAR(255),
  cadastre datetime,
  modify timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);");
echo " - OK \n";

echo "Inserindo dados\n";

for($i = 1; $i < 5; $i++) {
    switch($i) {
        case 1:
            $link = "home";
            break;
        case 2:
            $link = "empresa";
            break;
        case 3:
            $link = "servicos";
            break;
        case 4:
            $link = "produtos";
            break;
    }

    $description = "Conteudo do link: {$link} . Id: {$i}";

    $stmt = $pdo->prepare("INSERT INTO conteudo (link, description)  VALUES (:link, :description)");
    $stmt->bindValue(":link", $link);
    $stmt->bindValue(":description", $description);
    $stmt->execute();

}
echo " - OK\n";
echo "#### FINALIZANDO FIXTURE ####\n";