<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/descricaoPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/descricaoPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/descricaoPDO.php';
        }
    }
}

$classe = new descricaoPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

