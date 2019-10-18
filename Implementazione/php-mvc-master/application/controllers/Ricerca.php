<?php
/**
 * Controller per la pagina home.
 */
namespace Controllers;

use Libs\ViewLoader as ViewLoader;

class Ricerca
{
    public function index()
    {
        ViewLoader::load('ricerca/index');
    }
}