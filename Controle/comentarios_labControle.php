<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/comentarios_labPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/comentarios_labPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/comentarios_labPDO.php';
        }
    }
}

$classe = new comentarios_labPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

