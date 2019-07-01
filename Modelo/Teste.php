<?php 

class teste{

private $teste;
private $preco;
private $email;


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

     public function getTeste(){
         return $this->teste;
     }

     function setTeste($teste){
          $this->teste = $teste;
     }

     public function getPreco(){
         return $this->preco;
     }

     function setPreco($preco){
          $this->preco = $preco;
     }

     public function getEmail(){
         return $this->email;
     }

     function setEmail($email){
          $this->email = $email;
     }

}