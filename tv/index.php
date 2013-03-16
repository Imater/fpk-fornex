<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">

<title>Расписание сервиса</title>
<link rel="stylesheet" href="../css/css3.css" type="text/css">

<link rel="shortcut icon" href="../fpk/favicon-fpk1.ico" type="image/x-icon" />
<link rel="icon" href="../fpk/favicon-fpk1.ico" type="image/x-icon" />

	<script src="../src/js/jquery.js"></script>
	<script src="../src/js/jquery.tools.min.js"></script>
	<script src="../src/js/jquery.tmpl.min.js"></script>
	<script src="../src/js/jquery.ui.datepicker-ru.js"></script>
    <script src="../files/js/jquery.easing.min.1.3.js" type="text/javascript"></script>
	
    <script src="../src/js/cookie.js"></script>

	<script src="../src/js/jquery-ui-1.8.6.custom.min.js"></script>

</head>

<?
 include "../db.php";

 @ $db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
mysql_query("SET NAMES utf8");
 mysql_select_db('h116',$db);   

 if (!$db) { echo "Ошибка подключения к SQL :("; exit();}


  $sqlnews="SELECT * FROM 2_tv WHERE status = '' ORDER by date1 LIMIT 13";  
  $result = mysql_query($sqlnews); 

echo '<div class=accordion2 style="width:470px">';
$now=date("<b>H:i</b>    d-m-Y",time());

echo '<div style="margin-bottom:7px"><center><font size=4px color=lightgray>Загрузка сервиса на '.$now.'</font></center></div>';


  while (@$sql = mysql_fetch_array($result))
    {
    $d1=strtotime($sql['date1']);
    
    $d=date("H:i",strtotime($sql['date1']));
    $color='red';
    if ($d1>time()) $color='black';
    $name='';
    $explodeName = explode(" ", $sql['fio']);
    for ($i=0; $i<count($explodeName); $i++) {
	    if ($i==0) $name = $explodeName[$i];
        if ($i==1) $name.= ' '.mb_substr($explodeName[1], 0, 1,'utf-8');
        if ($i==2) $name.= '.'.mb_substr($explodeName[2], 0, 1,'utf-8').'.';
	   }
	
    $gos=' ('.$sql['gos'].')';
    if ($sql['gos']=='') $gos='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    
	echo '<h3>&nbsp;&nbsp;<font color='.$color.'>'.$d.'</font>&nbsp;&nbsp;&nbsp;&nbsp;'.$name.'<div class="roundmodel" style="width:140px;font-size:16px;">'.$sql['model'].'&nbsp;&nbsp;<font color=darkgray>'.$gos.'</font></div></h3>';
    }

echo '</div>';


echo '<div class=accordion2>';


  $sqlnews="SELECT * FROM 2_tv WHERE status = 'work' AND fio NOT IN (SELECT fio FROM 2_tv WHERE status='ready') ORDER by date1";  
  $result = mysql_query($sqlnews); 

 echo '<div id=working style="margin-top:8px"><b><font color=gray>В работе:</font></b> ';
 $j=0;
 while (@$sql = mysql_fetch_array($result))
    {
    if ($j!=0) echo '<font color=gray>,</font> ';
    $j=1;
    $explodeName = explode(" ", $sql['fio']);
    $name = $explodeName[0];
    echo '<font color=lightyellow>'.$name.'</font> <font color=gray>('.$sql[model].')</font>';
    }
echo '<font color=gray>.</font></div>';

  $sqlnews="SELECT * FROM 2_tv WHERE status = 'ready' ORDER by date1";  
  $result = mysql_query($sqlnews); 

 echo '<div id=working><b><font color=gray>&nbsp;&nbsp;&nbsp;</font></b> ';
 $j=0;
 while (@$sql = mysql_fetch_array($result))
    {
    if ($j!=0) echo '<font color=gray>,</font> ';
    $j=1;
    $explodeName = explode(" ", $sql['fio']);
    $name = $explodeName[0];
    echo '<font color=#d7ffd4>'.$name.'</font> <font color=gray>('.$sql[model].')</font>';
    }
echo '<font color=gray>.</font></div>';



echo '</div><img src="http://172.16.8.12/fpk/upload/20/308.jpg" style="width:340;height:385;float:right;position:absolute;z-index:3;top:27px;right:20px;-webkit-border-radius:11px;">';


?>

<script>
function jsDoFirst()
{
			$('h3:first').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
			$('h2').next('.paneto').find('h3').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
            $('h2').prev('.paneto').find('h3').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
            $('h3:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
}
</script>

<script type="text/javascript">
$(document).ready(jsDoFirst);
setTimeout(function() { location.reload(true);} , 60000);
</script>





