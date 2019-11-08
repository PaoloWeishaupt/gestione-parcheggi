<?php
/**
 * Controller per la pagina home.
 */
namespace controllers;

use Libs\ViewLoader as ViewLoader;
use Models\RegisterModel as RegisterModel;

class Register
{
    /*
     * Funzione che carica la pagina di registrazione.
     */
    public function index()
    {
        ViewLoader::load('register/index');
    }

    /*
     * Funzione che richiama il metodo per la registrazione.
     */
    public function register()
    {
        RegisterModel::register();
    }
}