<?php
/**
 * Controller per la pagina di offerta.
 */
namespace Controllers;

use Controllers\Validator as Validator;
use Libs\Application as Application;
use Libs\ViewLoader as ViewLoader;
use Libs\Auth as Auth;

class Offerta
{
    public function index()
    {
        if (Auth::isAuthenticated()) {
            ViewLoader::load('offerta/index');
        } else {
            Application::redirect("login/index");
        }
    }

    public function offri()
    {
        if(isset($_POST['offri'])){
            $selected_val = $_POST['select_disp'];
            $selected_date = Validator::validateDate($_POST['datepicker']);
            $selected_car = Validator::validateCarPlate($_POST['car_plate']);            
        }

        if(isset($_SESSION['dateError']) || isset($_SESSION['carPlateError']))
        {
            ViewLoader::load('offerta/index');

            unset($_SESSION['dateError']);
            unset($_SESSION['carPlateError']);
        }
    }

}
