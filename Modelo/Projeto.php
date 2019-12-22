<?php


class Projeto
{
    private $id_projeto;
    private $nome_projeto;
    private $descricao_projeto;

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

    public function getIdProjeto()
    {
        return $this->id_projeto;
    }

    public function setIdProjeto($id_projeto)
    {
        $this->id_projeto = $id_projeto;
    }

    public function getNomeProjeto()
    {
        return $this->nome_projeto;
    }

    public function setNomeProjeto($nome_projeto)
    {
        $this->nome_projeto = $nome_projeto;
    }


    public function getDescricaoProjeto()
    {
        return $this->descricao_projeto;
    }

    public function setDescricaoProjeto($descricao_projeto)
    {
        $this->descricao_projeto = $descricao_projeto;
    }

}