<?php
/**
 * Controller per la pagina home.
 */
namespace Controllers;

use Libs\ViewLoader as ViewLoader;
use Models\ResearchModel as ResearchModel;

class Research
{
    /**
     * Funzione che richiama il metodo per ricevere i posteggi offerti in base al filtro scelto dall'utente e poi
     * reindirizza verso la pagina che li mostra.
     */
    public function index()
    {
        $selected = null;
        if(isset($_GET['filter_disp']))
        {
            $disp = Validator::testInput($_GET['filter_disp']);
            ResearchModel::filterByDisp($disp);
            $selected = $disp;
        }
        elseif (isset($_GET['startDate']) && isset($_GET['endDate']))
        {
            $startDate = $_GET['startDate'];
            $endDate = $_GET['endDate'];

            ResearchModel::filterByDate($startDate, $endDate);
        }
        else {
            ResearchModel::getParcheggiDisponibili();
        }
        ViewLoader::load('ricerca/index', array('parcheggi'=>ResearchModel::$parcheggi, 'selected' => $selected));
    }

}