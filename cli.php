<?php
use Vl\App\Blog\Name;
use Vl\App\Blog\User;
use Vl\App\Blog\UUID;
use Vl\App\Blog\Exceptions\UserNotFoundException;
use Vl\App\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use Vl\App\Blog\Repositories\UsersRepository\InMemoryUsersRepository;

require_once __DIR__ . '/vendor/autoload.php';

//Создаём объект репозитория
//$usersRepository = new InMemoryUsersRepository();

//Создаём объект подключения к SQLite
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

//Создаём объект репозитория
$usersRepository = new SqliteUsersRepository($connection);

//Добавляем в репозиторий несколько пользователей
//$usersRepository->save(new User(123, new Name('Ivan', 'Nikitin')));
//$usersRepository->save(new User(234, new Name('Anna', 'Petrova')));
//Добавляем в репозиторий несколько пользователей
$usersRepository->save(new User( UUID::random(), new Name('Ivan', 'Nikitin'), 'ivanik' ));
$usersRepository->save(new User( UUID::random(), new Name('Anna', 'Petrova'), 'anapet'));

// print_r($usersRepository);

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