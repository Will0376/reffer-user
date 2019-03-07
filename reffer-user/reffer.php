<html>
<head>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/ref/styles.css?v=2" rel="stylesheet" type="text/css">
</head>
<body>
<?php
require ('config.php');
include ('engine/api/api.class.php');
$playernick = $dle_api->take_user_by_id($_SESSION['dle_user_id'] ,'name' );

$handle = mysql_connect($mysql_host, $mysql_user, $mysql_pass) or die($connect_error);
mysql_select_db($mysql_db, $handle) or die($connect_error_select);

$result = mysql_query ("SELECT * from dle_users WHERE byurl = '". $playernick['name'] ."'");
?>
<div id='dlec'>
	<div class="basecont">
			<table width='100%' cellspacing='0' class='teamtable'>
			<tr class='teamoder'><td colspan='4' class='teampaddinghead'><center>Ваши рефералы</center></td></tr>
			<tr>
				<td width="40%"><strong><b>Игроки которых вы пригласили: </b></strong></td>
				<td width="40%"><strong><b>Время,которое они провели в игре:</b></strong></td>
			</tr>
<?php 
if(($num_rows =  mysql_num_rows($result)) == 0)  
{ 
	echo'<tr>';
	echo'<td width="40%"><strong><b>Вы никого не пригласили!</b></strong></td>';
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
$handle_playtime = mysql_connect($mysql_playtime_host, $mysql_playtime_user, $mysql_playtime_pass) or die($connect_error_playtime);
mysql_select_db($mysql_playtime_db, $handle_playtime) or die($connect_error_select_playtime); //выбрать бд плейтайм
for ($q = 0; $q <= $i; $q++){ // пока не будет общему кол-ву делать:
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
</body>
</html>
