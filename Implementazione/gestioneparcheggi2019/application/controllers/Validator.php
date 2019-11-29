<?php
/**
 * Classe per la validazione dei dati.
 */
namespace Controllers;

use Controllers\ErrorPage as ErrorPage;

class Validator
{
    /**
     * Funzione per evitare injection.
     */
    public static function testInput($element)
    {
        return trim(stripslashes(htmlspecialchars($element)));
    }

    /*
     * Funzione per la validazione del CAP con il formato svizzero.
     * Formato svizzero = 4 cifre.
     */
    public static function validateCAP($element)
    {
        $_SESSION['validateCAP'] = $element;

        $pattern = '/^\d{4}$/';
        if(preg_match($pattern, self::testInput($element)))
        {
            return $element;
        }

        $_SESSION['CAPerror'] = "CAP errato";
    }

    /*
     * Funzione per il controllo delle stringhe che non accettano caratteri speciali e numeri.
     */
    public static function validateCharAndSpace($element)
    {
        $_SESSION['validateCharAndSpace'] = $element;

        $pattern = '/^[a-zA-Zàáâäãåaccèéìínòóùú ,.\'-]+$/u';
        if(preg_match($pattern, self::testInput($element)))
        {
            return $element;
        }

        $_SESSION['CharAndSpaceError'] = 'Non sono accettati caratteri speciali e numeri';
    }

    /*
     * Funzione per la validazione di una via.
     * Pattern = string + spazio + da uno a 3 numeri + eventuale lettera.
     */
    public static function validateVia($element)
    {
        $_SESSION['validateVia'] = $element;

        $pattern = '/^[a-zA-Z ]* \d{1,3}[a-zA-Z]{0,1}+$/';
        if(preg_match($pattern, self::testInput($element)))
        {
            return $element;
        }

        $_SESSION['viaError'] = 'Via errata';
    }

    /*
     * Funzione per la validazione di un numero svizzero.
     * Numero svizzero:
     *
     * 07X XXX XX XX
     * 0041 7X XXX XX XX
     * +41 7X XXX XX XX
     */
    public static function validatePhoneNumber($element)
    {
        $_SESSION['validatePhoneNumber'] = $element;

        $pattern = '/^(\+41|0041|0){1}(\(0\))?[0-9]{9}$/';
        if(preg_match($pattern, self::testInput($element)))
        {
            return $element;
        }

        $_SESSION['phoneError'] = 'Numero di telefono errato';
    }

    /*
     * Funzione per la validazione di una data. Per essere valida una data non deve essere inferiore a quella corrente.
     */
    public static function validateDate($element)
    {
        $inputDate = date_create($element);
        $today = date_create();

        //For debug
        /*echo "Input date: ";
        var_dump($inputDate);
        echo "Today: ";
        var_dump($today);*/

        $_SESSION['selectedDate'] = $element;

        if($inputDate >= $today)
        {
            return $element;
        }         

        $_SESSION['dateError'] = "Data non valida!";
    }

    /*
     * Funzione per la validazione di una targa svizzera.
     * Pattern = (Iniziali del cantone) + da 1 a 6 numeri.
     */
    public static function validateCarPlate($element)
    {
        $_SESSION['carPlate'] = $element;
        if(preg_match('/^(AG|AI|AR|BE|BL|BS|FR|GE|GL|GR|JU|LU|NE|NW|OW|SG|SH|SO|SZ|TG|TI|UR|VD|VS|ZG|ZH)-[0-9]{1,6}+$/', self::testInput($element)) || empty($element))
        {
            return $element;
        }

        $_SESSION['carPlateError'] = "Targa non valida!";
    }
}