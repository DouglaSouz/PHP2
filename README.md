# Estrutura PHP Backend — Cliente e Fornecedor

Projeto desenvolvido a partir do repositório-base:

**https://github.com/marcioferraz81/estrutura-php-backend**

## Integrantes

- Dupla: **Douglas de Souza GOmes**
- Dupla: **Matheus Rowe**

> Substitua os dois nomes acima pelos nomes reais da dupla antes de publicar o repositório.

## Objetivo da atividade

Implementar cadastro, listagem e **edição de registros** para as entidades:

- Cliente
- Fornecedor

A estrutura original do projeto foi mantida em MVC/DAO, acrescentando somente o necessário para atender à atividade.

## Campos

### Cliente

| Campo | Tipo |
|---|---|
| id | INT, chave primária |
| nome | VARCHAR |
| email | VARCHAR |
| telefone | VARCHAR |

### Fornecedor

| Campo | Tipo |
|---|---|
| id | INT, chave primária |
| razao_social | VARCHAR |
| email | VARCHAR |
| telefone | VARCHAR |

## Funcionalidades implementadas

- Cadastro de cliente.
- Listagem de clientes.
- Seleção de cliente pelo botão **Editar**.
- Carregamento dos dados atuais no formulário.
- Alteração de nome, e-mail e telefone.
- Persistência das alterações com `UPDATE`.
- Cadastro de fornecedor.
- Listagem de fornecedores.
- Seleção de fornecedor pelo botão **Editar**.
- Alteração de razão social, e-mail e telefone.
- Persistência das alterações com `UPDATE`.

## Como funciona a edição

O ID do registro é enviado pela URL, por exemplo:

`?p=editar/cliente&id=1`

ou

`?p=editar/fornecedor&id=1`

A tela chama `consultarPorID()` para recuperar o registro. Depois, ao enviar o formulário, o Controller monta o objeto com o ID e os novos valores e o DAO executa um `UPDATE`.

O método `salvar()` foi mantido como ponto único de persistência: quando o objeto não possui ID, ele executa `INSERT`; quando possui ID, executa `UPDATE`.

## Banco de dados

O arquivo `banco.sql` contém a estrutura das tabelas necessárias e orientações de migração para a estrutura anterior.

Configuração atual da conexão no projeto:

- Host: `localhost`
- Usuário: `root`
- Banco: `bd_backend`

A senha está definida no arquivo `model/Conn.php` conforme a configuração original do projeto.

## Estrutura adicionada

- `model/Cliente.php` — campos e métodos da entidade Cliente.
- `model/Fornecedor.php` — campos e métodos da entidade Fornecedor.
- `dao/ClienteDAO.php` — consulta, listagem, cadastro, edição e exclusão.
- `dao/FornecedorDAO.php` — consulta, listagem, cadastro, edição e exclusão.
- `controller/ClienteController.php` — regras de entrada da entidade Cliente.
- `controller/FornecedorController.php` — regras de entrada da entidade Fornecedor.
- `view/cliente/editar.php` — formulário de edição de Cliente.
- `view/fornecedor/editar.php` — formulário de edição de Fornecedor.
- `banco.sql` — estrutura/migração do banco.
- `METODOS.txt` — métodos utilizados no processo.

## URL do repositório-base

https://github.com/marcioferraz81/estrutura-php-backend
