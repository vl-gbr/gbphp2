<?php

use Vl\App\Blog\Commands\Arguments;
use Vl\App\Blog\Commands\CreateUserCommand;
use Vl\App\Blog\Exceptions\AppException;
use Vl\App\Blog\Repositories\UsersRepository\SqliteUsersRepository;

require_once __DIR__ . '/vendor/autoload.php';

// Подключение к SQLite
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

//Создаём объект репозитория (InMemory)
//$usersRepository = new InMemoryUsersRepository();

//Создаём объект репозитория (Sqlite)
$usersRepository = new SqliteUsersRepository($connection);

// Команда зависит от контракта репозитория пользователей,
$command = new CreateUserCommand($usersRepository);

try {
	// Запускаем команду
	// cli.bat username='vl' first_name='Vit' last_name='Lenkn'
	$command->handle(Arguments::fromArgv($argv));
}
catch (AppException $e) {
	// Выводим сообщения об ошибках
	echo "{$e->getMessage()}\n";
}