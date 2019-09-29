<?php 

class aplicativo{

private $id_aplicativo;
private $cliente;
private $nome_pacote;
private $chave;
private $dominio;
private $arquivo_firebase;


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

     public function getId_aplicativo(){
         return $this->id_aplicativo;
     }

     function setId_aplicativo($id_aplicativo){
          $this->id_aplicativo = $id_aplicativo;
     }

     public function getCliente(){
         return $this->cliente;
     }

     function setCliente($cliente){
          $this->cliente = $cliente;
     }

     public function getNome_pacote(){
         return $this->nome_pacote;
     }

     function setNome_pacote($nome_pacote){
          $this->nome_pacote = $nome_pacote;
     }

     public function getChave(){
         return $this->chave;
     }

     function setChave($chave){
          $this->chave = $chave;
     }

     public function getDominio(){
         return $this->dominio;
     }

     function setDominio($dominio){
          $this->dominio = $dominio;
     }

     public function getArquivo_firebase(){
         return $this->arquivo_firebase;
     }

     function setArquivo_firebase($arquivo_firebase){
          $this->arquivo_firebase = $arquivo_firebase;
     }

}