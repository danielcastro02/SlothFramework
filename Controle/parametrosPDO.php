<?php
include_once '../Base/requerLogin.php';

include_once __DIR__."/../Modelo/Parametros.php";
include_once __DIR__."/../Controle/PDOBase.php";

class ParametrosPDO extends PDOBase
{
    function alteraDestino(){
        $this->requerLogin();
        $parametros = new Parametros();
        $parametros->setDestino($_GET['destino']);
        if(!realpath("../../".$_GET['destino'])){
            mkdir("../../".$_GET['destino']);
        }
        $parametros->save();
        echo "true";
    }

    function alteraBanco(){
        $this->requerLogin();
        $parametros = new Parametros();
        $parametros->setNomeDb($_GET['nomeDb']);
        $parametros->save();
        echo "true";
    }
}