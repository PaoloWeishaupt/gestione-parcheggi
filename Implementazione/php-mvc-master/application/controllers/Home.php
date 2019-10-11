<?php
/**
 * Controller per la pagina home.
 */
namespace Controllers;

use Libs\Application as Application;
use Libs\ViewLoader as ViewLoader;
use Libs\Auth as Auth;

class Home
{
    public function index()
    {
        ViewLoader::load('home/index');
    }

    public function ricerca()
    {
        ViewLoader::load('home/ricerca');
    }

}
