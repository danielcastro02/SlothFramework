<?php 

class laboratorios{

private $id;
private $nome;
private $n_maquinas;
private $problemas;


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

     public function getNome(){
         return $this->nome;
     }

     function setNome($nome){
          $this->nome = $nome;
     }

     public function getN_maquinas(){
         return $this->n_maquinas;
     }

     function setN_maquinas($n_maquinas){
          $this->n_maquinas = $n_maquinas;
     }

     public function getProblemas(){
         return $this->problemas;
     }

     function setProblemas($problemas){
          $this->problemas = $problemas;
     }

}