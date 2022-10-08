<?php

require_once __DIR__ . '/vendor/autoload.php';

use Vl\App\Blog\Post;
use Vl\App\Person\Name;
use Vl\App\Person\Person;

// spl_autoload_register(function ($class) {
//     // print_r($class);
//     $file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
//     // print_r($file);
//     if (file_exists($file)) {
//         require $file;
//     }
// });
    

$post = new Post(
    new Person(
        new Name('Иван', 'Никитин'),
        new DateTimeImmutable()
    ),
    'Всем привет!'
);

print $post;