<?php
namespace Log\ModulePlugin;

use Common\Module\Plugin;
use Log\Log;
use Log\Logger;

class GlobalLogPlugin implements Plugin
{
	public function __construct(
		private readonly Logger $logger
	)
	{
	}

	public function execute(): void
	{
		Log::setLogger($this->logger);
	}
}