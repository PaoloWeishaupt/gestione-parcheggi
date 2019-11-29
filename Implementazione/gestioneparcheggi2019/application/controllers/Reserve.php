<?php
/**
 * Controller per la gestione delle prenotazioni.
 */
namespace controllers;

use Controllers\Validator as Validator;
use Libs\Auth as Auth;
use Libs\ViewLoader as ViewLoader;
use Models\ReserveModel as ReserveModel;

class Reserve
{
    /**
     * Funzione per caricare la pagina di prenotazione.
     */
    public static function index()
    {
        if(Auth::isAuthenticated())
        {
            $id = Validator::testInput($_POST['id']);
            ReserveModel::getParcheggioInfo($id);
            ViewLoader::load('prenota/index', array('parcheggio'=>ReserveModel::$parcheggio));
        }
        else
        {
            ViewLoader::load('login/index', array('reserveLog'=>"Per eseguire una prenotazione devi avere un account!"));
        }
    }

    /**
     * Funzione che richiama il metodo per eseguire una prenotazione.
     */
    public static function prenota()
    {
        ReserveModel::prenota();
    }

}