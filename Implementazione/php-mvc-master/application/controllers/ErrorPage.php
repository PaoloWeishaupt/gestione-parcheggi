<?php
/**
 * Controller per gli errori.
 */
namespace Controllers;

use Libs\ViewLoader as ViewLoader;

class ErrorPage
{
    public static function error404()
    {
        ViewLoader::load('errors/404');
    }
}
