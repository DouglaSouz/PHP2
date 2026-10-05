<?php

declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Cliente.php';

class ClienteDAO
{
    private PDO $conn;
    private string $tabela = "cliente";

    public function __construct()
    {
        $this->conn = Conn::getInstance();
    }

    private function texto(string $texto): string
    {
        return mb_strtoupper(trim($texto));
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM {$this->tabela} WHERE id = ?";
        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id, PDO::PARAM_INT);
        return $executar->execute();
    }

    public function listar(): array
    {
        $sql = "SELECT id, nome, email, telefone FROM {$this->tabela} ORDER BY nome";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPorID(int $id): ?Cliente
    {
        $sql = "SELECT id, nome, email, telefone FROM {$this->tabela} WHERE id = ?";
        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id, PDO::PARAM_INT);
        $executar->execute();
        $dados = $executar->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $cliente = new Cliente();
        $cliente->setId((int) $dados["id"]);
        $cliente->setNome($dados["nome"]);
        $cliente->setEmail($dados["email"]);
        $cliente->setTelefone($dados["telefone"]);

        return $cliente;
    }

    public function salvar(Cliente $cliente): bool
    {
        if ($cliente->getId() === null) {
            $sql = "INSERT INTO {$this->tabela} (nome, email, telefone) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $this->texto($cliente->getNome()));
            $stmt->bindValue(2, trim($cliente->getEmail()));
            $stmt->bindValue(3, trim($cliente->getTelefone()));
        } else {
            $sql = "UPDATE {$this->tabela}
                       SET nome = ?, email = ?, telefone = ?
                     WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $this->texto($cliente->getNome()));
            $stmt->bindValue(2, trim($cliente->getEmail()));
            $stmt->bindValue(3, trim($cliente->getTelefone()));
            $stmt->bindValue(4, $cliente->getId(), PDO::PARAM_INT);
        }

        return $stmt->execute();
    }
}