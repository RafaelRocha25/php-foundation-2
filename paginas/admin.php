<h1>Admin</h1>
<?php echo $_SESSION["conteudo"]; ?> |
<a href="<?php echo PATH . "/sair"; ?>">sair</a>

<ul>
    <?php
        foreach($_SESSION['data'] as $data) {
            echo '<li>' . $data->link . '</li>';
            ?>
            <form class="form-horizontal" method="POST" action="salvar">
                <fieldset>
                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="descricao">Descrição</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="descricao" name="descricao"><?php echo isset($data->description) ? $data->description : ''; ?></textarea>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="salvar"></label>
                        <div class="col-md-4">
                            <button id="salvar" name="salvar" class="btn btn-success">Salvar</button>
                        </div>
                    </div>

                    <input type="hidden" name="link" value="<?php echo $data->link; ?>" />

                </fieldset>
            </form>
        <?php
        }
    ?>
</ul>


<br />
<br />