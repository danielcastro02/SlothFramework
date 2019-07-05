<?php 

class comentario_pat{

private $id;
private $pat;
private $id_user;
private $comentario;
private $hora;


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

     public function getPat(){
         return $this->pat;
     }

     function setPat($pat){
          $this->pat = $pat;
     }

     public function getId_user(){
         return $this->id_user;
     }

     function setId_user($id_user){
          $this->id_user = $id_user;
     }

     public function getComentario(){
         return $this->comentario;
     }

     function setComentario($comentario){
          $this->comentario = $comentario;
     }

     public function getHora(){
         return $this->hora;
     }

     function setHora($hora){
          $this->hora = $hora;
     }

}