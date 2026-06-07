<?php

abstract class Banco {

    private static ?mysqli $conn = null;

    public static function getConn(): mysqli {
        if (self::$conn === null) {
            self::$conn = new mysqli(
                'localhost',
                'root',
                '',
                'barberflow' 
            );
            
            self::$conn->set_charset("utf8mb4");
        }
        return self::$conn; 
    }
}
?>