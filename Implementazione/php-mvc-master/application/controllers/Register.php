<?php
/**
 * Controller per la pagina home.
 */
namespace controllers;

use Libs\ViewLoader as ViewLoader;
use Models\RegisterModel as RegisterModel;

class Register
{
    public function index()
    {
        ViewLoader::load('register/index');
    }

    public function register()
    {
        RegisterModel::register();
    }
}