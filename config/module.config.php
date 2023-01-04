<?php
namespace Log;

use Log\Command\Rotate;
use Psr\Log\LogLevel;

return [

	'service_manager' => [
		'abstract_factories' => [
			DefaultFactory::class,
		],
	],

	'log' => [
		'files' => [
			'main'  => [
				'enabled'  => true,
				'path'     => 'data/log/application.log',
				'logLevel' => LogLevel::DEBUG,
			],
			'error' => [
				'enabled'  => true,
				'path'     => 'data/log/error.log',
				'logLevel' => LogLevel::ERROR,
			]
		],
	],

	'console' => [
		'commands' => [
			Rotate::class
		],
	],
];