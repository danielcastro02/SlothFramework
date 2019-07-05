<?php 

class comentarios_lab{

private $id;
private $id_evento;
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

     public function getId_evento(){
         return $this->id_evento;
     }

     function setId_evento($id_evento){
          $this->id_evento = $id_evento;
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