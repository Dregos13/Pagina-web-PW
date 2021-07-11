<?php
class Database{

	public $DB_HOST = "localhost";
	public $DB_USER = "practica";
	public $DB_PASS = "practica";
	public $DB_DATABASE = "fn";

	public function connect(){

		$db = new mysqli($this-> DB_HOST,$this-> DB_USER,$this-> DB_PASS,$this-> DB_DATABASE);

        return $db;
    }

}
