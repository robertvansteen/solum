<?php namespace Solum\Http;

use Symfony\Component\HttpFoundation\RedirectResponse;

class Redirect {

	/**
	 * Send a response that redirects to given URL
	 *
	 * @param string  $url
	 */

	public function to($url)
	{
		$response = new RedirectResponse($url);
		$response->send();
	}

}
