<?php

class Database {
private static $db="cabinet";
private static $dbhost="localhost";
private static $dbport=3306;
private static $dbuser="root";
private static $dbpasswd="hello";
private static $pdo=null;

function __construct() {
    if(!Database::$pdo){
    Database::$pdo = new PDO('mysql:host='. self::getDbhost().';port='. self::getDbport().';dbname='. self::getDb().'', self::getDbuser(), self::getDbpasswd());
    Database::$pdo->exec("SET CHARACTER SET utf8");
    }
}
function setParam($host,$port,$db,$user,$pass){
    self::setDbhost($host);
    self::setDbport($port);
    self::setDb($db);
    self::setDbuser($user);
    self::setDbpasswd($pass);
    
    $pdo = new PDO('mysql:host='. self::getDbhost().';port='. self::getDbport().';dbname='. self::getDb().'', self::getDbuser(), self::getDbpasswd());
    $pdo->exec("SET CHARACTER SET utf8");
    self::setPdo($pdo);
}

function __destruct() {
}
function update($sql){
    $stmt = Database::$pdo->prepare($sql);
    return $stmt->execute();
}
function retrieve($sql){
    $result = Database::$pdo->query($sql);
    return $result; 
}
static function getDb() {
    return self::$db;
}

static function getDbhost() {
    return self::$dbhost;
}

static function getDbport() {
    return self::$dbport;
}

static function getDbuser() {
    return self::$dbuser;
}

static function getDbpasswd() {
    return self::$dbpasswd;
}

static function getPdo() {
    return self::$pdo;
}

static function setDb($db): void {
    self::$db = $db;
}

static function setDbhost($dbhost): void {
    self::$dbhost = $dbhost;
}

static function setDbport($dbport): void {
    self::$dbport = $dbport;
}

static function setDbuser($dbuser): void {
    self::$dbuser = $dbuser;
}

static function setDbpasswd($dbpasswd): void {
    self::$dbpasswd = $dbpasswd;
}

static function setPdo($pdo): void {
    self::$pdo = $pdo;
}


}
