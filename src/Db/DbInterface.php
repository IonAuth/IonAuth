<?php
namespace BenEdmunds\IonAuth\Db;

interface DbInterface
{
    public function __construct($params, $username=null, $password=null, $driverOptions = array());
    public function beginTransaction();
    public function commit();
    public function errorCode();
    public function errorInfo();
    public function exec($statement);
    public function getAttribute($attribute);
    public function inTransaction();
    public function lastInsertId($name=NULL);
    public function prepare($statement, $driver_options=array());
    //public function query($statement);
    public function quote($string, $parameter_type=PDO::PARAM_STR);
    public function rollBack();
    public function setAttribute($attribute , $value);
}
