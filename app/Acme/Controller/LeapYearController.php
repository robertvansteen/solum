<?php namespace Acme\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acme\Model\LeapYear;

Class LeapYearController 
{
	public function indexAction(Request $request, $year = null)
	{
		$leapyear = new LeapYear();
		if($leapyear->isLeapYear($year)) {
			return View::make('index.php');
		}

		return View::make('index.php');
	}
		
}
