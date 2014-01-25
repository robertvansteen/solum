<?php namespace Solum\Database;

use Doctrine\DBAL as Doctrine;

class Database 
{
	protected $config;

	public function __construct()
	{
		$this->config = new Doctrine\Configuration();
		$this->parameters = require_once("../app/Acme/config/database.php"); 
		$this->connection = Doctrine\DriverManager::getConnection($this->parameters, $this->config);
	}

	public function query($query)
	{
		return $this->connection->query($query);
	}

}

