<?PHP

namespace App\Controllers\Api;

use \App\Models\Entity\Products as TBProduct;

class Products extends InitApi
{

    public function getProdutosAll($request)
    {
        $itens = TBProduct::getProductsAll();

        echo '<pre>'; print_r($itens); echo'</pre>'; exit;
        $produto = [];
        foreach ($itens as $key => $value) {
            $produto[$key] = $value;
        }

        return [
            'produtos' => [$produto],
            'paginacao' => []
        ];
    }

   
}//end class
