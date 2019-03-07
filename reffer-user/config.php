<?php
if (! defined ( 'DATALIFEENGINE' )) {
	die ( "ПОШЕЛ НАХУЙ!" );
} //защита файла
$mysql_host = 'localhost';//хост БД
$mysql_user = 'root';//юзер БД
$mysql_pass = 'pass';//пароль БД
$mysql_db = 'db';//база с БД

$mysql_playtime_host = 'localhost';
$mysql_playtime_user = 'root';
$mysql_playtime_pass = 'pass';
$mysql_playtime_db = 'playtime';

$connect_error = 'Не удалось подсоеденится к базе данных!';
$connect_error_select = 'Ошибка выбора бд!';
$connect_error_playtime = 'Ошибка подключения к бд со временем !';
$connect_error_select_playtime = 'Ошибка выбора бд времени!';



if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass)||!mysql_select_db($mysql_db)) {
	die($connect_error);
}
?>
