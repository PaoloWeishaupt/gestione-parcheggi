<?php
/**
 * Controller per la pagina home.
 */
namespace Controllers;

use Libs\ViewLoader as ViewLoader;

class Home
{
    /**
     * Funzione che carica la pagina home.
     */
    public function index()
    {
        ViewLoader::load('home/index');
    }
}
