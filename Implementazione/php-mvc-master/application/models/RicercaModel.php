<?php


namespace models;

use Libs\Database as Database;

class RicercaModel
{
    private static $statement;
    public static $parcheggi;

    public static function getParcheggiDisponibili()
    {
        self::$statement = Database::get()->prepare("select * from posteggio where data_disp is not null");
        self::$statement->execute();
        self::$parcheggi = self::$statement->fetchAll();

        foreach(self::$parcheggi as $row)
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