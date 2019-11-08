<?php
/**
 * Controller per gli errori.
 */
namespace Controllers;

use Libs\ViewLoader as ViewLoader;

class ErrorPage
{
    /*
     * Funzione che carica la pagina di errore 404.
     */
    public static function error404()
    {
        ViewLoader::load('errors/404');
    }
}
