<?php 

class evt_lab{

private $id;
private $lab;
private $nome;
private $hora;
private $status;


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

     public function getLab(){
         return $this->lab;
     }

     function setLab($lab){
          $this->lab = $lab;
     }

     public function getNome(){
         return $this->nome;
     }

     function setNome($nome){
          $this->nome = $nome;
     }

     public function getHora(){
         return $this->hora;
     }

     function setHora($hora){
          $this->hora = $hora;
     }

     public function getStatus(){
         return $this->status;
     }

     function setStatus($status){
          $this->status = $status;
     }

}