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
        $selected = null;
        if(isset($_GET['filter_disp']))
        {
            $disp = Validator::testInput($_GET['filter_disp']);
            RicercaModel::filterByDisp($disp);
            $selected = $disp;
        }
        elseif (isset($_GET['startDate']) && isset($_GET['endDate']))
        {
            $startDate = $_GET['startDate'];
            $endDate = $_GET['endDate'];

            RicercaModel::filterByDate($startDate, $endDate);
        }
        else {
            RicercaModel::getParcheggiDisponibili();
        }
        ViewLoader::load('ricerca/index', array('parcheggi'=>RicercaModel::$parcheggi, 'selected' => $selected));
    }

}