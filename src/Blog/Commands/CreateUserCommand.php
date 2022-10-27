<?php

namespace Vl\App\Blog\Commands;

use Vl\App\Blog\Name;
use Vl\App\Blog\User;
use Vl\App\Blog\UUID;
use Vl\App\Blog\Commands\CommandException;
use Vl\App\Blog\Exceptions\UserNotFoundException;
use Vl\App\Blog\Repositories\UsersRepository\UsersRepositoryInterface;

final class CreateUserCommand
{
	// Команда зависит от контракта репозитория пользователей,
	// а не от конкретной реализации
	public function __construct(
		private UsersRepositoryInterface $usersRepository
	) {
	}
	public function handle(array $rawInput): void
	{
		$input = $this->parseRawInput($rawInput);

		print_r($input);

		$username = $input['username'];
		// Проверяем, существует ли пользователь в репозитории
		if ($this->userExists($username)) {
			// Бросаем исключение, если пользователь уже существует
			throw new CommandException("User already exists: $username");
		}
		// Сохраняем пользователя в репозиторий
		$this->usersRepository->save(new User(
			UUID::random(),
			$username,
			new Name($input['first_name'], $input['last_name']),
		));
	}
	// Преобразуем входной массив
	// из предопределённой переменной $argv
	//
	// array(4) {
	// [0]=>
	// string(18) "/some/path/cli.php"
	// [1]=>
	// string(13) "username=ivan"
	// [2]=>
	// string(15) "first_name=Ivan"
	// [3]=>
	// string(17) "last_name=Nikitin"
	// }
	//
	// в ассоциативный массив вида
	// array(3) {
	// ["username"]=>
	// string(4) "ivan"
	// ["first_name"]=>
	// string(4) "Ivan"
	// ["last_name"]=>
	// string(7) "Nikitin"
	//}
	private function parseRawInput(array $rawInput): array
	{
		$input = [];
		foreach ($rawInput as $argument) {
			$parts = explode('=', $argument);
			if (count($parts) !== 2) {
				continue;
			}
			$input[$parts[0]] = $parts[1];
		}
		foreach (['username', 'first_name', 'last_name'] as $argument) {
			if (!array_key_exists($argument, $input)) {
				throw new CommandException(
					"No required argument provided: $argument"
				);
			}
			if (empty($input[$argument])) {
				throw new CommandException(
					"Empty argument provided: $argument"
				);
			}
		}
		return $input;
	}
	private function userExists(string $username): bool
	{
		try {
			// Пытаемся получить пользователя из репозитория
			$this->usersRepository->getByUsername($username);
		} catch (UserNotFoundException) {
			return false;
		}
		return true;
	}
}
