<?php namespace Solum;

use Symfony\Component\HttpKernel\HttpKernel;
use Solum\Facades\Facade;
use Solum\Container\Container;
use Symfony\Component\DependencyInjection\Reference;

class Application extends Container {	

	public function __construct($routes) {
		parent::__construct();

		$this->registerBaseBindings();
		$this->registerProviders();
		$this->registerFacadeApplication();

		$this->aliases = array(
			'App' => 'Solum\Facades\App',
			'View' => 'Solum\Facades\View'
		);

		$this->register('context', '\Symfony\Component\Routing\RequestContext');

		$this->register('matcher', '\Symfony\Component\Routing\Matcher\UrlMatcher')
			->setArguments(array($routes, new Reference('context')));

		$this->register('resolver', '\Symfony\Component\HttpKernel\Controller\ControllerResolver');

		$this->register('listener.router', '\Symfony\Component\HttpKernel\EventListener\RouterListener')
			->setArguments(array(new Reference('matcher')));

		$this->register('listener.response', '\Symfony\Component\HttpKernel\EventListener\ResponseListener')
			->setArguments(array('UTF-8'));

		$this->register('listener.exception', '\Symfony\Component\HttpKernel\EventListener\ExceptionListener')
			->setArguments(array('App\\Controller\\ErrorController::exceptionAction'));

		$this->register('listener.string_response', 'Solum\Events\StringResponseListener');

		$this->register('dispatcher', '\Symfony\Component\EventDispatcher\EventDispatcher')
			->addMethodCall('addSubscriber', array(new Reference('listener.router')))
			->addMethodCall('addSubscriber', array(new Reference('listener.response')))
			->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
			->addMethodCall('addSubscriber', array(new Reference('listener.string_response')));

		$this->register('kernel', '\Symfony\Component\HttpKernel\HttpKernel')
			->setArguments(array(new Reference('dispatcher'), new Reference('resolver')));

		spl_autoload_register(array($this, 'load'));

		$this->registerCoreContainerAliases();
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
		$this->register('router', 'Solum\Routing\Router');
		$this->register('view', 'Solum\View\View');
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
			'router' 		=> 'Solum\Routing',
		);

		foreach($aliases as $key => $alias)
		{
			$this->setAlias($key, $alias);	
		}
	}

	public function run($request) {
		$response = $this->get('kernel')->handle($request);
		$response->send();
	}

	public function load($alias)
	{
		if(isset($this->aliases[$alias]))
		{
			return class_alias($this->aliases[$alias], $alias);
		}
	}

	public function bar()
	{
		return "Foo!";
	}
}
