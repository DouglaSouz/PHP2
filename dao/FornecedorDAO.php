<?php

declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Fornecedor.php';

class FornecedorDAO
{
    private PDO $conn;
    private string $tabela = "fornecedor";

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
        $sql = "SELECT id, razao_social, email, telefone FROM {$this->tabela} ORDER BY razao_social";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPorID(int $id): ?Fornecedor
    {
        $sql = "SELECT id, razao_social, email, telefone FROM {$this->tabela} WHERE id = ?";
        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id, PDO::PARAM_INT);
        $executar->execute();
        $dados = $executar->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $fornecedor = new Fornecedor();
        $fornecedor->setId((int) $dados["id"]);
        $fornecedor->setRazaoSocial($dados["razao_social"]);
        $fornecedor->setEmail($dados["email"]);
        $fornecedor->setTelefone($dados["telefone"]);

        return $fornecedor;
    }

    public function salvar(Fornecedor $fornecedor): bool
    {
        if ($fornecedor->getId() === null) {
            $sql = "INSERT INTO {$this->tabela} (razao_social, email, telefone) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $this->texto($fornecedor->getRazaoSocial()));
            $stmt->bindValue(2, trim($fornecedor->getEmail()));
            $stmt->bindValue(3, trim($fornecedor->getTelefone()));
        } else {
            $sql = "UPDATE {$this->tabela}
                       SET razao_social = ?, email = ?, telefone = ?
                     WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $this->texto($fornecedor->getRazaoSocial()));
            $stmt->bindValue(2, trim($fornecedor->getEmail()));
            $stmt->bindValue(3, trim($fornecedor->getTelefone()));
            $stmt->bindValue(4, $fornecedor->getId(), PDO::PARAM_INT);
        }

        return $stmt->execute();
    }
}