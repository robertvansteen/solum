<?php namespace Solum\View;

use Twig_Loader_Filesystem as TwigFilesystem;
use Twig_Environment as TwigEnvironment;

class View 
{
	protected $loader;

	protected $twig;
		
	public function __construct(\Symfony\Component\Routing\Generator\UrlGenerator $generator, \Symfony\Component\HttpFoundation\Session\Session $session) 
	{
		$this->loader = new TwigFilesystem('../app/views/');
		$this->twig = new TwigEnvironment($this->loader, array('debug' => true));
		$this->twig->addExtension(new \Twig_Extension_Debug());
		$this->twig->addGlobal('url', $generator);
		$messages = $session->getFlashBag()->get('message');
		$warnings = $session->getFlashBag()->get('warning');
		$username = $session->get('username');
		$this->twig->addGlobal('messages', $messages);
		$this->twig->addGlobal('warnings', $warnings);
		$this->twig->addGlobal('username', $username);
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
