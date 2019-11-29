<?php
/**
 * Classe model per la gestione  delle prenotazioni.
 */
namespace models;

use Libs\Application as Application;
use Libs\Database as Database;
use Libs\ViewLoader;
use Libs\Auth as Auth;

class ReserveModel
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
        $_SESSION['id_posteggio_prenotato'] = $id_parcheggio;

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

    /**
     * Funzione che crea una prenotazione.
     */
    public static function prenota()
    {
        self::$statement = Database::get()->prepare("insert into prenotazione 
                    (richiamo, data_prenotazione, id_utente, id_posteggio)
                    values
                    (false, current_timestamp, :id_utente, :id_posteggio);
        ");

        self::$statement->bindParam(':id_utente', $_SESSION['user_id'], \PDO::PARAM_INT);
        self::$statement->bindParam(':id_posteggio', $_SESSION['id_posteggio_prenotato'], \PDO::PARAM_INT);

        try
        {
            if (Auth::isAuthenticated())
            {
                self::$statement->execute();
                self::updateParcheggio();
                unset($_SESSION['id_posteggio_prenotato']);
                ViewLoader::load('home/index', array('prenotazioneOK'=>"Prenotazione avvenuta"));
            }
            else {
                ViewLoader::load("register/index", array('prenotazioneNO'=>"Devi prima registrarti"));
            }
        } catch (PDOException $e)
        {
            ViewLoader::load('prenotazione/index', array('parcheggio'=>self::$parcheggio, 'prenotazioneNO'=>"Prenotazione fallita"));
        }
    }

    /**
     * Funzione che aggiorna lo stato di un parcheggio prenotato.
     */
    public static function updateParcheggio()
    {
        self::$statement = Database::get()->prepare("update posteggio 
                            set disponibilita=null, data_disp=null, n_targa=null
                            where id=:id;
        ");

        self::$statement->bindParam(':id', $_SESSION['id_posteggio_prenotato'], \PDO::PARAM_INT);

        self::$statement->execute();
    }

}

