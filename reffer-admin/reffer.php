<html>
<head>
<title>Ищем рефералов</title>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/ref/styles.css?v=3" rel="stylesheet" type="text/css">
</head>
<body>
<?php
require ('config.php');
if ($_GET['pass'] == '<ваш пароль>' and $_GET['adm'] == '<ваш ник,чуствительно к регистру.>' or $_GET['adm'] == '<ник вашего друга,чуствительно к регистру.>' or $_GET['adm'] == '<ник вашего друга,чуствительно к регистру.>'){
		goto na;
	}
	else {
		goto ent;
	}
	na:
if ( isset($_POST['nickname']{3}) ) {
		$player = $_POST['nickname'];
		//print_r($_POST['nickname']);
	}


$handle = mysql_connect($mysql_host, $mysql_user, $mysql_pass) or die($connect_error);
mysql_select_db($mysql_db, $handle) or die($connect_error);
$result = mysql_query ("SELECT * from dle_users WHERE byurl = '". $player ."'");
?>
<div id='dlec'>
	<div class="basecont">
					<form method="POST">
			<input type="text" name="nickname" class="input" placeholder="Ник игрока" required/>
			<input type="submit" class="button" value="Найти"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" value="Вернуться на сайт" onClick='location.href="/"'>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" value="Вернуться в ЛК" onClick='location.href="/cabinet.html"'>
		</form>
			<table width='100%' cellspacing='0' class='teamtable'>
			<tr class='teamoder'><td colspan='4' class='teampaddinghead'><center>Ищем рефералов у <?php print_r($_POST['nickname']);?></center></td></tr>
			<tr>
				<td width="40%"><strong><b>Игроки которых пригласили: </b></strong></td>
				<td width="40%"><strong><b>Время,которое они провели в игре:</b></strong></td>
			</tr>
					<div class="dpad">
			<div class='showtop'>
<?php 
if(($num_rows =  mysql_num_rows($result)) == 0)  
{ 
	echo'<tr>';
	echo'<td width="40%"><strong><b>Он никого не пригласили!</b></strong></td>';
	echo'<td width="40%"><strong><b></b></strong></td>';
	echo'</tr>';
   goto entfree;
} 

	$i = 0;
	$arr = array();
while($data = mysql_fetch_array($result)){ //получаем ники
	array_push($arr, $data['name']);
	$i++; 
	}
mysql_select_db('banlist', $handle) or die($connect_error); //выбрать бд плейтайм
for ($q = 0; $q <= $i; $q++){ // пока не будет =  общему кол-ву делать:
	$nickprg = array_pop($arr); //достаём последний ник из списка
	$resulttime = mysql_query ("SELECT * from playtime WHERE username = '". $nickprg ."'"); //запрос
   while($res = mysql_fetch_array($resulttime)){
	$time = round($res["playtime"] / 60 , 1);
	echo'<tr>';
	echo'<td width="40%"><strong><b>'.$res["username"].'</b></strong></td>';
	echo'<td width="40%"><strong><b>'. $time .' '.getNumEnding($time, array('час', 'часа', 'часов')).'</b></strong></td>'; 
	echo'</tr>';
	}
	}
	echo'<tr>';
	echo'<td width="40%"><strong><b>Общее кол-во приглашённых: '.$i.'</b></strong></td>';
	echo'<td width="40%"><strong><b></b></strong></td>';
	echo'</tr>';
entfree:
 mysql_free_result($result);
ent:
mysql_close($sql);

function getNumEnding($number, $endingArray)
{
    $number = $number % 100;
    if ($number>=11 && $number<=19) {
        $ending=$endingArray[2];
    }
    else {
        $i = $number % 10;
        switch ($i)
        {
            case (1): $ending = $endingArray[0]; break;
            case (2):
            case (3):
            case (4): $ending = $endingArray[1]; break;
            default: $ending=$endingArray[2];
        }
    }
    return $ending;
}

?>
			</table>
</div>
</div>
</div>
</div>
</body>
</html>
</html>