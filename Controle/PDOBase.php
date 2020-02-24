<?php

include_once __DIR__."/../Modelo/Parametros.php";
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

    public function requerAdm(){
        if(!isset($_SESSION['logado'])){
            $this->addToast("Você precisa fazer login para acessar esta função!");
            header("location: ../Tela/login.php");
            exit(0);
        }else{
            $usuario = new usuario(unserialize($_SESSION['logado']));
            if($usuario->getAdministrador()==0){
                header("location: ../Tela/acessoNegado.php");
                exit(0);
            }
        }
    }
    public function requerPrestador(){
        if(!isset($_SESSION['logado'])){
            header("location: ../Tela/acessoNegado.php");
            exit(0);
        }
    }
}