<?php

declare(strict_types=1);

require_once "../model/Fornecedor.php";
require_once "../dao/FornecedorDAO.php";

class FornecedorController
{
    private Fornecedor $fornecedor;
    private FornecedorDAO $dao;

    public function __construct()
    {
        $this->fornecedor = new Fornecedor();
        $this->dao = new FornecedorDAO();
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function consultarPorID(int $id): ?Fornecedor
    {
        return $this->dao->consultarPorID($id);
    }

    public function salvar(): bool
    {
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $this->fornecedor->setId($id ?: null);
        $this->fornecedor->setRazaoSocial((string) filter_input(INPUT_POST, "txtrazao_social"));
        $this->fornecedor->setEmail((string) filter_input(INPUT_POST, "txtemail"));
        $this->fornecedor->setTelefone((string) filter_input(INPUT_POST, "txttelefone"));

        return $this->dao->salvar($this->fornecedor);
    }
}