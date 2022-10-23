<?php

namespace Vl\App\Blog;

use InvalidArgumentException;

class UUID
{
	// Внутри объекта мы храним UUID как строку
	public function __construct(
		private string $uuidString
	) {
		// Если входная строка не подходит по формату -
		// бросаем исключение InvalidArgumentException
		// (его мы тоже добавили)
		//
		// Таким образом, мы гарантируем, что если объект
		// был создан, то он точно содержит правильный UUID
		if (!\Symfony\Polyfill\Uuid\Uuid::uuid_is_valid($uuidString)) {
			throw new InvalidArgumentException(
				"Malformed UUID: $this->uuidString"
			);
		}
	}
	// А так мы можем сгенерировать новый случайный UUID
	// и получить его в качестве объекта нашего класса
	public static function random(): self
	{
		return new self(\Symfony\Polyfill\Uuid\Uuid::uuid_create(\Symfony\Polyfill\Uuid\Uuid::UUID_TYPE_RANDOM));
	}
	public function __toString(): string
	{
		return $this->uuidString;
	}
}
