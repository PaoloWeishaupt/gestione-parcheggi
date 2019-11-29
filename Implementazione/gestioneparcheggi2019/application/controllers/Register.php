<?php
/**
 * Controller per la pagina home.
 */
namespace controllers;

use Libs\ViewLoader as ViewLoader;
use Models\RegisterModel as RegisterModel;

class Register
{
    /**
     * Funzione che carica la pagina di registrazione.
     */
    public function index()
    {
        ViewLoader::load('register/index');
    }

    /**
     * Funzione che richiama il metodo per la registrazione.
     */
    public function register()
    {
        RegisterModel::register();
    }

    /**
     * Funzione che richiama il metodo per la verifica dell'utente.
     */
    public function verify()
    {
        if(isset($_GET['mail']) && isset($_GET['nome']) && !empty($_GET['cognome'])){

            $mail = Validator::testInput($_GET['mail']);
            $nome = Validator::validateCharAndSpace($_GET['nome']);
            $cognome = Validator::validateCharAndSpace($_GET['cognome']);

            RegisterModel::verify($mail, $nome, $cognome);
        }else{

            ViewLoader::load('home/index', array('activationNO'=>"Usa il link che ti è stato inviato per mail!"));

        }
    }
}