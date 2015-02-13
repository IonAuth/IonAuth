<?php
namespace IonAuth\IonAuth\Repositories;

use IonAuth\IonAuth\Config;
use IonAuth\IonAuth\Db;

class Repository implements RepositoryInterface
{

    protected $db;
    protected $statement;
    protected $table;

    public function get($key, $value) {

        $this->statement = $db->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $key . ' = :' . $key);
        $this->statement->execute([':'.$key => $value]);

    }


    public function row() {

        return $this->statement->fetch(PDO::FETCH_OBJ);

    }

    public function result() {

        return $this->statement->fetchAll(PDO::FETCH_CLASS);

    }

    public function count() {

        return $this->statement->rowCount();

    }
}
