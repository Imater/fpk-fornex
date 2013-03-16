<?
if (false)
 {
Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); //Дата в прошлом 
Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1 
Header("Pragma: no-cache"); // HTTP/1.1 
Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
 }
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<html>
<head>
<title>ФПК</title>
<link rel="stylesheet" href="css/css5.css" type="text/css">

<link rel="shortcut icon" href="/favicon-fpk1.ico" type="image/x-icon" />
<link rel="icon" href="/favicon-fpk1.ico" type="image/x-icon" />

   <script>
     Timeline_ajax_url="./timeline/timeline_ajax/simile-ajax-api.js";
//     Timeline_urlPrefix='http://localhost/fpk/timeline/timeline_js/';       
     Timeline_parameters='bundle=true';
   </script>


<?
require_once('compress_timestamp.php');                              
if (stripos($_SERVER['HTTP_ACCEPT_ENCODING'],'GZIP')!==false)   
        $gz='gz';
 else
        $gz=null;
//echo '<link rel="stylesheet" type="text/css" href="min/styles_'.$compress_stamp.'.css'.$gz.'" />',PHP_EOL;

$gz=null;

echo '<script src="min/all_'.$compress_stamp.'.js'.$gz.'" /></script>',PHP_EOL;

//if ( $_SERVER['HTTP_HOST'] == 'localhost') 
   echo '<script src="all%20copy10.js" /></script>',PHP_EOL;

?>
    <script src="./timeline/timeline_js/timeline-api.js?bundle=true" type="text/javascript"></script>
	<script type='text/javascript' src='./fullcalendar/fullcalendar/fullcalendar.js'></script>


	<link rel='stylesheet' type='text/css' href='./fullcalendar/fullcalendar/fullcalendar.css' />
    <link rel="stylesheet" href="css/iphone.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="pro_dropdown_3/pro_dropdown_3.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="jqgrid/css/ui.jqgrid.css" />
	<link rel="stylesheet" href="elrte-1.2/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="css/jquery-ui-1.8.6.custom.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="./jquery-autocomplete/jquery.autocomplete.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="elfinder/css/elfinder.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="elfinder/css/theme.css">



	
<script type="text/javascript">
$(document).ready(jsDoFirst); 
</script>

</head>

<body onResize="onResize();">

<?
 include "db.php";

 @ $db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
mysql_query("SET NAMES utf8");
 mysql_select_db('h116',$db);   

 if (!$db) { echo "Ошибка подключения к SQL :("; exit();}

 if (!user($_COOKIE['email'],$_COOKIE['pass'])) { echo "<script> document.location = 'login.php'; </script>"; exit; }
 echo "<script>$.cookie('brand','$fpk_brand',{ expires: 30 });</script>";
 echo "<script>$.cookie('fpk_id','$fpk_id',{ expires: 30 });</script>";
 echo "<script>$.cookie('fpk_job','$fpk_job',{ expires: 30 });</script>";
// echo 'jjjjjj:'.$_SERVER['HTTP_USER_AGENT'];
   echo "<script>document.title='ФПК';$.cookie('fpk_mobile','0',{ expires: 30 });</script>";
 
 if ( !(stristr($_SERVER['HTTP_USER_AGENT'],'Chrome')) or (stristr($_SERVER['HTTP_USER_AGENT'],'Mobile')) )
    {
    if ((stristr($_SERVER['HTTP_USER_AGENT'],'ipad'))) echo "<script>document.title='ФПК для iPAD';";
    if ((stristr($_SERVER['HTTP_USER_AGENT'],'iphone'))) echo "<script>document.title='ФПК для iPhone';";
    if ((stristr($_SERVER['HTTP_USER_AGENT'],'Android'))) echo "<script>document.title='ФПК для Android';";
    echo "$.cookie('fpk_mobile','1',{ expires: 30 });</script>";
    echo "<style>
div#header {
//  background:#000;
  background:-webkit-gradient(linear, 0 0, 0 bottom, from(#f8f8f8), to(#c3c3c3));
  -webkit-box-shadow: #000 0px 10px 25px;
  height: 22px;
  z-index:500;
}

div#content {
  height: auto;
  width: 1330px;
  overflow: auto;
  margin: -22px 0 -24px 0;
  z-index:0;
}
div#footer {
  background:-webkit-gradient(linear, 0 0, 0 bottom, from(#c3c3c3), to(#f2f2f2));
  margin-top: 100px;
  overflow: auto;
  -webkit-box-shadow: #000 0px -10px 25px;
  height: 24px;
}
div#left-col {
  background:-webkit-gradient(linear, 0 0, 0 bottom, from(#000), to(#013));
  bottom: 24px;
  left: 0;
  overflow: auto;
  position: absolute;
  top: 22px;
  width: 260px;

}
div#right-col {
  background:url(../img/left-v-line.png) no-repeat left;
  bottom: 24px;
  left: 260px;
  overflow: auto;
  position: inherit;
  top: 22px;
  right:0px;
  width: auto;
  margin:1px;
  margin-top: 20px;
  margin-right: 0px;
  margin-left: 260px;
}

.left-bottom-bottom
{
border-top: 1px solid #FFF;
margin-left:14px;
margin-right:7px;
background:#E5E4E6;
-webkit-border-bottom-left-radius:10px;
-webkit-border-bottom-right-radius:10px;
height: 29px;
width:234px;	
text-align: center;
}
.reiting1
{
margin-left:14px;
float: left;
margin-top:17px;
margin-right:7px;
width:218px;
-webkit-border-radius:30px;	
text-align:center;
padding:7px;
font-size:13px;
opacity:0.3;
border-bottom: 2px solid #1e203b;
background:-webkit-gradient(linear, 0 0, 0 bottom, from(#1e203b), to(#353868));
color:#e2e2e2;
font-weight: bolder;
text-shadow: 1px 1px 1px #000;
cursor:pointer;
}
.reiting2
{
float: left;
margin-left:9px;
margin-top:17px;
margin-right:7px;
width:125px;
-webkit-border-radius:30px;	
text-align:center;
padding:7px;
opacity:0.6;
border-bottom: 2px solid #1e203b;
background:-webkit-gradient(linear, 0 0, 0 bottom, from(#1e203b), to(#353868));
color:#50549c;
font-weight: bolder;
text-shadow: 1px 1px 1px #000;
cursor:pointer;
}
#bottom-left-menu
{
margin-left:14px;
margin-top:-20px;
margin-right:7px;
width:220px;
-webkit-border-bottom-left-radius:10px;	
-webkit-border-bottom-right-radius:10px;	
text-align:center;
padding:7px;
border-top: 1px solid #FFF;
background-color:#E5E4E6;

}


</style>
";
}
else
 {
 echo "$.cookie('fpk_mobile','0',{ expires: 30 });</script>";
 }
 
?>


<body>

<?
//<embed src="success.wav" autostart="false" width="0" height="0" id="sound1"
//enablejavascript="true">
?>

<div id="wrap">
  <div id="header">



<ul id="nav">
   
	<li class="top"><a href="#nogo2" class="top_link"><span class="down" id="brand-ico"><img height="17px" src=".\img\<? echo $fpk_logo; ?>" style="padding-top:2px;"></span></a>
		<ul class="sub tabs2" style="display:none">
		 <? if ($fpk_brand=='1') echo '<li><a href="#" id="abcnet">Загрузка данных из ABCnet</a></li>'; ?>
		</ul>

	<li class="top"><a href="#nogo2" class="top_link">
	<span class="down" id="brand" style="display:none"><? echo $fpk_brand; ?></span>
	<span class="down" id="brandtitle"><? echo $fpk_brandtitle; ?></span></a>
		<ul class="sub" id="selectbrand">
		    <li><b>Выбор бренда</b></li>
		    <?  
		             echo mod_ShowBrandlist(1); 
		    ?>



		</ul>
	<li class="top" id="manager-menu"><a href="#nogo2" id="products" class="top_link"><span class="down"  id="selectmanager"><? if (!$_COOKIE['mymanager']) echo "Все"; else echo ( $_COOKIE['mymanager']); ?></span></a>
		<ul class="sub" id="userlist">
			<li><a href="#nogo4">Все</a></li>
			<li><b>Менеджеры</b></li>
		    <? echo mod_ShowUserlist(" job LIKE '%неджер%'"); ?>
			<li><b>Остальные</b></li>
		    <? echo mod_ShowUserlist(" job NOT LIKE '%неджер%' AND job NOT LIKE '%волен%' "); ?>
		</ul>
	</li>
	
	<li class="top"><a href="#nogo22" id="services" class="top_link"><span class="down">Добавить</span></a>
		<ul class="sub">
			<li><a href="#nogo23" id="addclient" id2="1"><img height="13px" style="opacity:0.7" src=".\img\addclient.png">&nbsp;&nbsp;&nbsp;Новый клиент</a></li>
			<li><b>Клиент</b></li>
			<li><a href="#nogo23" id="addclient" id2="2"><img height="13px" style="opacity:0.7" src=".\img\1zvonok.png">&nbsp;&nbsp;&nbsp;Звонок</a></li>
			<li><a href="#nogo24" id="addclient" id2="3"><img height="13px" style="opacity:0.7" src=".\img\1vizit.png">&nbsp;&nbsp;&nbsp;Визит</a></li>
			<li><a href="#nogo24" id="addclient" id2="6"><img height="13px" style="opacity:0.7" src=".\img\1test-drive.png">&nbsp;&nbsp;&nbsp;Ком-предложение</a></li>
			<li><b>Out</b></li>
			<li><a href="#nogo26" id="addclient" id2="4"><img height="13px" style="opacity:0.2" src=".\img\1zvonok.png">&nbsp;&nbsp;&nbsp;Звонок Out</a></li>
			<li><a href="#nogo26" id="addclient" id2="5"><img height="13px" style="opacity:0.2" src=".\img\1vizit.png">&nbsp;&nbsp;&nbsp;Визит Out</a></li>
			<li><a href="#nogo26" id="addclient" id2="7"><img height="13px" style="opacity:0.2" src=".\img\1test-drive.png">&nbsp;&nbsp;&nbsp;Ком-предложение Out</a></li>
			<li><b>Новость</b></li>
			<li><a href="#nogo26" id="addnews"><img height="13px" style="opacity:0.8" src=".\img\news.png">&nbsp;&nbsp;&nbsp;Добавить новость</a></li>
		</ul>
	</li>
	<li class="top"><a href="#nogo27" id="contacts" class="top_link"><span class="down">Рейтинг</span></a>
		<ul class="sub" id="reiting3">
		</ul>
	</li>
	<li class="top"><a href="#nogo53" id="shop" class="top_link"><span class="down">Вид</span></a>
		<ul class="sub" id="show-i">
			<li><b>Информер слева</b></li>
			<li><a href="#nogo54" id2="i1">Сколько дней до следующего действия</a></li>
			<li><a href="#nogo54" id2="i2">Сколько дней с даты договора</a></li>
			<li><a href="#nogo54" id2="i3">Сколько дней с даты контакта</a></li>
			<li><a href="#nogo54" id2="i4">Вероятность выдачи в этом месяце</a></li>
			<li><a href="#nogo54" id2="i5">Желание клиента</a></li>
		</ul>
	<li class="top"><a href="#n" id="online" class="top_link"><span class="down" style="margin-left:5px;width:200px;"><? echo $fpk_user_short; ?> -чат</span></a>
		<ul class="sub" id="whoonline">
		</ul>
	</li>
	
	<?

function gws_daterus() {

//-- определяем массив для месяцев --
$mounth = array(января, февраля, марта, апреля, мая, июня, июля, августа, сентября, октября, ноября, декабря);
//-- определяем массив для дней недели --
$week = array(воскресенье, понедельник, вторник, среда,четверг, пятница, суббота);

$date_m=$mounth[gmdate('n')-1];
$date_w=$week[gmdate('w')];
$date_d=gmdate('d');

return $date_w." ".$date_d." ".$date_m;

}
?>
  <div id="search">Поиск: <input hint="Можно искать сразу троих: Фролова, 78992, Сидорова+ (Плюс, означает искать по всем менеджерам)" id="textfilter" value=""></div>
	
  <div class="search-ico"><img height="16px" width="16px" src=".\img\find.png" style=""></div>
  <div style="float:right;font-size:16px;color:#333"><? echo gws_daterus(); ?>&nbsp;&nbsp;</div>

</ul>









    
  </div>
  <div id="content">
    <div id="left-col">

	<div class="reiting1" hint="Рейтинг менеджера за 15 прошедших дней">&nbsp;</div>

        <div id="top-left-menu" style="height:24px">
		
		
		<div class="home_title">Клиенты</div>
		<img src="img/home.png" class="home_menu">        
		
		<div id="bubu" style="display:none; height:0"></div>
		<div id="bubu2" style="display:none; height:0"></div>
		</div>
<div id="indented" class="box"> 
  <div class="tabs-right">
  <ul class="tabs" name="ФПК">
  </ul>
  </div>
</div>
        <div id="bottom-left-menu">

		<div id="datepicker" style="font-size:11; margin-top:5px; margin-bottom:5px;margin-left:5px;"></div>
        </div>
        <div id="datediv"  style="visibility: hidden"><? echo gmdate("Y-m-d",cheltime(time())); ?></div>
		<div id="bubu" style="visibility:hidden; height:0"></div>
	
		<div class="left-bottom-top">
		
	<span class="font-minus" style="margin-left:20px;" hint="Уменьшить шрифт дел.">- </span>
	
	<select id="select_type_do" hint="Выбор типа отображения дел: сегодня, выполнены, просрочены и поручено мной." style="z-index:0; width:162px;margin-top:3px;font-size:11px;">
	<option type="today" selected>Сегодня (0)</option>
	<option type="did">Выполнены (<span class="cnt_did"></span>)</option>
	<option type="past">Просрочены (<span class="cnt_past"></span>)</option>
	<option type="slave">Поручено мной (0)</option>
	</select>

<span class="font-plus" hint="Увеличить шрифт дел."> +</span>&nbsp;

	<img src="img/calendar.png" width="18px;" class="opendo_icon" hint="Открыть большой персональный календарь справа.">

		</div>

		<div class="left-bottom">
		<ul class="left_do">
		</ul>
		</div>
		<div class="left-bottom-bottom"> <input id="fast_do" hint="Дело набранное тут - добавляется в календарь, на текущее время +15 минут" value=""> </div>

    </div>


    <div id="right-col">
    <div id="notreaded"></div>
	<?
    //if (@$r=='') include "pages/fpk-main.php"; else include "pages/fpk-".$r.".php"; 
	include "pages/fpk-clients.php";
	?>
	<br>
	
    </div>
    
    
  </div>
  <div id="footer">
   
   
    <div class="title" style="float:left;padding-left:10px;font-size:11px;padding-top:5px;"></div> 

       <span hint="Уведомлять меня о новых событиях и договорах" style="float:right;padding-top:3px;padding-right:16px;"><input type="checkbox" <? echo $message_on; ?> id="on_off_on"></span>

      <div class="roundfooter" id="r5" id3="tst" hint="Количество КОМ-ПР. сегодня (за месяц). Кликните один раз, затем второй для расшифровки." style="margin-right:20px"></div>
      <img src="img/1test-drive.png" width="15px" align="right" style="padding-right:2px;padding-top:5px;opacity:0.7">
      <div class="roundfooter" id="r4" id3="vz" hint="Количество ВИЗИТОВ за сегодня и (за месяц). Кликните один раз, затем второй для расшифровки."></div>
      <img src="img/1vizit.png" width="18px" align="right" style="padding-right:2px;padding-top:5px;opacity:0.7">
      <div class="roundfooter" id="r3" id3="zv" hint="Количество ЗВОНКОВ сегодня (за месяц). Кликните один раз, затем второй для расшифровки."></div>
      <img src="img/1zvonok.png" width="15px" align="right" style="padding-right:2px;padding-top:5px;opacity:0.7">


      <div class="roundfooter" id="r8" id3="out2" hint="Расторжения. Кликните для расшифровки." style="cursor:pointer"></div>
      <img src="img/out.png" width="15px" align="right" style="padding-right:2px;padding-top:4px;opacity:0.7;">

      <div class="roundfooter" id="r6" id3="prognoz" hint="Прогнозируемые ВЫДАЧИ в этом месяце. Кликните для расшифровки." style="cursor:pointer"></div>
      <img src="img/1vidacha.png" width="15px" align="right" style="padding-right:2px;padding-top:4px;opacity:0.4;">

      <div class="roundfooter" id="r2" id3="vd" hint="Количество ВЫДАЧ за сегодня и (за месяц). Кликните один раз, затем второй для расшифровки."></div>
      <img src="img/1vidacha.png" width="15px" align="right" style="padding-right:2px;padding-top:4px;opacity:0.7">
      <div class="roundfooter" id="r1" id3="dg" hint="Количество ДОГОВОРОВ сегодня (за месяц). Кликните один раз, затем второй."></div>
      <img src="img/1dogovor.png" width="15px" align="right" style="padding-right:2px;padding-top:5px;opacity:0.7">


  
  
  
  </div>
</div>

<div id="chat1" class="chat" who="11111111" style="z-index:50000">

<div id="chattop">
<table width="100%" border="0">
  <tr>
    <td width="20" valign="middle"><div id="online" style="online; position:inherit"></div></td>
    <td valign="middle"><div id="chatname" style="cursor:pointer">Балчугов Сергей</div></td>
    <td width="18" align="right" valign="middle"><img src="img/cleardot.gif" alt="Закрыть" name="chatminimize" width="1" height="1" class="chatminimize" id="chatminimize" style="background:url(img/chat.png) no-repeat; width:18; height:18; background-position: -20 -80; cursor:pointer"></td>
    <td width="18" align="right" valign="middle"><img src="img/cleardot.gif" alt="Закрыть" name="chatminimize" width="1" height="1" class="chatminimize" id="chatclose" style="background:url(img/chat.png) no-repeat; width:18; height:18; background-position: -40 -80; cursor:pointer"></td>
  </tr>
</table>
</div>

<div id="chattext">
</div>
<div id="chatbottom">
  <textarea name="content" class="textbox" id="chatcontent" style="height:72px; padding:2px 0px 0px 3px; width:98%; font-size:110%;  overflow-x: auto; overflow-y: hidden; position:relative; resize: none;font-family:Arial, Helvetica, sans-serif"></textarea>
</div>

</div>


<div id="m_cars">
	<div id="m_cars_left">
		<span id="m_close_cars">закрыть</span><br><br>
		<div id="m_left_output"></div>
	</div>
	<div id="m_cars_right">
		<input type="text" class="right_filter"><br><br>
		<div id="m_right_output"></div>
	</div>

</div>


</body>
</html>