<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/maquinasPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/maquinasPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/maquinasPDO.php';
        }
    }
}

$classe = new maquinasPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

