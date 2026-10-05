<?php
require_once '../controller/ClienteController.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$cli = new ClienteController();
$cliente = $id ? $cli->consultarPorID($id) : null;

if (!$cliente) {
    echo '<div class="alert alert-danger mt-3">Cliente não encontrado.</div>';
    return;
}
?>

<h3 class="mt-3 text-primary">Editar Cliente</h3>

<div class="card shadow mt-3">
    <form method="post" class="m-3">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string)$cliente->getId()) ?>">

        <div class="form-group row">
            <label for="txtnome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtnome" name="txtnome"
                       value="<?= htmlspecialchars($cliente->getNome()) ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="txtemail" class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="txtemail" name="txtemail"
                       value="<?= htmlspecialchars($cliente->getEmail()) ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="txttelefone" class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txttelefone" name="txttelefone"
                       value="<?= htmlspecialchars($cliente->getTelefone()) ?>" required>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" name="btnsalvar" value="Salvar alterações">
        <a href="?p=cliente" class="btn btn-danger">Cancelar</a>
    </form>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    if ($cli->salvar()) {
        echo '<div class="alert alert-primary mt-3">Cliente - alterações salvas com sucesso.</div>';
        echo '<meta http-equiv="refresh" content="0.5;URL=?p=cliente">';
    } else {
        echo '<div class="alert alert-danger mt-3">Cliente - erro ao salvar alterações.</div>';
    }
}
?>