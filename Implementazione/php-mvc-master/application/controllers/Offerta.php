<?php
/**
 * Controller per la pagina di offerta.
 */
namespace Controllers;

use Libs\Application as Application;
use Libs\ViewLoader as ViewLoader;
use Libs\Auth as Auth;
use Models\OffertaModel as OffertaModel;

class Offerta
{
    /**
     * Funzione che carica la pagina di offerta.
     */
    public function index()
    {
        if (Auth::isAuthenticated()) {
            ViewLoader::load('offerta/index');
        } else {
            Application::redirect("login/index");
        }
    }

    /**
     * Funzione che richiama il metodo che aggiunge un offerta.
     */
    public function offri()
    {
        OffertaModel::addOfferta();
    }

}
