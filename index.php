<?php

    ini_set('display_errors', true);
    error_reporting(E_ALL | E_STRICT);

	define("PATH", "http://".$_SERVER['HTTP_HOST']);
	define("DEFAULT_PATH", "paginas");		
	$route = parse_url(PATH.$_SERVER['REQUEST_URI']);

	$route['path'] = str_replace("/", "", $route['path']);

    include "Controller.php";
    $controller = new Controller();
	$checaSeRotaEstaMapeada  = $controller->checaRota($route['path']);
    $itens = $controller->geraItensDeMenu();

?>


<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="rafael" >

    <title>Segundo Projeto - PHP Foundation</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo PATH ?>/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="<?php echo PATH ?>/css/logo-nav.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav nav-pills">

                    <?php
                        if(!isset($_SESSION['logado'])) {
							foreach($itens as $item) {
								echo "
									<li>
										<a href='".PATH."/".$item->link."'>".$item->link."</a>
									</li>
								";
							}
						?>
						<li>
                            <a href="<?php echo PATH ?>/login">Login</a>
						</li>
						<li>
							<a href="<?php echo PATH ?>/contato">Contato</a>
						</li>
						<li>
							<a href="<?php echo PATH ?>/admin">Admin</a>
						</li>
					<?php
						} 
                    ?>
                    <?php if(isset($_SESSION['logado'])) : ?>
                        <li><a href="#">ADMINISTRAÇÃO</a></li>
						<li role="presentation" class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
							  Itens de menu <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
							  <?php
								if(isset($_SESSION['data'])) {
									foreach($_SESSION['data'] as $data) {
										?>
											<li>
												<form method="POST" action="atualizacao">
													<input type="hidden"  name="id" value="<?php echo $data->id; ?>">
													<input class="btn btn-default" type="submit" value="<?php echo $data->link ?>" />
												</form>
											</li>
										<?php
									}
								}
							  ?>
							</ul>
						</li>
						<li>
							<a href="<?php echo PATH ?>/sair">Logout</a>
						</li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-9">
                <form class="form-horizontal" action="/busca" method="GET">
                    <fieldset>
                        <!-- Search input-->
                        <div class="form-group">
                            <div class="col-md-4">
                                <input id="searchinput" name="busca" type="search" placeholder="busca" class="form-control input-md" required="">

                            </div>

                            <div class="col-md-4">
                                <button id="singlebutton" class="btn btn-primary">Buscar</button>
                            </div>
							
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php

                    $retornoRota = $checaSeRotaEstaMapeada;

                    if($retornoRota) {
                        $controller->escolhePagina($retornoRota);
                    }

                    if(!$retornoRota) {
                        echo "Página não encontrada! 404!";
                    }

                ?>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <p class="footer text-center">
			Todos os direitos reservados - <?php echo date('Y'); ?>
		</p>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo PATH ?>/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo PATH ?>/js/bootstrap.min.js"></script>

    <script src="//cdn.ckeditor.com/4.4.6/standard/ckeditor.js"></script>

    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //CKEDITOR.replace('descricao');
    </script>

    <script type="text/javascript">
        $('#botao').click(function(){
            var title = $('#botao').attr('title');
            $('#myModalLabel').empty();
            $('#myModalLabel').append(title);
        });
    </script>

</body>

</html>
