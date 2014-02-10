<?php namespace Solum\Http;

use Symfony\Component\HttpFoundation\RedirectResponse;

class Redirect {

	public function to($url)
	{
		$response = new RedirectResponse($url);
		$response->send();
	}

}
