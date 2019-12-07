<?php
/**
 * Classe model per la gestione della registrazione.
 */
namespace models;

use Controllers\Validator as Validator;
use Libs\Database as Database;
use Libs\ViewLoader;
use Models\MailModel as MailModel;
use PDO;
use PDOException;

class RegisterModel
{
    /**
     * @var Nome dell'utente.
     *
     * Parametro non opzionale.
     */
    private static $nome;

    /**
     * @var Cognome dell'utente.
     *
     * Parametro non opzionale.
     */
    private static $cognome;

    /**
     * @var Mail dell'utente.
     *
     * Parametro non opzionale.
     */
    private static $mail;

    /**
     * @var Via dell'utente.
     *
     * Parametro opzionale.
     */
    private static $via;

    /**
     * @var CAP dell'utente.
     *
     * Parametro opzionale.
     */
    private static $cap;

    /**
     * @var Città dell'utente.
     *
     * Parametro opzionale.
     */
    private static $citta;

    /**
     * @var Telefono dell'utente.
     *
     * Parametro non opzionale.
     */
    private static $tel;

    /**
     * @var Password dell'utente.
     *
     * Parametro non opzionale.
     */
    private static $password;

    /**
     * @var Query da eseguire.
     */
    private static $statement;

    /**
     * Funzione per eseguire la registrazione di un nuovo utente.
     */
    public static function register()
    {
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            self::validateInputs();
        }

        self::$statement = Database::get()->prepare("insert into utente 
                    (ruolo, nome, cognome, mail, via, cap, citta, tel, data_r, attivo, password, id_posteggio
                    ) values ('user', :nome, :cognome, :mail, :via, :cap, :citta, :tel, current_timestamp, false, :password, null);
        ");

        self::$statement->bindParam(':nome', self::$nome, PDO::PARAM_STR);
        self::$statement->bindParam(':cognome', self::$cognome, PDO::PARAM_STR);
        self::$statement->bindParam(':mail', self::$mail, PDO::PARAM_STR);
        self::$statement->bindParam(':via', self::$via, PDO::PARAM_STR);
        self::$statement->bindParam(':cap', self::$cap, PDO::PARAM_INT);
        self::$statement->bindParam(':citta', self::$citta, PDO::PARAM_STR);
        self::$statement->bindParam(':tel', self::$tel, PDO::PARAM_STR);
        self::$statement->bindParam(':password', self::$password, PDO::PARAM_STR);

        try
        {
            self::$statement->execute();
            MailModel::newUserMail(self::$mail, self::$nome, self::$cognome);
            ViewLoader::load('home/index', array('registrationOK'=>"Registrazione avvenuta con successo!"));
        } catch (PDOException $e)
        {
            ViewLoader::load('register/index', array('registrationNO'=>"Errore nella registrazione!"));
        }
    }

    public static function verify($mail, $nome, $cognome)
    {
        self::$statement = Database::get()->prepare("select mail, nome, cognome 
                    from utente where mail=:mail and nome=:nome and cognome=:cognome;
        ");

        self::$statement->bindParam(':mail', $mail, PDO::PARAM_STR);
        self::$statement->bindParam(':nome', $nome, PDO::PARAM_STR);
        self::$statement->bindParam(':cognome', $cognome, PDO::PARAM_STR);

        self::$statement->execute();
        $result = self::$statement->fetch(\PDO::FETCH_ASSOC);

        if($result > 0){
            self::$statement = Database::get()->prepare("update utente set attivo=true 
                        where mail=:mail and nome=:nome and cognome=:cognome and attivo=false
            ");

            self::$statement->bindParam(':mail', $mail, PDO::PARAM_STR);
            self::$statement->bindParam(':nome', $nome, PDO::PARAM_STR);
            self::$statement->bindParam(':cognome', $cognome, PDO::PARAM_STR);

            self::$statement->execute();

            ViewLoader::load('home/index', array('activationOK'=>"Il tuo account è stato attivato con successo!"));
        }else{
            ViewLoader::load('home/index', array('activationNO'=>"L'URL è invalido o il tuo account è già attivo!"));
        }
    }

    /**
     * Funzione che valida gli input tramite la classe Validator.
     */
    public static function validateInputs()
    {
        self::$nome = Validator::validateCharAndSpace($_POST['registrationName']);
        // echo self::$nome;
        self::$cognome = Validator::validateCharAndSpace($_POST['registrationSurname']);
        // echo self::$cognome;
        self::$mail = Validator::testInput($_POST['registrationMail']);
        // echo self::$mail;
        self::$via = Validator::validateVia($_POST['registrationStreet']);
        // echo self::$via;
        self::$cap = Validator::validateCAP($_POST['registrationCAP']);
        // echo self::$cap;
        self::$citta = Validator::validateCharAndSpace($_POST['registrationCity']);
        // echo self::$citta;
        self::$tel = Validator::validatePhoneNumber($_POST['registrationNumber']);
        // echo self::$tel;
        self::$password = hash('sha256', $_POST['registrationPassword']);
    }

}