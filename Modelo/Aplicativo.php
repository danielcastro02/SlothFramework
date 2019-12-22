<?php

class aplicativo
{

    private $id_aplicativo;
    private $id_cliente;
    private $id_versao;
    private $id_site;
    private $nome_pacote;
    private $chave_atualizacao;
    private $arquivo_firebase;


    public function __construct()
    {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
    }

    function atualizar($vetor)
    {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
    }

    public function getIdAplicativo()
    {
        return $this->id_aplicativo;
    }

    public function setIdAplicativo($id_aplicativo)
    {
        $this->id_aplicativo = $id_aplicativo;
    }

    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getIdVersao()
    {
        return $this->id_versao;
    }

    public function setIdVersao($id_versao)
    {
        $this->id_versao = $id_versao;
    }

    public function getIdSite()
    {
        return $this->id_site;
    }

    public function setIdSite($id_site)
    {
        $this->id_site = $id_site;
    }

    public function getNomePacote()
    {
        return $this->nome_pacote;
    }

    public function setNomePacote($nome_pacote)
    {
        $this->nome_pacote = $nome_pacote;
    }

    public function getChaveAtualizacao()
    {
        return $this->chave_atualizacao;
    }

    public function setChaveAtualizacao($chave_atualizacao)
    {
        $this->chave_atualizacao = $chave_atualizacao;
    }

    public function getArquivoFirebase()
    {
        return $this->arquivo_firebase;
    }

    public function setArquivoFirebase($arquivo_firebase)
    {
        $this->arquivo_firebase = $arquivo_firebase;
    }


}