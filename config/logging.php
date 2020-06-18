<?php

use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

	'default' => env('LOG_CHANNEL', 'daily'),

	'channels' => [
		'not-urgent' => [
			'driver' => 'single'
		],
		'really-urgent' => [
			'driver' => 'slack'
		]
	],

	'slack' => [
		'driver' => 'slack',
		'url' => env('LOG_SLACK_WEBHOOK_URL'),
		'username' => 'Laravel Log',
		'emoji' => ':boom:',
		'level' => 'critical',
	],

	'stack' => [
		'driver' => 'stack',
		'channels' => ['daily', 'slack'],
		'ignore_exceptions' => false,
	],

	'daily' => [
		'driver' => 'daily',
		'path' => storage_path('logs/laravel.log'),
		'level' => 'critical',
		'days' => 14,
	],

];