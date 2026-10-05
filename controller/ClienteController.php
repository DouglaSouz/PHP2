<?php

declare(strict_types=1);

require_once "../model/Cliente.php";
require_once "../dao/ClienteDAO.php";

class ClienteController
{
    private Cliente $cliente;
    private ClienteDAO $dao;

    public function __construct()
    {
        $this->cliente = new Cliente();
        $this->dao = new ClienteDAO();
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function consultarPorID(int $id): ?Cliente
    {
        return $this->dao->consultarPorID($id);
    }

    public function salvar(): bool
    {
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $this->cliente->setId($id ?: null);
        $this->cliente->setNome((string) filter_input(INPUT_POST, "txtnome"));
        $this->cliente->setEmail((string) filter_input(INPUT_POST, "txtemail"));
        $this->cliente->setTelefone((string) filter_input(INPUT_POST, "txttelefone"));

        return $this->dao->salvar($this->cliente);
    }
}