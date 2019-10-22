<?php 
namespace Models;

use Libs\Database as Database;
use Libs\Auth as Auth;

class LoginModel
{

    public static function log($email, $pass)
    {
        $statement = Database::get()->prepare("select * from utente where mail=:email AND password=:pass");

        //inserisco i parametri
        $statement->bindParam(':email', $email, \PDO::PARAM_STR);
        $statement->bindParam(':pass', $pass, \PDO::PARAM_STR);

        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if($result > 0) 
        {
            Auth::auth();
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['ruolo'] = $result['ruolo'];
            $_SESSION['nome'] = $result['nome'];
            $_SESSION['id_posteggio'] = $result['id_posteggio'];
            //var_dump($result['nome']);
            return true;
        } else {
            Auth::logout();
            $_SESSION['loginError'] = true;
            return false;
        }
    }
}
