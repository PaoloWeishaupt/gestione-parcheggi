<?php
/**
 * Controller per la pagina di login.
 */
namespace Controllers;

use Controllers\Validator as Validator;
use Libs\Application as Application;
use Libs\ViewLoader as ViewLoader;
use Libs\Auth as Auth;
use Models\LoginModel as LoginModel;

class Login
{
    /**
     * Funzione che carica la pagina di login.
     */
    public function index()
    {
        ViewLoader::load('login/index');
    }

    /**
     * Funzione che richiama il metodo di login.
     * Se va a buon fine si carica la pagina home. Se non va a buon fine si ricarica la pagina di login.
     */
    public function login()
    {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['login'])) {

                $email = Validator::testInput($_POST['email']);
                $pass = hash('sha256', $_POST['password']);
    
                LoginModel::log($email, $pass);
            }
        }
        if(Auth::isAuthenticated())
        {
            ViewLoader::load('home/index');
        } else{
            ViewLoader::load('login/index');
        }
    }

    /**
     * Funzione che richiama il metodo di logout.
     */
    public function logout()
    {
        Auth::logout();
        Application::redirect("home/index");
    }
}