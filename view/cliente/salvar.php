<h3 class="mt-3 text-primary">Cliente</h3>

<div class="card shadow mt-3">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3">
        <div class="form-group row">
            <label for="txtnome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtnome" name="txtnome"
                       placeholder="Nome do cliente" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="txtemail" class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="txtemail" name="txtemail"
                       placeholder="cliente@email.com" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="txttelefone" class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txttelefone" name="txttelefone"
                       placeholder="(00) 00000-0000" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnsalvar" value="Cadastrar">
                <a href="?p=cliente" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    require_once '../controller/ClienteController.php';
    $cli = new ClienteController();

    if ($cli->salvar()) {
?>
        <div class="alert alert-primary mt-3" role="alert">
            Cliente - cadastro efetuado com sucesso.
        </div>
        <meta http-equiv="refresh" content="0.2;URL=?p=cliente">
<?php
    } else {
?>
        <div class="alert alert-danger mt-3" role="alert">
            Cliente - erro ao cadastrar.
        </div>
<?php
    }
}
?>