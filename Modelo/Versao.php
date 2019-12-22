<?php


class Versao
{
    private $id_versao;
    private $id_projeto;
    private $nome_versao;
    private $descricao_versao;
    private $nivel;
    private $zip_file;

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

    public function getIdVersao()
    {
        return $this->id_versao;
    }

    public function setIdVersao($id_versao)
    {
        $this->id_versao = $id_versao;
    }

    public function getIdProjeto()
    {
        return $this->id_projeto;
    }

    public function setIdProjeto($id_projeto)
    {
        $this->id_projeto = $id_projeto;
    }

    public function getNomeVersao()
    {
        return $this->nome_versao;
    }

    public function setNomeVersao($nome_versao)
    {
        $this->nome_versao = $nome_versao;
    }

    public function getDescricaoVersao()
    {
        return $this->descricao_versao;
    }

    public function setDescricaoVersao($descricao_versao)
    {
        $this->descricao_versao = $descricao_versao;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    public function getZipFile()
    {
        return $this->zip_file;
    }

    public function setZipFile($zip_file)
    {
        $this->zip_file = $zip_file;
    }

}