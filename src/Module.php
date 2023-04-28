<?php
namespace Log;

use Common\Module\PluginChain;
use Log\ModulePlugin\GlobalLogPlugin;
use Laminas\Mvc\MvcEvent;
use Throwable;

class Module
{
	public function getConfig(): array
	{
		return include __DIR__ . '/../config/module.config.php';
	}

	/**
	 * @throws Throwable
	 */
	public function onBootstrap(MvcEvent $e): void
	{
		$eventManager 	= $e->getApplication()->getEventManager();
		$serviceManager = $e->getApplication()->getServiceManager();

		PluginChain::create()
			->addPlugin($serviceManager->get(GlobalLogPlugin::class))
			->executeAll();

		$eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function(MvcEvent $e) use ($serviceManager)
		{
			if (($exception = $e->getParam('exception')))
			{
				Log::error($exception);
			}
		});
	}
}
