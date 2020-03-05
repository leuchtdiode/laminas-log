<?php
namespace Log;

use Psr\Log\LoggerInterface;

class Log
{
	/**
	 * @var LoggerInterface
	 */
	private static $logger;

	/**
	 * @param LoggerInterface $logger
	 */
	public static function setLogger(LoggerInterface $logger)
	{
		self::$logger = $logger;
	}

	/**
	 * @return LoggerInterface
	 */
	public static function getLogger()
	{
		return self::$logger;
	}

	/**
	 * @param string $text
	 */
	public static function debug($text)
	{
		self::$logger->debug(
			self::prepare($text)
		);
	}

	/**
	 * @param string $text
	 */
	public static function info($text)
	{
		self::$logger->info(
			self::prepare($text)
		);
	}

	/**
	 * @param string $text
	 */
	public static function warn($text)
	{
		self::$logger->warning(
			self::prepare($text)
		);
	}

	/**
	 * @param string $text
	 */
	public static function error($text)
	{
		self::$logger->error(
			self::prepare($text)
		);
	}

	/**
	 * @param $text
	 * @return string
	 */
	private static function prepare($text)
	{
		if (is_array($text))
		{
			return var_export($text, true);
		}

		return $text;
	}
}