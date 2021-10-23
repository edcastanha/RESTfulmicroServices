<?PHP

namespace App\Controllers\Api;

use \App\Common\Db\DBConection;

class InitApi
{

    
    public function getDetails($request)
    {
        return [
            'name' => 'API - PHP 7.4',
            'version' => '1.0.0',
            'author' => 'Edson Lourenço',
            'contact' => 'edcastanha@gmail.com',
            'github_repository' => 'https://github.com/edcastanha/RESTfulmicroServices'
        ];
    }

    protected function getPaginacao($request ,$objPage)
    {
        $page = $request->getParam('page');
        $limit = $request->getParam('limit');

        if ($page && $limit) {
            $objPage->setPage($page);
            $objPage->setLimit($limit);
        }

        return $objPage;
    }// getPaginacao
    
}//end class
