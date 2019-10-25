<?php


namespace models;

use Controllers\Validator as Validator;
use Libs\Database as Database;
use Libs\ViewLoader as ViewLoader;
use Models\Users as Users;
use PDO;


class OffertaModel
{

    private static $selectedVal;
    private static $selectedDate;
    private static $selectedCarPlate;
    private static $statement;

    public static function addOfferta()
    {
        if(isset($_POST['offri'])){
            self::$selectedVal = $_POST['select_disp'];
            self::$selectedDate = Validator::validateDate($_POST['datepicker']);
            self::$selectedCarPlate = Validator::validateCarPlate($_POST['car_plate']);
        }

        if(isset($_SESSION['dateError']) || isset($_SESSION['carPlateError']))
        {
            ViewLoader::load('offerta/index');

            unset($_SESSION['dateError']);
            unset($_SESSION['carPlateError']);
        }

        if(Users::hasParcheggio())
        {
            $inputDate = date_create(self::$selectedDate);
            $inputDateFormat = date_format($inputDate, "Y-m-d H:i:s");

            self::$statement = Database::get()->prepare("
                            update posteggio set disponibilita=:disponibilita, data_disp=:data_disp, n_targa=:n_targa
                            where id=:id;
            ");

            self::$statement->bindParam(":disponibilita", self::$selectedVal, PDO::PARAM_STR);
            // echo self::$selectedVal;

            self::$statement->bindParam(":data_disp", $inputDateFormat, PDO::PARAM_STR);
            // echo $inputDateFormat;

            self::$statement->bindParam(":n_targa", self::$selectedCarPlate, PDO::PARAM_STR);
            // echo self::$selectedCarPlate;

            self::$statement->bindParam(":id", $_SESSION['id_posteggio'], PDO::PARAM_INT);
            // echo $_SESSION['id_posteggio'];

            try
            {
                self::$statement->execute();
            } catch (PDOException $e)
            {
                $_SESSION['addPark'] = 'Errore nel caricamento dell\'offerta!';
                ViewLoader::load('offerta/index');
            }
        }
        else
        {
            $_SESSION['noPark'] = 'Non hai un parcheggio!';
            ViewLoader::load('offerta/index');
        }
    }

}