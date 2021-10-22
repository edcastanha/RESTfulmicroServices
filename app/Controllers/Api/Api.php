<?PHP


namespace App\Controllers\Api;


class Api
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

   
}//end class
