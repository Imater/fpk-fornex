<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<head>
<title>Обработка накладных ПСР</title>

	<script src="./src/js/jquery.js"></script>
</head>

<?
include "../db.php";
$db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
mysql_query("SET NAMES utf8");
mysql_select_db('h116',$db);   
if (!$db) { echo "Ошибка подключения к SQL :("; exit();}

?>



<form method="POST" action="index2.php">

<center>

<textarea name="TEXT" rows="20" style="width:90%;height:85%">
<?
$txt1 = str_replace("\'",'',$HTTP_POST_VARS[TEXT]);

$txt = explode("\r\n",$txt1);
   if (strlen($txt1)>0)
	{
	$sqlnews = "TRUNCATE TABLE `2_tv`";
	$result = mysql_query($sqlnews);
	}

if (!stristr($txt1,'Состояние склада на'))
{
	for($i=0;$i<=count($txt);$i++)
	{
	$cols=explode("	",$txt[$i]);
	
	  for($j=0;$j<=300;$j++) if ($cols[$j]!='') 
	     {
	     if ($cols[16]!='!!!') echo '('.$j.')'.$cols[$j]."\t ";
	     }
	
	$hour = $cols[4];
	$minute=$cols[8];
	if ($minute=='') $minute='00';
	
	$d=date("Y-m-d H:i:s",strtotime($hour.':'.$minute));
		
	if (($cols[84]!='') && ($cols[16]=='принять') && $cols[48]!='принят')
	   { 
		$sqlnews = "INSERT INTO `h116`.`2_tv` (`id`, `date1`, `fio`, `model`, `gos`, `status`) VALUES (NULL, '".$d."', '".$cols[84]."', '".$cols[144]."', '".$cols[169]."', '');";
		$result = mysql_query($sqlnews);
	   }	
	
	if (($cols[84]!='') && ($cols[16]=='выдать') && $cols[48]=='назначить выдачу')
	   { 
		$sqlnews = "INSERT INTO `h116`.`2_tv` (`id`, `date1`, `fio`, `model`, `gos`, `status`) VALUES (NULL, '".$d."', '".$cols[84]."', '".$cols[144]."', '".$cols[169]."', 'ready');";
		$result = mysql_query($sqlnews);
	   }	

	if (($cols[84]!='') && ($cols[48]=='принят') && ($cols[16]=='принять') )
	   { 
		$sqlnews = "INSERT INTO `h116`.`2_tv` (`id`, `date1`, `fio`, `model`, `gos`, `status`) VALUES (NULL, '".$d."', '".$cols[84]."', '".$cols[144]."', '".$cols[169]."', 'work');";
		$result = mysql_query($sqlnews);
	   }	


	if (($cols[84]!=''))
	   { 
	   echo "\n";	
	   }
	
	}
}

?>

</textarea>
<?
if (stristr($txt1,'Состояние склада на'))
{
	$sqlnews = "TRUNCATE TABLE `2_sklad`";
	$result = mysql_query($sqlnews);

	echo '<table style="font-size:10px;">';
	for($i=0;$i<=count($txt);$i++)
	{
	$line = str_replace(',','.',$txt[$i]);

	$cols=explode("\t",$line);
	$cols[15]=str_replace(chr(194).chr(160),'',$cols[15]);	
	$cols[16]=str_replace(chr(194).chr(160),'',$cols[16]);	
	$cols[17]=str_replace(chr(194).chr(160),'',$cols[17]);	
	$cols[18]=str_replace(chr(194).chr(160),'',$cols[18]);	

//	echo ' *'.ord($cols[18][2]).'*<br>';

	if ($cols[9]!='') 
	  {
	  echo '<tr><td>';
	  
//	for($j=0;$j<=20;$j++) echo '<td>'.$j.'='.$cols[$j].'</td> ';	
	  
	  echo '</td></tr>';
	  echo '<tr>';
	  echo '<td>'.$cols[9]."</td><td>".$cols[12]."</td><td>Ячейка:".$cols[14].'</td><td>в наличии:'.$cols[15].'</td><td>в т.ч. в резерве:'.$cols[16].'</td>' ;
	  echo "<td>цена входная:".$cols[17]."</td><td>Цена продажная:".$cols[18].'</td>';
	  echo '</tr>';
	  
		$sqlnews = "INSERT INTO `h116`.`2_sklad` (`id`, `art_num`, `name`, `box`, `amount`, `reserv`, `cost1`, `cost2`) VALUES (NULL, '$cols[9]', '$cols[12]', '$cols[14]', '$cols[15]', '$cols[16]', '$cols[17]', '$cols[18]'); ";
		$result = mysql_query($sqlnews);

	  
	  }
	else
	  {
//	  for($j=0;$j<=20;$j++) echo $j.'='.$cols[$j].' | ';	
//	  echo "\n";
	  }
	}
	echo '</table>';

}
?>

<br><br><input hint="Сохранение информации о клиенте." name="clientsave" type="submit" value="Обработать загрузку">

</center>

</form>