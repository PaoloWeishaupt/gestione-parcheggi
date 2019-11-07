<?php
/**
 * Controller per la pagina home.
 */
namespace Controllers;

use Libs\ViewLoader as ViewLoader;

class Home
{
    public function index()
    {
        ViewLoader::load('home/index');
    }
}
