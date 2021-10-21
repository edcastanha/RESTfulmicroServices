<?php
namespace App\Utils;

class View
{
    /**
     * Classe para renderização de Pages
     * Retornará AuthPage para criação de token
     */

    // Variaveis padrões da page
    private static $vars = [];
    
    private static function getContentView($view){
        $file = __DIR__ .'../../../resources/view/'.$view .'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    
    }  

    public static function render($view, $vars =[])
    {
        // Views => Retornando o conteúdo da view
        $contentView = self::getContentView($view);

        // Variaveis => Retornando as variaveis
        $vars = array_merge(self::$vars, $vars);

        // MERGE Args => Retornando os valores das variáveis
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        }, $keys);

        return str_replace($keys, array_values($vars),$contentView);
    }

    public static function init($vars = [])
    {
        self::$vars = $vars;

    }

} 