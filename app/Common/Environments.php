<?php

namespace App\Common;

class Environments
{

    public function loadenv($dir)
    {
        if (!file_exists($dir . '/.env')) {
            return false;
        }

        $var_lines = file($dir.'/.env');
        foreach ($var_lines as $value) {
            putenv(trim($value));
        }
        // phpinfo(INFO_ENVIRONMENT);
        
    }
}//class end