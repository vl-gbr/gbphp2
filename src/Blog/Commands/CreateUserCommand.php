<?php

namespace Vl\App\Blog\Commands;

use Vl\App\Blog\Name;
use Vl\App\Blog\User;
use Vl\App\Blog\UUID;
use Vl\App\Blog\Commands\Arguments;
use Vl\App\Blog\Exceptions\CommandException;
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
	
	/**
	 * handle
	 *
	 * @param  Arguments $arguments
	 * 		Вместо массива принимаем объект типа Arguments
	 * @return void
	 */
	public function handle(Arguments $arguments): void 
	{
		$username = $arguments->get('username');

		// Проверяем, существует ли пользователь в репозитории
		if ($this->userExists($username)) {
			// Бросаем исключение, если пользователь уже существует
			throw new CommandException("User already exists: $username");
		}
		// Сохраняем пользователя в репозиторий
		$this->usersRepository->save(
			new User(
				UUID::random(),
				$username,
				new Name(
					$arguments->get('first_name'), 
					$arguments->get('last_name')
				),
			)
		);
	}
		
	/**
	 * userExists
	 *
	 * @param  mixed $username
	 * @return bool
	 */
	private function userExists(string $username): bool
	{
		try {
			// Получаем пользователя из репозитория
			$this->usersRepository->getByUsername($username);
		} catch (UserNotFoundException) {
			return false;
		}
		return true;
	}
}