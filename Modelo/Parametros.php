<?php

class Parametros
{

    private $destino = "./";
    private $server;
    private $nome_db;

    public function __construct()
    {
        try {
            error_reporting(0);
            $atributos = json_decode(file_get_contents(__DIR__ . "/parametros.json"));
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
            error_reporting(E_ALL);
        } catch (Exception $e) {
            $this->save();
        }
        if ($_SERVER["HTTP_HOST"] == 'localhost') {
            $this->server = "https://" . gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR']));
            $requestURI = $_SERVER['REQUEST_URI'];
            $arrRequest = explode("/", $requestURI);
            $this->server = $this->server . "/" . strtolower($arrRequest[1]);
        } else {
            $this->server = "https://" . $_SERVER["HTTP_HOST"];
        }

    }

    public function save()
    {
        file_put_contents(__DIR__ . '/parametros.json', json_encode(get_object_vars($this)));
        file_put_contents(__DIR__ . '/../../adm.markeyvip.com/Parametros/' . $_SERVER["HTTP_HOST"] . ".json", json_encode(get_object_vars($this)));
    }


    function atualizar($vetor)
    {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function setDestino($destino)
    {
        $this->destino = $destino;
    }

    public function getNomeDb()
    {
        return $this->nome_db;
    }

    public function setNomeDb($nome_db)
    {
        $this->nome_db = $nome_db;
    }

    public function getServer()
    {
        return $this->server;
    }

    public function setServer($server)
    {
        $this->server = $server;
    }


}