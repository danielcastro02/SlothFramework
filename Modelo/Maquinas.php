<?php 

class maquinas{

private $id;
private $lab;
private $nome;
private $patrimonio;
private $n_serie;
private $w_serial;
private $situacao;
private $maq;


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

     public function getPatrimonio(){
         return $this->patrimonio;
     }

     function setPatrimonio($patrimonio){
          $this->patrimonio = $patrimonio;
     }

     public function getN_serie(){
         return $this->n_serie;
     }

     function setN_serie($n_serie){
          $this->n_serie = $n_serie;
     }

     public function getW_serial(){
         return $this->w_serial;
     }

     function setW_serial($w_serial){
          $this->w_serial = $w_serial;
     }

     public function getSituacao(){
         return $this->situacao;
     }

     function setSituacao($situacao){
          $this->situacao = $situacao;
     }

     public function getMaq(){
         return $this->maq;
     }

     function setMaq($maq){
          $this->maq = $maq;
     }

}