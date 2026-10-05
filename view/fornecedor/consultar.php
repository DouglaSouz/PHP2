<div class="col-sm-12 mb-4">
    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Listar Fornecedores
                <a class="btn btn-success float-right mb-3 mr-3" href="?p=add/fornecedor" title="Cadastrar fornecedor">
                    <i class="bi bi-database-fill-add"></i>
                </a>
            </h3>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Razão Social</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../controller/FornecedorController.php';
                    $for = new FornecedorController();
                    $dados = $for->listar();
                    foreach ($dados as $mostrar) {
                    ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$mostrar['id']) ?></td>
                        <td><?= htmlspecialchars($mostrar['razao_social']) ?></td>
                        <td><?= htmlspecialchars($mostrar['email']) ?></td>
                        <td><?= htmlspecialchars($mostrar['telefone']) ?></td>
                        <td>
                            <a href="?p=editar/fornecedor&id=<?= (int)$mostrar['id'] ?>"
                               class="btn btn-primary" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="?p=excluir/fornecedor&id=<?= (int)$mostrar['id'] ?>"
                               class="btn btn-danger" title="Excluir"
                               onclick="return confirm('Tem certeza que deseja excluir?')">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>