<?php
/**
 * Classe per la validazione dei dati.
 */
namespace Controllers;

use Controllers\ErrorPage as ErrorPage;

class Validator
{

    public static function testInput($element)
    {
        return trim(stripslashes(htmlspecialchars($element)));
    }

    public static function validateCAP($element)
    {
        $_SESSION['validateCAP'] = $element;

        $pattern = '/^\d{4,5}$/';
        if(preg_match($pattern, self::testInput($element)))
        {
            return $element;
        }

        $_SESSION['CAPerror'] = "CAP errato";
    }

    public static function validateCharAndSpace($element)
    {
        $_SESSION['validateCharAndSpace'] = $element;

        $pattern = '/^[a-zA-Zàáâäãåaccèéìínòóùú ,.\'-]+$/u';
        if(preg_match($pattern, self::testInput($element)))
        {
            return $element;
        }

        $_SESSION['CharAndSpaceError'] = 'Non sono accettati numeri';
    }

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

    public static function validateDate($element)
    {
        $inputDate = date_create($element);
        $inputDateFormat = date_format($inputDate, 'd-m-Y');
        $today = date('d-m-Y');
        
        /*
        For debug*/
        echo "Input date: ";
        var_dump($inputDate);
        echo "Input date format: ";
        var_dump($inputDateFormat);
        echo "Today: ";
        var_dump($today);

        $_SESSION['selectedDate'] = $inputDateFormat;

        if($inputDateFormat >= $today)
        {
            return $element;
        }         

        $_SESSION['dateError'] = "Data non valida!";
    }

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