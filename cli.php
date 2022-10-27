<?php

use Vl\App\Blog\Name;
use Vl\App\Blog\User;
use Vl\App\Blog\UUID;
use Vl\App\Blog\Commands\CommandException;
use Vl\App\Blog\Commands\CreateUserCommand;
use Vl\App\Blog\Exceptions\UserNotFoundException;
use Vl\App\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use Vl\App\Blog\Repositories\UsersRepository\InMemoryUsersRepository;

require_once __DIR__ . '/vendor/autoload.php';

//Создаём объект подключения к SQLite
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

//Создаём объект репозитория
//$usersRepository = new InMemoryUsersRepository();

//Создаём объект репозитория
$usersRepository = new SqliteUsersRepository($connection);

//Добавляем в репозиторий несколько пользователей
//$usersRepository->save(new User(123, new Name('Ivan', 'Nikitin')));
//$usersRepository->save(new User(234, new Name('Anna', 'Petrova')));
//Добавляем в репозиторий несколько пользователей
//$usersRepository->save(new User(UUID::random(), new Name('Ivan', 'Nikitin'), 'ivanik'));
//$usersRepository->save(new User(UUID::random(), new Name('Anna', 'Petrova'), 'anapet'));

print_r($argv);

// Команда зависит от контракта репозитория пользователей,
// так что мы передаём объект класса,
// реализующего этот контракт
$command = new CreateUserCommand($usersRepository);

try {
	// Запускаем команду
	$command->handle($argv);
} catch (CommandException $e) {
	// Выводим сообщения об ошибках
	echo "{$e->getMessage()}\n";
}

//try {
//    //Загружаем пользователя из репозитория
//    // $user = $usersRepository->get(333);
//    // print $user->name();
//    $user = $usersRepository->get(123);
//    print $user->name() . PHP_EOL;
//    // print $user . PHP_EOL;
//    $user = $usersRepository->get(234);
//    print $user->name() . PHP_EOL;
//    // print $user . PHP_EOL;
//}
//catch (UserNotFoundException $e) {
//    print $e->getMessage();
//}