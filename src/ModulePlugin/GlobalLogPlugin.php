<?php
namespace Log\ModulePlugin;

use Common\Module\Plugin;
use Exception;
use Log\Log;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class GlobalLogPlugin implements Plugin
{
	private array $config;

	public function __construct(array $config)
	{
		$this->config = $config;
	}

	/**
	 * @throws Exception
	 */
	public function execute(): void
	{
		$logger = new Logger('application');

		foreach ($this->config['log']['files'] as $fileInfo)
		{
			if (!$fileInfo['enabled'])
			{
				continue;
			}

			$handler = new StreamHandler($fileInfo['path'], $fileInfo['logLevel']);

			if (($formatter = $fileInfo['formatter'] ?? null))
			{
				$handler->setFormatter(new $formatter('application'));
			}

			$logger->pushHandler($handler);
		}

		Log::setLogger($logger);
	}
}