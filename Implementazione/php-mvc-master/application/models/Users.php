<?php
/**
 * Classe model per gi utenti.
 */
namespace Models;

class Users
{
    public static function checkRuolo()
    {
        if(isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'admin')
        {
            return true;
        }
        return false;

    }

    public static function hasParcheggio()
    {
        if(isset($_SESSION['id_posteggio']))
        {
            return true;
        }
        return false;
    }

}
