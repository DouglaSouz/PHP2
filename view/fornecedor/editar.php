<?php
require_once '../controller/FornecedorController.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$for = new FornecedorController();
$fornecedor = $id ? $for->consultarPorID($id) : null;

if (!$fornecedor) {
    echo '<div class="alert alert-danger mt-3">Fornecedor não encontrado.</div>';
    return;
}
?>

<h3 class="mt-3 text-primary">Editar Fornecedor</h3>

<div class="card shadow mt-3">
    <form method="post" class="m-3">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string)$fornecedor->getId()) ?>">

        <div class="form-group row">
            <label for="txtrazao_social" class="col-sm-2 col-form-label">Razão Social</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtrazao_social" name="txtrazao_social"
                       value="<?= htmlspecialchars($fornecedor->getRazaoSocial()) ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="txtemail" class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="txtemail" name="txtemail"
                       value="<?= htmlspecialchars($fornecedor->getEmail()) ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="txttelefone" class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txttelefone" name="txttelefone"
                       value="<?= htmlspecialchars($fornecedor->getTelefone()) ?>" required>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" name="btnsalvar" value="Salvar alterações">
        <a href="?p=fornecedor" class="btn btn-danger">Cancelar</a>
    </form>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    if ($for->salvar()) {
        echo '<div class="alert alert-primary mt-3">Fornecedor - alterações salvas com sucesso.</div>';
        echo '<meta http-equiv="refresh" content="0.5;URL=?p=fornecedor">';
    } else {
        echo '<div class="alert alert-danger mt-3">Fornecedor - erro ao salvar alterações.</div>';
    }
}
?>