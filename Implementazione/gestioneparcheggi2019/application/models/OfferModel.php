<?php
/**
 * Classe model per la gestione delle offerte.
 */
namespace models;

use Controllers\Validator as Validator;
use Libs\Database as Database;
use Libs\ViewLoader as ViewLoader;
use Models\Users as Users;
use PDO;


class OfferModel
{

    /**
     * @var Disponibilità.
     */
    private static $selectedVal;

    /**
     * @var Data della disponibilità.
     */
    private static $selectedDate;

    /**
     * @var Numero di targa.
     */
    private static $selectedCarPlate;

    /**
     * @var Query da eseguire.
     */
    private static $statement;

    /**
     * Funzione per l'aggiunta di un'offerta.
     */
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
        else
        {
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
                    ViewLoader::load('home/index', array('offertaOK'=>"Offerta andata a buon fine"));
                } catch (\PDOException $e)
                {
                    $_SESSION['addPark'] = 'Errore nel caricamento dell\'offerta!';
                    ViewLoader::load('offerta/index');
                }
            }
            else
            {
                $_SESSION['noPark'] = 'Non hai un parcheggio!';
                unset($_SESSION['selectedDate']);
                unset($_SESSION['carPlate']);
                ViewLoader::load('offerta/index');
                unset($_SESSION['noPark']);
            }
        }
    }
}












