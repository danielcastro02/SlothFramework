<?php

include_once __DIR__ . "/./PDOBase.php";
include_once __DIR__ . "/./conexao.php";
include_once __DIR__ . "/../Modelo/Cliente.php";

class ClientePDO extends PDOBase
{
    public function inserirCliente()
    {
        $pdo = conexao::getConexao();
        $cliente = new Cliente($_POST);
        $stmt = $pdo->prepare("insert into cliente values(default, :nome_cliente, :cpf_cnpj , :descricao_cliente)");
        $stmt->bindValue(":nome_cliente", $cliente->getNomeCliente());
        $stmt->bindValue(":cpf_cnpj", $cliente->getCpfCnpj());
        $stmt->bindValue(":descricao_cliente", $cliente->getDescricaoCliente());
        $stmt->execute();
        header('location: ../Tela/listagemCliente.php');
    }

    public function selectCliente()
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from cliente");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    function selectClienteId_cliente($id_cliente)
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from cliente where id_cliente = :id_cliente");
        $stmt->bindValue(":id_cliente", $id_cliente);
        $stmt->execute();
        return $stmt;
    }
}