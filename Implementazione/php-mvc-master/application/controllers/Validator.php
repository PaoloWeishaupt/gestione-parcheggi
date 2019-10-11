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

    public static function validateInt($element)
    {
        if(preg_match('/^[0-9]+$/', self::testInput($element)))
        {
            return $element;
        }
        return intval(self::testInput($element));
    }

    public static function validateDate($element)
    {
        $inputDate = date_create($element);
        $inputDateFormat = date_format($inputDate, 'Y-m-d');
        $today = date('Y-m-d');
        
        /*echo "Input date: ";
        var_dump($inputDate);
        echo "Input date format: ";
        var_dump($inputDateFormat);
        echo "Today: ";
        var_dump($today);*/

        $_SESSION['selectedDate'] = $inputDateFormat;

        if($inputDateFormat >= $today)
        {
            return $inputDateFormat;
        }         

        $_SESSION['dateError'] = "Data non valida!";
    }

    public static function validateCarPlate($element)
    {
        $_SESSION['carPlate'] = $element;
        if(preg_match('/^(AG|AI|AR|BE|BL|BS|FR|GE|GL|GR|JU|LU|NE|NW|OW|SG|SH|SO|SZ|TG|TI|UR|VD|VS|ZG|ZH)-[0-9]{1,6}+$/', self::testInput($element)))
        {
            return $element;
        }

        $_SESSION['carPlateError'] = "Targa non valida!";
    }
}