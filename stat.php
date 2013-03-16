<style type="text/css">
table.sample {
	border-width: 1px;
	font-family: Arial;
	font-size: 11px;
	border-spacing: 0px;
	border-style: none;
	border-color: lightgray;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 1px;
	padding: 3px;
	border-style: inset;
	border-color: lightgray;
	background-color: #eeeeee;
	-moz-border-radius: ;
}
table.sample td {
	border-width: 1px;
	padding: 1px;
	min-width: 15px;
	text-align: center;
	nobr;
	border-style: inset;
	border-color: lightgray;
	background-color: #f4f4f4;
	-moz-border-radius: ;
}

td.mini {
	border-width: 1px;
	padding: 1px;
	min-width: 15px;
	font-size: 9px;
	text-align: center;
	nobr;
	border-style: inset;
	border-color: lightgray;
	background-color: #f0f6f0;
	-moz-border-radius: ;
}

td.month {
	border-width: 1px;
	padding: 0px;
	min-width: 15px;
	font-size: 11px;
	//font-weight: bold;
	text-align: center;
	border-style: inset;
	border-color: lightgray;
	background-color: #ff8235;
	-moz-border-radius: ;
}

</style>

<?
include "db.php";
$fpk_brand=$_COOKIE['brand'];
$fpk_id=$_COOKIE['fpk_id'];
$fpk_job=$_COOKIE['fpk_job'];
$type= $HTTP_GET_VARS['type'];

$db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
mysql_query("SET NAMES utf8");
mysql_select_db('h116',$db);   
if (!$db) { echo "Ошибка подключения к SQL :("; exit();}

user2($_COOKIE['email'],$_COOKIE['pass']);

$group = $HTTP_GET_VARS['group'];


$sqlnews = "(SELECT id,short,model FROM 1_models WHERE brand = ".$HTTP_GET_VARS['brand'].")
			UNION (SELECT '' id,'_не указана' short,'Модель не указана' model FROM 1_models LIMIT 0,1)
			UNION (SELECT '%' id,'Итого' short,'Итого' model FROM 1_models LIMIT 0,1)  ORDER BY short";

if ($group=='manager')
$sqlnews = "(SELECT id,fio short,fio model FROM 1_users WHERE brand = ".$HTTP_GET_VARS['brand']." AND job LIKE '%менеджер%')
			UNION (SELECT '' id,'_не указано' short,'Не указано' model FROM 1_models LIMIT 0,1)
			UNION (SELECT '%' id,'_Итого' short,'Итого' model FROM 1_models LIMIT 0,1)  ORDER BY short";

if ($group=='from')
$sqlnews = "(SELECT DISTINCT commercial short,commercial model,1 id FROM 1_clients WHERE brand = ".$HTTP_GET_VARS['brand'].")
			UNION (SELECT '' id,'_не указано' short,'Не указано' model FROM 1_models LIMIT 0,1)
			UNION (SELECT '%' id,'_Итого' short,'Итого' model FROM 1_models LIMIT 0,1)  ORDER BY short";

if ($type=='out3')
   {
   $group='out3';
   $sqlnews = 'SELECT id, short, text model FROM 1_outtype';
   }
			
  $result = mysql_query($sqlnews); 

  echo '<table class=sample>';
  
		if ($group=='model') echo '<tr nowrap><th width=200>Модель</th>';
		if ($group=='from') echo '<tr nowrap><th width=200>Источник рекламы</th>';
		if ($group=='manager') echo '<tr nowrap><th width=200>Менеджер</th>';
		if ($group=='out3') echo '<tr nowrap><th width=200>Причина расторжения</th>';
    	echo '<th>Итого</th>';

$dStart = $HTTP_GET_VARS['d1'];
$dEnd = $HTTP_GET_VARS['d2'];

$dEnd=$HTTP_GET_VARS['alldate'];

$m= $HTTP_GET_VARS['m'];

if ($m==31) $step=29;
else $step=1.1;

$dS=strtotime($dEnd)-60*60*24*31*$step;

$dStart=strftime('%d.%m.%Y',$dS);


$pTimeStart2 = strtotime ($dStart);
$pTimeEnd2 = strtotime ($dEnd);


if($m==0) $m=1;
$oneDay = $m*60*60*24;
$month=8888;
$RUS = array(
			'01' => 'Январь',
			'02' => 'Февраль',
			'03' => 'Март',
			'04' => 'Апрель',
			'05' => 'Май',
			'06' => 'Июнь',
			'07' => 'Июль',
			'08' => 'Август',
			'09' => 'Сентябрь',
			'10' => 'Октябрь',
			'11' => 'Ноябрь',
			'12' => 'Декабрь',
			);
	while ($pTimeStart2<=$pTimeEnd2)
		 {
		 if($month<>strftime("%m", $pTimeStart2)) 
		   {
		   //if ($m==1) echo '<th class=mini>'.$RUS[strftime("%m", $pTimeStart2)].'&nbsp'.strftime("%Y", $pTimeStart2).'</th>';
		   echo '<th class=mini>'.strftime("%b", $pTimeStart2).'</th>';
		   }
		 $month=strftime("%m", $pTimeStart2);
		 $date=strftime("%d", $pTimeStart2);
		 $pTimeStart2 = $pTimeStart2 + $oneDay;
		 
		 if ($m==1) echo '<td class=mini>'.$date.'</td>';
		 }


		echo '</tr>';
		
  while (@$sql = mysql_fetch_array($result))
    {
$month=8888;
	$myline = str_replace(' ','&nbsp;',$sql['model']);
	$myline = str_replace('&nbsp;(','',$myline);
 	echo '<tr>';
	echo '<th>';
	echo $myline;
	echo '</th>';

	$sqlnews3 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` != '0000-00-00 00:00:00' AND model = '".$sql['id']."' AND brand = '".$HTTP_GET_VARS['brand']."'";

if ($group=='out3')
		$sqlnews3 = "SELECT count(*) cnt FROM 1_clients WHERE brand = '".$HTTP_GET_VARS['brand']."' AND `OUT` != '0000-00-00 00:00:00' AND adress LIKE '".$sql['short']." – %'";
	
if ($group=='manager')
		$sqlnews3 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` != '0000-00-00 00:00:00' AND manager = '".$sql['short']."' AND brand='".$HTTP_GET_VARS['brand']."'";
	
if ($group=='from')
		$sqlnews3 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` != '0000-00-00 00:00:00' AND commercial = '".$sql['short']."' AND brand='".$HTTP_GET_VARS['brand']."'";
	
	$sqlnews3=str_replace("model = '%'","model LIKE '%'",$sqlnews3);
	$sqlnews3=str_replace("model = ''","model IN ('',0)",$sqlnews3);

	$result3 = mysql_query($sqlnews3); @$sql3 = mysql_fetch_array($result3);
	$cnt=$sql3['cnt'];
	echo "<th>$cnt</th>";

$pTimeStart = strtotime ($dStart);
$pTimeEnd = strtotime ($dEnd);

	while ($pTimeStart<=$pTimeEnd)
		 {
		 if($month<>strftime("%m", $pTimeStart)) 
		   {
			 $date=strftime("%Y-%m-", $pTimeStart);
			 if ($type=='out2') $type='dg` != "0000-00-00 00:00:00" AND `out';
			 
			 $sqlnews3 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` LIKE '$date%' AND model = '".$sql['id']."' AND brand='".$HTTP_GET_VARS['brand']."'";
			 
if ($group=='out3')
		$sqlnews3 = "SELECT count(*) cnt FROM 1_clients WHERE brand LIKE '".$HTTP_GET_VARS['brand']."' AND adress LIKE '".$sql['short']." – %'  AND `out` LIKE '$date%'";
		
//		echo $date;

	if ($group=='manager')
			 $sqlnews3 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` LIKE '$date%' AND manager = '".$sql['short']."' AND brand='".$HTTP_GET_VARS['brand']."'";
			 
if ($group=='from')
			 $sqlnews3 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` LIKE '$date%' AND commercial = '".$sql['short']."' AND brand='".$HTTP_GET_VARS['brand']."'";
			 
	$sqlnews3=str_replace(" = '%'"," LIKE '%'",$sqlnews3);
	$sqlnews3=str_replace(" = ''"," IN ('',0)",$sqlnews3);

			 $result3 = mysql_query($sqlnews3); @$sql3 = mysql_fetch_array($result3);
		   	 $cnt=$sql3['cnt'];
		   	 $mod=$sql['short'];
		   	  //if ($m==1) echo "<td>$mod</td>";
		   	  if ($cnt==0) $cnt='';
		      if ($sql['short']!='Итого') echo "<td class=month>$cnt</td>";
		       else echo "<th class=month>$cnt</th>";
		   }
		 $month=strftime("%m", $pTimeStart);
		 
		 if ($m==1) echo '<td>';
		 $date=strftime("%Y-%m-%d", $pTimeStart);
		 

		 $sqlnews2 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` LIKE '$date%' AND model = '".$sql['id']."'";
	if ($group=='manager')
		 $sqlnews2 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` LIKE '$date%' AND manager = '".$sql['short']."'";
if ($group=='from')
		 $sqlnews2 = "SELECT count(*) cnt FROM 1_clients WHERE `$type` LIKE '$date%' AND commercial = '".$sql['short']."'";

if ($group=='out3')
		{
		$sqlnews2 = "SELECT count(*) cnt FROM 1_do WHERE `type` = 'OUT' AND brand LIKE '".$HTTP_GET_VARS['brand']."' AND text LIKE '".$sql['short']." – %' AND date1 LIKE '$date%'";
		}
		 
//		 echo $sqlnews2.'<br>';
		 $result2 = mysql_query($sqlnews2); @$sql2 = mysql_fetch_array($result2);
		 $pTimeStart = $pTimeStart + $oneDay;
		 $cnt=$sql2['cnt'];
		  if ($m==1) if ($cnt>0) echo $cnt;

		 if ($m==1) echo '</td>';
		 }

	echo '</tr>';
    }



echo '</table>';
?>