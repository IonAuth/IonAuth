<?php
namespace IonAuth\IonAuth\Repositories;

use IonAuth\IonAuth\Config;
use IonAuth\IonAuth\Db;


class UserRepository extends UserRepository implements RepositoryInterface {

	protected $db;
	protected $statement;
	protected $table;

    private function __construct(Config $config, DbInterface $db) {

    	$this->config = $config;
    	$this->db     = $db;
    	$this->table  = $config->tables['users'];

    }

}