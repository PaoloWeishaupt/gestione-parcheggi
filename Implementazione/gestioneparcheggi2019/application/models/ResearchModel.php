<?php
/**
 * Classe model per gestire la tabella della ricerca dei parcheggi disponibili.
 */
namespace models;

use Libs\Database as Database;

class ResearchModel
{
    /**
     * @var Array dei parcheggi disponibili.
     */
    public static $parcheggi;

    /**
     * @var Query da eseguire.
     */
    private static $statement;

    /**
     * Funzione che interroga il database per ricavarne una lista dei parcheggi disponibili.
     */
    public static function getParcheggiDisponibili()
    {
        self::$statement = Database::get()->prepare("select * from posteggio where data_disp is not null");
        self::$statement->execute();

        self::$parcheggi = self::$statement->fetchAll(\PDO::FETCH_ASSOC);

        self::formatCarAndDate();
    }

    /**
     * Funzione che filtra i posteggi disponibili in base alle date scelte dall'utente.
     */
    public static function filterByDate($startDate, $endDate)
    {
        $startDateFormat = date_format(date_create($startDate), "Y-m-d H:i:s");
        $endDateFormat = date_format(date_create($endDate), "Y-m-d H:i:s");

        if($startDateFormat > $endDateFormat)
        {
            $_SESSION['minDateError'] = 'Errore: la data iniziale è più grande di quella finale';
        }
        else
        {
            unset($_SESSION['minDateError']);
        }

        self::$statement = Database::get()->prepare("select * from posteggio where data_disp between :start_date and :end_date");
        self::$statement->bindParam(':start_date', $startDateFormat, \PDO::PARAM_STR);
        self::$statement->bindParam(':end_date', $endDateFormat, \PDO::PARAM_STR);
        self::$statement->execute();

        self::$parcheggi = self::$statement->fetchAll(\PDO::FETCH_ASSOC);

        self::formatCarAndDate();
    }

    /**
     * Funzione che filtra i posteggi disponibili in base alla disponibilità scelta dall'utente.
     *
     * @param $disp Disponibilità selezionata nel filtro.
     */
    public static function filterByDisp($disp)
    {
        if($disp == "Tutto")
        {
            self::$statement = Database::get()->prepare("select * from posteggio where data_disp is not null");
        }
        else
        {
            self::$statement = Database::get()->prepare("select * from posteggio where data_disp is not null and disponibilita = :disp");
            self::$statement->bindParam(':disp', $disp, \PDO::PARAM_STR);
        }
        self::$statement->execute();

        self::$parcheggi = self::$statement->fetchAll(\PDO::FETCH_ASSOC);

        self::formatCarAndDate();
    }

    /**
     * Funzione che formatta il numero di targa e la data.
     */
    public static function formatCarAndDate()
    {
        foreach(self::$parcheggi as &$row)
        {
            if(is_null($row['n_targa']))
            {
                $row['n_targa'] = "";
            }
            $inputDate = date_create($row['data_disp']);
            $inputDateFormat = date_format($inputDate, 'd-m-Y');
            $row['data_disp'] = $inputDateFormat;
        }
    }
}