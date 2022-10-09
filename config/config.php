<?php

define('ROOT', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);
define('B1', '<b>');
define('B0', '</b>');
define('BR', '<br>');
define('BR2', '<br><br>');
define('BR3', '<br><br><br>');
define('BR4', '<br><br><br><br>');
define('BR5', '<br><br><br><br><br>');

function br($n=1){
    $br = '';
    for ($i=1; $i <= $n; $i++ ){
        $br .= '<br>';
    }
    if ($br <> '') echo $br;
};