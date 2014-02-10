<?php namespace Solum\Routing;

use Symfony\Component\Routing\Route;

class Router
{

	protected $container;

	public function __construct(\Symfony\Component\Routing\RouteCollection $routes)
	{
		$this->routes = $routes;
	}

	/**
	* Register a new route that responds to a GET request
	*
	* @param string $uri
	* @param mixed $callable
	* @return \Symfony\Component\Routing\Route;
	*/
	public function get($name, $uri, $callable, $parameter = null, $default = null)
	{
		$this->add($name, $uri, $callable, array('GET'), $parameter, $default);
	}

	/**
	* Register a new route that responds to a POST request
	*
	* @param string $uri
	* @param mixed $callable
	* @return \Symfony\Component\Routing\Route;
	*/
	public function post($name, $uri, $callable, $parameter = null, $default = null)
	{
		$this->add($name, $uri, $callable, array('POST'), $parameter, $default);
	}

	/**
	* Register a new route that responds to a PUT request
	*
	* @param string $uri
	* @param mixed $callable
	* @return \Symfony\Component\Routing\Route;
	*/
	public function put($name, $uri, $callable, $parameter = null, $default = null)
	{
		$this->add($name, $uri, $callable, array('PUT'), $parameter, $default);
	}

	/**
	* Register a new route that responds to a DELETE request
	*
	* @param string $uri
	* @param mixed $callable
	* @return \Symfony\Component\Routing\Route;
	*/
	public function delete($name, $uri, $callable, $parameter = null, $default = null)
	{
		$this->add($name, $uri, $callable, array('DELETE'), $parameter, $default);
	}

	/**
	* Add a route to the collection
	*
	* @param type $name
	* @return void
	*/
	protected function add($name, $uri, $callable, $httpMethods, $parameter, $default)
	{
		$route = new Route(
			$uri,
			array('_controller' => $callable, $parameter => $default), // Defaults
			array(), // Requirements
			array(), // Options
			'', // Host
			array(), //Schemes
			$httpMethods // Methods
		);

		$this->routes->add($name, $route);
	}
}	
