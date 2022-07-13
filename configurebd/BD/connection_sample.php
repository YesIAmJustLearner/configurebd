<?php
class Conexao
{
    private static $instance;

    public static function getConn()
    {
        $servername = '{{$servername}}';
        $username = '{{$username}}';
        $password = '{{$password}}';
        $db_name = '{{$db_name}}';
        if (!isset(self::$instance)) :
            self::$instance = new \PDO('mysql:host=' . $servername . ';dbname=' . $db_name . ';charset=utf8', $username, $password);
        //self::$instance = new \PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $username, $password);
        endif;
        return self::$instance;
    }
}
