<?php namespace Acme\Controller;

class BaseController {

	public $container;

	public function __construct(ContainerInterface $container = null) {
		$this->container = $container;
	}

}
