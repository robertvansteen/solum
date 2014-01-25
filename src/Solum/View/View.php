<?php namespace Solum\View;

use Twig_Loader_Filesystem as TwigFilesystem;
use Twig_Environment as TwigEnvironment;

class View 
{
	protected $loader;

	protected $twig;
		
	public function __construct() 
	{
		$this->loader = new TwigFilesystem('../app/Acme/Views/');
		$this->twig = new TwigEnvironment($this->loader, array(
			'cache' => '../app/Acme/Views/.cache'
		));
	}

	public function make($filename, $args = null)
	{
		if($args)
			return $this->twig->render($filename, $args);

		return $this->twig->render($filename);
	}
}
