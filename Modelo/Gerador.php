<?php

class gerador {

    private $id_tabela;
    private $nome;
    private $atributo;
    private $regra;
    private $tipo;

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

    function getId_tabela() {
        return $this->id_tabela;
    }

    function getNome() {
        return $this->nome;
    }

    function getAtributo() {
        return $this->atributo;
    }

    function getRegra() {
        return $this->regra;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId_tabela($id_tabela) {
        $this->id_tabela = $id_tabela;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setAtributo($atributo) {
        $this->atributo = $atributo;
    }

    function setRegra($regra) {
        $this->regra = $regra;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

}
