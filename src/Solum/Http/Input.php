<?php namespace Solum\Http;

class Input {

	protected $request;

	public function __construct($request)
	{
		$this->request = $request;
	}

	public function allPost()
	{
		return $this->request->request->all();
	}

}
