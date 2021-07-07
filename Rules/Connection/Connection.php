<?php 

class Connection {
    private static $i;

    static function Con() {
        if(!isset(self::$i)) {
            try {
                self::$i = new PDO('mysql:dbname=a_news; host=localhost','root', 'root');
            } catch (Exception $e) {
                echo 'Erro : '.$e->getMessage();
                exit;
            }
        }

        return self::$i;
    }
}