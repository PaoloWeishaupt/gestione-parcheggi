<?php
/**
 * Classe model per gestire la tabella della ricerca dei parcheggi disponibili.
 */
namespace models;

use Libs\Database as Database;

class RicercaModel
{
    /**
     * @var Array dei parcehggi disponibili.
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