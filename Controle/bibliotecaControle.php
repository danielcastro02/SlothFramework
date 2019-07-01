<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/bibliotecaPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/bibliotecaPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/bibliotecaPDO.php";
            
        }
    }
}
$classe = new bibliotecaPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}