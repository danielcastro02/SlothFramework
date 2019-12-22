<?php

include_once __DIR__."/../Modelo/Usuario.php";
class PDOBase
{


    public function addToast(string $toast){
        $_SESSION['toast'][] = $toast;
    }

    public function log(string $content , string $file = "./logEmergence"){
        $data = new DateTime();
        file_put_contents($file , "
".$data->format("d/m/Y H/i/s - - -").$content , FILE_APPEND);
    }

    public function requerLogin(){
        if(!isset($_SESSION['logado'])){
            $this->addToast("Você precisa fazer login para acessar esta função!");
            header("location: ../Tela/login.php");
            exit(0);
        }
    }



}