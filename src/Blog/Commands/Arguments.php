<?php

namespace Vl\App\Blog\Commands;

use Vl\App\Blog\Exceptions\ArgumentsException;

/** @package Vl\App\Blog\Commands */
final class Arguments
{
	private array $arguments = [];

	public function __construct(iterable $arguments)
	{
		foreach ($arguments as $argument => $value) {
			// Приводим к строкам
			$stringValue = trim((string)$value);
			// Пропускаем пустые значения
			if (empty($stringValue)) {
				continue;
			}
			// Также приводим к строкам ключ
			$this->arguments[(string)$argument] = $stringValue;
		}
	}

	// Переносим сюда логику разбора аргументов командной строки	
	/**
	 * fromArgv
	 *
	 * @param  mixed $argv
	 * @return self
	 */
	public static function fromArgv(array $argv): self
	{
		$arguments = [];
		foreach ($argv as $argument) {
			$parts = explode('=', $argument);
			if (count($parts) !== 2) {
				continue;
			}
			$arguments[$parts[0]] = $parts[1];
		}
		return new self($arguments);
	}	
	/**
	 * get
	 *
	 * @param  mixed $argument
	 * @return string
	 */
	public function get(string $argument): string
	{
		if (!array_key_exists($argument, $this->arguments)) {
			throw new ArgumentsException(
				"No such argument: $argument"
			);
		}
		return $this->arguments[$argument];
	}
}