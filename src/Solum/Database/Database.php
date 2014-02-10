<?php namespace Solum\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database extends Capsule
{

	/**
	 * Solum uses Laravel's awesome Illuminate database component so
	 * all we need to is extend it and boot it.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::__construct();
		$config = require_once("../app/config/database.php"); 
		$this->addConnection($config);
		$this->bootEloquent();
	}


}

