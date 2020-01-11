<?php


class Cliente
{
    private $id_cliente;
    private $nome_cliente;
    private $cpf_cnpj;
    private $descricao_cliente;

    public function __construct() {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
    }

    function atualizar($vetor) {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
    }

    public function getNomeCliente()
    {
        return $this->nome_cliente;
    }

    public function setNomeCliente($nome_cliente)
    {
        $this->nome_cliente = $nome_cliente;
    }

    public function getDescricaoCliente()
    {
        return $this->descricao_cliente;
    }

    public function setDescricaoCliente($descricao_cliente)
    {
        $this->descricao_cliente = $descricao_cliente;
    }


    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }


    public function getCpfCnpj()
    {
        return $this->cpf_cnpj;
    }

    public function setCpfCnpj($cpf_cnpj)
    {
        $this->cpf_cnpj = $cpf_cnpj;
    }


}