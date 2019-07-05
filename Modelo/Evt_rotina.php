<?php 

class evt_rotina{

private $id;
private $id_us;
private $hora;
private $nome;
private $descricao;
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

     public function getId_us(){
         return $this->id_us;
     }

     function setId_us($id_us){
          $this->id_us = $id_us;
     }

     public function getHora(){
         return $this->hora;
     }

     function setHora($hora){
          $this->hora = $hora;
     }

     public function getNome(){
         return $this->nome;
     }

     function setNome($nome){
          $this->nome = $nome;
     }

     public function getDescricao(){
         return $this->descricao;
     }

     function setDescricao($descricao){
          $this->descricao = $descricao;
     }

     public function getStatus(){
         return $this->status;
     }

     function setStatus($status){
          $this->status = $status;
     }

}