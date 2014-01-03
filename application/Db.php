<?php

/**
 * Database class
 */

class Db {

    public $isConnected;
    protected $datab;

    public function __construct($username = 'spwodna_cargo', $password = '9Kib0VgJXh', $host = 'mysql3.zenbox.pl', $dbname = 'spwodna_cargo', $options = array()) {
        $this->isConnected = true;
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->isConnected = false;
            throw new Exception($e->getMessage());
        }
    }

    public function Disconnect() {
        $this->datab = null;
        $this->isConnected = false;
    }

    public function getRow($query, $params = array()) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getRows($query, $params = array()) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    
}
