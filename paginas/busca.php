<h1>Resultado da busca</h1>
<h3>Páginas que contém conteúdo com a palavra <i><?php echo $_GET["busca"];?></i></h3>
<ul>
<?php

    foreach($_SESSION['conteudo'] as $s) {
        echo "<a href='".PATH."/".$s->link."'><li>".$s->link."</li></a>";
    }

?>
</ul>