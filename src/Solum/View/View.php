<?php namespace Solum\View;

use Twig_Loader_Filesystem as TwigFilesystem;
use Twig_Environment as TwigEnvironment;

class View 
{
	protected $loader;

	protected $twig;
		
	public function __construct(\Symfony\Component\Routing\Generator\UrlGenerator $generator) 
	{
		$this->loader = new TwigFilesystem('../app/views/');
		$this->twig = new TwigEnvironment($this->loader);
		$this->twig->addGlobal('url', $generator);
	}

	/**
	 * Render a file with the twig template engine
	 *
	 * @param string $filename
	 * @param array $args
	 *
	 * @return mixed
	 */

	public function make($filename, $args = null)
	{
		if($args)
			return $this->twig->render($filename, $args);

		return $this->twig->render($filename);
	}
}
