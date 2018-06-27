<?php
if (! defined ( 'DATALIFEENGINE' )) {
	die ( "ПОШЕЛ НАХУЙ!" );
} //защита файла
$connect_error = 'Не удалось подсоеденится к базе данных!';

$mysql_host = 'localhost';//хост БД
$mysql_user = 'root';//юзер БД
$mysql_pass = 'root';//пароль БД
$mysql_db = 'database';//база с БД


if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass)||!mysql_select_db($mysql_db)) {
	die($connect_error);
}
?>