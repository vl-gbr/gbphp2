<?php
//Создаём объект подключения к SQLite
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');
//$connection->exec("
//	CREATE TABLE IF NOT EXISTS users (
//		id INTEGER PRIMARY KEY;
//		uuid TEXT;
//		first_name TEXT,
//		last_name TEXT
//		email TEXT;
// 	);
//");

$connection->exec("
	-- DROP TABLE users;

	CREATE TABLE IF NOT EXISTS users (
		uuid TEXT NOT NULL CONSTRAINT uuid_primary_key PRIMARY KEY,
		username TEXT NOT NULL CONSTRAINT username_unique_key UNIQUE,
		first_name TEXT NOT NULL,
		last_name TEXT NOT NULL,
		email TEXT
	);
");


//$connection->exec("
//	ALTER TABLE users ADD uuid TEXT;
//	ALTER TABLE users ADD email TEXT;
//	ALTER TABLE users ADD id INTEGER;
// 	);
//");
//$connection->exec("
//	ALTER TABLE users ADD id INTEGER;
//");

//Вставляем строку в таблицу пользователей
//$connection->exec(
//	"INSERT INTO users (first_name, last_name) VALUES ('Ivan', 'Nikitin')"
//);