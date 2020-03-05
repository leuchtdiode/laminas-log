<?php
namespace Log;

use Common\Module\PluginChain;
use Log\ModulePlugin\GlobalLogPlugin;
use Laminas\Mvc\MvcEvent;

class Module
{
	/**
	 * @return array
	 */
	public function getConfig()
	{
		return include __DIR__ . '/../config/module.config.php';
	}

	/**
	 * @param MvcEvent $e
	 */
	public function onBootstrap(MvcEvent $e)
	{
		$eventManager 	= $e->getApplication()->getEventManager();
		$serviceManager = $e->getApplication()->getServiceManager();

		$eventManager->attach(MvcEvent::EVENT_ROUTE, function() use ($serviceManager)
		{
			PluginChain::create()
				->addPlugin($serviceManager->get(GlobalLogPlugin::class))
				->executeAll();
		});

		$eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function(MvcEvent $e) use ($serviceManager)
		{
			if (($exception = $e->getParam('exception')))
			{
				Log::error($exception);
			}
		});
	}
}
