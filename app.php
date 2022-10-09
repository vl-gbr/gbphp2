<?php

require_once __DIR__ . '/vendor/autoload.php';

use Vl\App\Blog_Post;
use Vl\App\Person_Name;
use Vl\App\Person\Person;
use Vl\App\engine\Autoload;

echo '<pre>';
include "./config/config.php";
include "./src/engine/Autoload.php";
//echo ROOT;

//spl_autoload_register([new Autoload, 'loadClass']);
spl_autoload_register([new Autoload, 'autoClass']);

// spl_autoload_register(function ($class) {
//     $file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
//     if (file_exists($file)) {
//         require $file;
//     }
// });
    

$post = new Blog_Post(
    new Person(
        new Person_Name('Иван', 'Никитин'),
        new DateTimeImmutable()
    ),
    'Всем привет!'
);

print $post;