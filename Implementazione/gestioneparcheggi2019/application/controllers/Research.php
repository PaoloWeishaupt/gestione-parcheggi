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
        if (isset($_POST['startDate']) && !empty($_POST['startDate']) && isset($_POST['endDate']) && !empty($_POST['endDate']) && isset($_POST['filter_disp']))
        {
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $disp = Validator::testInput($_POST['filter_disp']);
            $selected = $disp;

            ResearchModel::filterAll($startDate, $endDate, $disp);
        }
        elseif (isset($_POST['filter_disp']))
        {
            $disp = Validator::testInput($_POST['filter_disp']);
            $selected = $disp;

            ResearchModel::filterByDisp($disp);
        }
        else
        {
            ResearchModel::getParcheggiDisponibili();
        }
        ViewLoader::load('ricerca/index', array('parcheggi'=>ResearchModel::$parcheggi, 'selected' => $selected));
    }

}