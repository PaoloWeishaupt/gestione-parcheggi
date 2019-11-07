<?php
/**
 * Controller per la pagina home.
 */
namespace Controllers;

use Libs\ViewLoader as ViewLoader;
use Models\RicercaModel as RicercaModel;

class Ricerca
{
    public function index()
    {
        RicercaModel::getParcheggiDisponibili();
        ViewLoader::load('ricerca/index', array('parcheggi'=>RicercaModel::$parcheggi));
    }
}