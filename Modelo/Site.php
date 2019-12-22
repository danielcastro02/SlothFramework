<?php


class Site
{
    private $id_site;
    private $id_cliente;
    private $id_versao;
    private $dominio;
    private $parametros;

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

    public function getIdSite()
    {
        return $this->id_site;
    }

    public function setIdSite($id_site)
    {
        $this->id_site = $id_site;
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

    public function getDominio()
    {
        return $this->dominio;
    }

    public function setDominio($dominio)
    {
        $this->dominio = $dominio;
    }

    public function getParametros()
    {
        return $this->parametros;
    }

    public function setParametros($parametros)
    {
        $this->parametros = $parametros;
    }



}