<?php namespace Solum\Facades;

abstract class Facade {

	/**
	 * The application instance
	 *
	 * @var Solum/Application
	 */
	protected static $app;

	/**
	* The object instance that is resolved
	* 
	* @var array
	*/
	protected static $resolvedInstance;	

	/**
	* Set the application instance
	*
	* @param Solum\Application $name
	* @return void
	*/
	public static function setFacadeApplication($app)
	{
		static::$app = $app;
	}	

	/**
	* Resolve the facade instance from the app
	*
	* @param string $name
	* @return mixed
	*/
	protected static function resolveFacadeInstance($name)
	{
		return static::$resolvedInstance[$name] = static::$app->get($name);
	}	

	/**
	* Get the registered name of the component
	*
	* @return string
	*/
	protected static function getFacadeAccessor()
	{
		// Replace with exception!
		die('No facade name found');
	}

	/**
	* Handles dynamic, static calls to the object
	*
	* @param string $method
	* return mixed
	*/
	public static function __callStatic($method, $args)
	{
		$instance = static::resolveFacadeInstance(static::getFacadeAccessor());
		return call_user_func_array(array($instance, $method), $args);
	}
}
