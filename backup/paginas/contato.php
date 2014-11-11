<?php 
	if(isset($_POST["nome"])) {
		
		echo "<div class='alert alert-success' role='alert'><p>Dados enviados com sucesso, abaixo seguem os dados que você enviou!</p></div>";		
		
		echo $_POST["nome"] . "<br />";
		echo $_POST["email"] . "<br />";
		echo $_POST["assunto"] . "<br />";
		echo $_POST["mensagem"] . "<br />";	
		echo "Mensagem enviada em: " . date('d/m/Y h:i:s');
	
		unset($_POST);	
	}
?>

<form action="<?php echo PATH ?>/contato" method="POST" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Formulário de contato</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome</label>  
  <div class="col-md-5">
  <input id="nome" name="nome" placeholder="Digite seu nome" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-5">
  <input id="email" name="email" placeholder="Digite seu e-mail" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="assunto">Assunto</label>  
  <div class="col-md-5">
  <input id="assunto" name="assunto" placeholder="Digite um assunto" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="mensagem">Mensagem</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="mensagem" placeholder="Digite uma mensagem" name="mensagem"></textarea>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit">Enviar</label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-success">Enviar</button>
  </div>
</div>

</fieldset>
</form>
