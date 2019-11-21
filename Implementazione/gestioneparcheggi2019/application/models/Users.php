<?php
/**
 * Classe model per la gestione degli utenti.
 */
namespace Models;

class Users
{

    /**
     * Funzione per ricavare il ruolo di un utente.
     * @return bool True se l'utente è un admin. Altrimenti false.
     */
    public static function checkRuolo()
    {
        if(isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'admin')
        {
            return true;
        }
        return false;

    }

    /**
     * Funzione per vedere se un utente ha un parcheggio.
     * @return bool True se l'utente ha un parcehggio. Altrimenti false.
     */
    public static function hasParcheggio()
    {
        if(isset($_SESSION['id_posteggio']))
        {
            return true;
        }
        return false;
    }

}
