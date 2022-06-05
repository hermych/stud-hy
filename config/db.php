<?php
class Database
{
  public static function connect()
  {
    date_default_timezone_set('America/Lima');
    $db = new mysqli('localhost', 'root', '', "studhy");
    $db->set_charset("utf8");
    return $db;
  }
}
