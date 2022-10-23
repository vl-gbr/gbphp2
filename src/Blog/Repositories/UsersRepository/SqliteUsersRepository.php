<?php

namespace Vl\App\Blog\Repositories\UsersRepository;

use PDO;
use PDOStatement;
use Vl\App\Blog\Name;
use Vl\App\Blog\User;
use Vl\App\Blog\UUID;
use Vl\App\Blog\Exceptions\UserNotFoundException;

class SqliteUsersRepository implements UsersRepositoryInterface
{
	public function __construct(
		private PDO $connection
	) {
	}

	public function save(User $user): void
	{
		// Подготавливаем запрос
		$statement = $this->connection->prepare(
			'INSERT INTO users (first_name, last_name, uuid, username)
			VALUES (:first_name, :last_name, :uuid, :username)'
		);
		// Выполняем запрос с конкретными значениями
		$statement->execute([
			// Это работает, потому что класс UUID
			// имеет магический метод __toString(),
			// который вызывается, когда объект
			// приводится к строке с помощью (string)
			':uuid' => (string) $user->uuid(),
			':username' => $user->userName(),
			':first_name' => $user->name()->firstName(),
			':last_name' => $user->name()->lastName(),
			':username' => $user->username(),
		]);
	}

	// Также добавим метод для получения
	// пользователя по его UUID
	public function get(UUID $uuid): User
	{
		$statement = $this->connection->prepare(
			'SELECT * FROM users WHERE uuid = ?'
		);
		$statement->execute([
			':uuid' => (string) $uuid,
		]);
		
		return $this->getUser($statement, $uuid);
	}

	// Метод получения пользователя по username
	public function getByUsername(string $username): User
	{
		$statement = $this->connection->prepare(
			'SELECT * FROM users WHERE username = :username'
		);
		$statement->execute([
			':username' => $username,
		]);
		return $this->getUser($statement, $username);
	}

	public function getUser( PDOStatement $statement, string $username ) :User {

		$result = $statement->fetch(PDO::FETCH_ASSOC);
		// Бросаем исключение, если пользователь не найден
		if (false === $result) {
			throw new UserNotFoundException(
				"Cannot get user: $username"
			);
		}

		return new User(
			new UUID($result['uuid']),
			$result['username'],
			new Name($result['first_name'], $result['last_name'])
		);
	}
}
