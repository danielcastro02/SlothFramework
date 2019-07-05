<?php 

class softwares{

private $id;
private $lab;
private $nome;
private $descricao;
private $instalacao;


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

     public function getDescricao(){
         return $this->descricao;
     }

     function setDescricao($descricao){
          $this->descricao = $descricao;
     }

     public function getInstalacao(){
         return $this->instalacao;
     }

     function setInstalacao($instalacao){
          $this->instalacao = $instalacao;
     }

}