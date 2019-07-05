<?php 

class patrimonio{

private $pat;
private $nome;
private $id_desc;
private $localizacao;
private $estado;


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

     public function getPat(){
         return $this->pat;
     }

     function setPat($pat){
          $this->pat = $pat;
     }

     public function getNome(){
         return $this->nome;
     }

     function setNome($nome){
          $this->nome = $nome;
     }

     public function getId_desc(){
         return $this->id_desc;
     }

     function setId_desc($id_desc){
          $this->id_desc = $id_desc;
     }

     public function getLocalizacao(){
         return $this->localizacao;
     }

     function setLocalizacao($localizacao){
          $this->localizacao = $localizacao;
     }

     public function getEstado(){
         return $this->estado;
     }

     function setEstado($estado){
          $this->estado = $estado;
     }

}