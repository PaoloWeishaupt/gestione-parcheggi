<?php
/**
 * Controller per la pagina home.
 */
namespace Controllers;

use Libs\ViewLoader as ViewLoader;
use Models\RicercaModel as RicercaModel;

class Ricerca
{
    /**
     * Funzione che richiama il metodo per ricevere i posteggi offerti e poi reindirizza verso la pagina che li mostra.
     */
    public function index()
    {
        RicercaModel::getParcheggiDisponibili();
        ViewLoader::load('ricerca/index', array('parcheggi'=>RicercaModel::$parcheggi));
    }
}