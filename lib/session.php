<?php
class Session {
    private static function _sessionStart() {
        session_start();
    }

    public static function loginCheck() {
        self::_sessionStart();
        if (empty($_SESSION['user_id'])) {
            header('Location: ./login.php');
        }
    }
}
?>







<?php
/*
class Session {

    private static function _sessionStart() {
        session_start();
        echo 'adfs';
    }



    public static function loginCheck() {
        self::_sessionStart();
        print_r($_SESSION);
        if (empty($_SESSION['user_id'])) {
            header('Location: ./login.php');
        }



    }
}
 */






?>
