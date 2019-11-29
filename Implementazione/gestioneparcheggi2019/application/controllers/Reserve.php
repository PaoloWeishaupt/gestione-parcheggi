<?php
/**
 * Controller per la gestione delle prenotazioni.
 */
namespace controllers;

use Controllers\Validator as Validator;
use Libs\ViewLoader as ViewLoader;
use Models\PrenotaModel as PrenotaModel;

class Prenota
{
    /**
     * Funzione per caricare la pagina di prenotazione.
     */
    public static function index()
    {
        $id = Validator::testInput($_POST['id']);
        PrenotaModel::getParcheggioInfo($id);
        ViewLoader::load('prenota/index', array('parcheggio'=>PrenotaModel::$parcheggio));
    }

    /**
     * Funzione che richiama il metodo per eseguire una prenotazione.
     */
    public static function prenota()
    {
        PrenotaModel::prenota();
    }

}