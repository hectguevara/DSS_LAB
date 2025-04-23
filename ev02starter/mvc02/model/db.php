<?php
require_once 'config/config.php';

class Db {
    public static function connect() {
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
