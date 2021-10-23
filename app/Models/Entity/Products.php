<?php
namespace App\Models\Entity;

use \App\Common\Db\DBConnection;

class Products
{
    private $id;
    private $nome;
    private $descricao;
    private $cod_barra;
    private $valor_compra;
    private $valor_venda;
    private $categoria_id;
    
    public function __construct($id=null, $nome=null, $descricao=null, $cod_barra=null, $valor_compra=null, $valor_venda=null, $categoria_id=null )
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->cod_barra = $cod_barra;
        $this->valor_compra = $valor_compra;
        $this->valor_venda = $valor_venda;
        $this->categoria_id = $categoria_id;
        
    }//end construct
    
    public function getProductsAll()
    {  
        $dbConn = new DBConnection('tb_produtos');
        
        //Instancia a conexao e informa a tabela
        $results = $dbConn->select()->fetchObject(self::class);
        echo '<pre>'; print_r($results); echo'</pre>'; exit;
        //Trazer todos os produtos
        return $results;
    

    }//end getProductAll


}//end class
