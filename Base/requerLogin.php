<?php

$pontos = "";
if (realpath("./index.php")) {
    $pontos = './';
} else {
    if (realpath("../index.php")) {
        $pontos = '../';
    } else {
        if (realpath("../../index.php")) {
            $pontos = '../../';
        }
    }
}
include_once $pontos.'Modelo/Usuario.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['logado'])) {
    header('location: ' . $pontos . $pontos."index.php");
} else {
    $logado = new usuario(unserialize($_SESSION['logado']));
}

