<?php namespace Solum\Events;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

class ControllerListener implements EventSubscriberInterface 
{
	public function beforeController()
	{
	}

	public function afterController()
	{
	}
	

	public static function getSubscribedEvents()
	{
		return array('kernel.controller' => 'beforeController', 'kernel.response' => 'afterController');
	}
}
