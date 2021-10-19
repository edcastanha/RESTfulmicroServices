<?php
require_once '../vendor/autoload.php';

use App\Config\DBConexao;
use App\Models\Produtos;

class ProdutosServices
{

    private static $table = 'tb_produtos';
    
    public function getAll()
    {
        $db = new DBConexao();
        $sql = "SELECT * FROM " . self::$table;
        $result = $db->query($sql);
        $produtos = [];
        while ($produto = $result->fetch_assoc()) {
            $produtos[] = new Produtos($produto['id'], $produto['nome'], $produto['preco'], $produto['descricao']);
        }
        return $produtos;
    }



}