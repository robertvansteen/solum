<?php namespace Solum\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainer;

class Container extends SymfonyContainer
{
	/**
	* Array of Facade aliases
	* 
	* @var array
	*/
	protected $aliases;		

	public function foo()
	{
		return "Bar";
	}

}

