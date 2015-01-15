<div class="col-md-12">
	<h2><?php echo strtoupper($_SESSION['dados']->link); ?> </h2>

	
	<form class="form-horizontal" method="POST" action="salvar">
		<fieldset>
			<!-- Textarea -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="descricao">Descrição</label>
				<div class="col-md-4">
					<textarea class="form-control ckeditor" id="descricao" name="descricao"><?php echo isset($_SESSION['dados']->description) ? $_SESSION['dados']->description : ''; ?></textarea>
				</div>
			</div>

			<!-- Button -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="salvar"></label>
				<div class="col-md-4">
					<button id="salvar" name="salvar" class="btn btn-success">Salvar</button>
				</div>
			</div>

			<input type="hidden" name="link" value="<?php echo $_SESSION['dados']->link; ?>" />

		</fieldset>
	</form>
</div>