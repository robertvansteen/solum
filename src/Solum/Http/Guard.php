<?php namespace Solum\Http;

class Guard {

	protected $generator;

	protected $session;

	protected $redirect;

	public function __construct(\Symfony\Component\Routing\Generator\UrlGenerator $generator, \Symfony\Component\HttpFoundation\Session\Session $session, \Solum\Http\Redirect $redirect) {
		$this->generator = $generator;
		$this->session = $session;
		$this->redirect = $redirect;
	}

	/**
	 * Check if the user is logged in, if not redirect them to the login page
	 *
	 * @return void
	 */
	public function protect()
	{
		if(!$this->session->get('username')) {
			$this->session->getFlashBag()->add('warning', 'You are not allowed to visit that page, please login.');
			$this->redirect->to($this->generator->generate('login.get'));
		}
	}

}
