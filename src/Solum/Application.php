<?php namespace Solum;

use Symfony\Component\HttpKernel\HttpKernel;
use Solum\Facades\Facade;
use Solum\Container\Container;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;

class Application extends Container {	

	protected $aliases;

	protected $request;

	public function __construct() {
		parent::__construct();

		$this->registerBaseBindings();
		$this->registerProviders();
		$this->registerFacadeApplication();

		// Below here needs to be cleaned up
		
		$this->aliases = array(
			'App' => 'Solum\Facades\App',
			'View' => 'Solum\Facades\View',
			'Db' => 'Solum\Facades\Database',
			'Route' => 'Solum\Facades\Router',
			'Input' => 'Solum\Facades\Input',
			'Url' => 'Solum\Facades\Url',
			'Redirect' => 'Solum\Facades\Redirect'
		);

		$this->register('request', '\Symfony\Component\HttpFoundation\Request')
			->setArguments(array($_GET, $_POST, array(), $_COOKIE, $_FILES, $_SERVER));
		$this->get('request')->enableHttpMethodParameterOverride();

		$this->register('input', 'Solum\Http\Input')
			->setArguments(array(new Reference('request')));

		$this->register('routes', '\Symfony\Component\Routing\RouteCollection');

		$this->register('context', '\Symfony\Component\Routing\RequestContext');

		$this->get('context')->fromRequest($this->get('request'));

		$this->register('matcher', '\Symfony\Component\Routing\Matcher\UrlMatcher')
			->setArguments(array(new Reference('routes'), new Reference('context')));

		$this->register('generator', '\Symfony\Component\Routing\Generator\UrlGenerator')
			->setArguments(array(new Reference('routes'), new Reference('context')));

		$this->register('resolver', '\Symfony\Component\HttpKernel\Controller\ControllerResolver');

		$this->register('listener.router', '\Symfony\Component\HttpKernel\EventListener\RouterListener')
			->setArguments(array(new Reference('matcher')));

		$this->register('listener.response', '\Symfony\Component\HttpKernel\EventListener\ResponseListener')
			->setArguments(array('UTF-8'));

		$this->register('listener.exception', '\Symfony\Component\HttpKernel\EventListener\ExceptionListener')
			->setArguments(array('App\\Controller\\ErrorController::exceptionAction'));

		$this->register('listener.string_response', 'Solum\Events\StringResponseListener');

		$this->register('listener.controller', 'Solum\Events\ControllerListener');

		$this->register('dispatcher', '\Symfony\Component\EventDispatcher\EventDispatcher')
			->addMethodCall('addSubscriber', array(new Reference('listener.router')))
			->addMethodCall('addSubscriber', array(new Reference('listener.response')))
			->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
			->addMethodCall('addSubscriber', array(new Reference('listener.string_response')))
			->addMethodCall('addSubscriber', array(new Reference('listener.controller')));

		$this->register('kernel', '\Symfony\Component\HttpKernel\HttpKernel')
			->setArguments(array(new Reference('dispatcher'), new Reference('resolver')));

		spl_autoload_register(array($this, 'load'));

		$this->registerCoreContainerAliases();

		$this->get('database')->boot();
	}

	/**
	* Register the base bindings of the application
	*
	* @return void
	*/
	protected function registerBaseBindings()
	{
		$this->register('Solum\Container\Container', $this);
	}	

	/**
	* Register the providers in the IoC container
	*
	* @param type $name
	* @return void
	*/
	protected function registerProviders()
	{
		$this->register('router', 'Solum\Routing\Router')
			->setArguments(array(new Reference('routes')));
		$this->register('view', 'Solum\View\View')
			->setArguments(array(new Reference('generator')));
		$this->register('database', 'Solum\Database\Database');
		$this->register('redirect', 'Solum\Http\Redirect');
	}

	/**
	* Register the facade application
	*
	* @param type $name
	* @return void
	*/
	protected function registerFacadeApplication()
	{
		Facade::setFacadeApplication($this);
	}

	/**
	* Register the core class aliases in the container
	*
	* @return void
	*/
	protected function registerCoreContainerAliases()
	{
		$aliases = array(
			'route' 		=> 'Solum\Routing',
		);

		foreach($aliases as $key => $alias)
		{
			$this->setAlias($key, $alias);	
		}
	}

	/**
	 * Run the application and send the reponse to the appropriate response class
	 *
	 * @return void
	 */
	public function run($request = null) {
		$request = $request ?: $this->get('request');
		$response = $this->get('kernel')->handle($request);
		$response->send();
	}

	/**
	 * When a class can't be found, this method is called via the autoload_register.
	 * If the class is in the alias array we return it.
	 *
	 * @return mixed
	 */
	public function load($alias)
	{
		if(isset($this->aliases[$alias]))
		{
			return class_alias($this->aliases[$alias], $alias);
		}
	}



}
