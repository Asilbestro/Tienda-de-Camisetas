<?php

class Database
{
    public static function connect()
    {
        $db = new mysqli('localhost', 'root', '', 'tienda_master');
        $db->query("SET NAMES 'utf8'"); //Para que no hay problemas con las ñ y demás simbolos
        return $db;
    }
}
