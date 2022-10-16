<?php
use Vl\App\Blog\Name;
use Vl\App\Blog\User;
use Vl\App\Blog\Exceptions\UserNotFoundException;
use Vl\App\Blog\Repositories\UsersRepository\InMemoryUsersRepository;

require_once __DIR__ . '/vendor/autoload.php';

//Создаём объект репозитория
$usersRepository = new InMemoryUsersRepository();

//Добавляем в репозиторий несколько пользователей
$usersRepository->save(new User(123, new Name('Ivan', 'Nikitin')));
$usersRepository->save(new User(234, new Name('Anna', 'Petrova')));

// print_r($usersRepository);

try {
    //Загружаем пользователя из репозитория
    // $user = $usersRepository->get(333);
    // print $user->name();
    $user = $usersRepository->get(123);
    print $user->name() . PHP_EOL;
    // print $user . PHP_EOL;
    $user = $usersRepository->get(234);
    print $user->name() . PHP_EOL;
    // print $user . PHP_EOL;
}
catch (UserNotFoundException $e) {
    print $e->getMessage();
}