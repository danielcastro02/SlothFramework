<?php 

class users{

private $id;
private $user;
private $password;
private $nome;
private $nivel;


public function __construct() {
    if (func_num_args() != 0) {
        $atributos = func_get_args()[0];
        foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
    }

    function atualizar($vetor) {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
    }

     public function getId(){
         return $this->id;
     }

     function setId($id){
          $this->id = $id;
     }

     public function getUser(){
         return $this->user;
     }

     function setUser($user){
          $this->user = $user;
     }

     public function getPassword(){
         return $this->password;
     }

     function setPassword($password){
          $this->password = $password;
     }

     public function getNome(){
         return $this->nome;
     }

     function setNome($nome){
          $this->nome = $nome;
     }

     public function getNivel(){
         return $this->nivel;
     }

     function setNivel($nivel){
          $this->nivel = $nivel;
     }

}