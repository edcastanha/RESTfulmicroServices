<?php
    namespace App\Models;

    class Produtos{
        private $id;
        private $nome;
        private $descricao;
        private $preco;
        private $foto;
        private $categoria_id;

        public function __construct($id=null, $nome=null, $descricao=null, $preco=null, $foto=null, $categoria_id=null){
            $this->id = $id;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->foto = $foto;
            $this->categoria_id = $categoria_id;
        }

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getNome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }
        public function getDescricao(){
            return $this->descricao;
        }
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        public function getPreco(){
            return $this->preco;
        }
        public function setPreco($preco){
            $this->preco = $preco;
        }
        public function getFoto(){
            return $this->foto;
        }
        public function setFoto($foto){
            $this->foto = $foto;
        }
        public function getCategoria_id(){
            return $this->categoria_id;
        }
        public function setCategoria_id($categoria_id){
            $this->categoria_id = $categoria_id;
        }
        
    }
    