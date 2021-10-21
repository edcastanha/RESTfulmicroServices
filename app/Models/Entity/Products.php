<?php
    namespace App\Models;

class Produtos
{
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $foto;
    private $categoria_id;

    public function __construct($id=null, $nome=null, $descricao=null, $preco=null, $foto=null, $categoria_id=null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->foto = $foto;
        $this->categoria_id = $categoria_id;
    }

}
