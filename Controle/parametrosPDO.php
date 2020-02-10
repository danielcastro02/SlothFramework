<?php
include_once '../Base/requerLogin.php';

include_once __DIR__."/../Modelo/Parametros.php";

class ParametrosPDO
{
    function alteraDestino(){
        $parametros = new Parametros();
        $parametros->setDestino($_GET['destino']);
        $parametros->save();
        echo "true";
    }

    function alteraBanco(){
        $parametros = new Parametros();
        $parametros->setNomeDb($_GET['nomeDb']);
        $parametros->save();
        echo "true";
    }
}