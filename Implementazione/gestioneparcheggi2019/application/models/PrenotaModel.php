<?php
/**
 * Classe model per la gestione  delle prenotazioni.
 */
namespace models;

use Libs\Database as Database;

class PrenotaModel
{
    /**
     * @var Parcheggio del quale ricevere le informazioni.
     */
    public static $parcheggio;

    /**
     * @var Query da eseguire.
     */
    private static $statement;

    /**
     * Funzione che interroga il database per ricevere le informazioni del parcheggio selezionato.
     *
     * @param $id_parcheggio Id del parcheggio selezionato.
     */
    public static function getParcheggioInfo($id_parcheggio)
    {
        self::$statement = Database::get()->prepare(
            "SELECT utente.nome, utente.cognome, utente.tel, parametri.costo, posteggio.data_disp,
                        posteggio.disponibilita, posteggio.n_targa
                        FROM utente, parametri, posteggio
                        WHERE posteggio.id = :id
                        AND utente.id_posteggio = :id;
                        ");
        self::$statement->bindParam(':id', $id_parcheggio, \PDO::PARAM_INT);
        self::$statement->execute();
        self::$parcheggio = self::$statement->fetch(\PDO::FETCH_ASSOC);

        if(is_null(self::$parcheggio['n_targa']))
        {
            self::$parcheggio['n_targa'] = "Targa non fornita";
        }
        $inputDate = date_create(self::$parcheggio['data_disp']);
        $inputDateFormat = date_format($inputDate, 'd-m-Y');
        if(self::$parcheggio['disponibilita'] == "Mattina" || self::$parcheggio['disponibilita'] == "Pomeriggio")
        {
            self::$parcheggio['costo'] /= 2;
        }
        self::$parcheggio['data_disp'] = $inputDateFormat;
    }

    public static function prenota(){
        
    }
}

