<?php namespace Solum\Routing;

class Router
{

	public function __construct()
	{
		var_dump("Instantiated!");
	}

	public function foo()
	{
		return "Router: Bar!";
	}
}
