<?php namespace Solum\Facades;

class App extends Facade {

	/**
	* Overwrite the default method because in this case we are returning the application itself instead
	* of something out of the IoC container
	*
	* @return Solum\Application
	*/
	protected static function resolveFacadeInstance()
	{
		return static::$app;
	}

	protected static function getFacadeAccessor() { return 'app'; }	
}
