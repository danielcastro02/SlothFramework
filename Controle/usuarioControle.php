<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/usuarioPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/usuarioPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/usuarioPDO.php';
        }
    }
}

$classe = new usuarioPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

