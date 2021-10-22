<?php

namespace App\Controllers\Page;

use \App\Utils\View;

class Index
{

    public static function getAuth()
    {
        return View::render('pages/auth', [
            'title' => 'API RESTful - Composer PHP',
            'Autor' => 'Edson Lourenço'
        ]);
    }
}