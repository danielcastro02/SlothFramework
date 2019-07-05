<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/laboratoriosPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/laboratoriosPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/laboratoriosPDO.php';
        }
    }
}

$classe = new laboratoriosPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

