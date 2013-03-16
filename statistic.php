<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<html>
<head>
<title>Статистика</title>
<link rel="stylesheet" href="css/css.css" type="text/css">

<link rel="stylesheet" href="css/jquery-ui-1.8.6.custom.css" type="text/css">

   <script>
     Timeline_ajax_url="./timeline/timeline_ajax/simile-ajax-api.js";
//     Timeline_urlPrefix='http://localhost/fpk/timeline/timeline_js/';       
     Timeline_parameters='bundle=true';
   </script>



	<script src="./src/js/jquery.js"></script>
	<script src="./src/js/jquery.tools.min.js"></script>
	<script src="./src/js/jquery-ui-1.8.6.custom.min.js"></script>
	<script src="./src/js/jquery.tmpl.min.js"></script>
	<script src="./src/js/jquery.ui.datepicker-ru.js"></script>
    <script src="files/js/jquery.easing.min.1.3.js" type="text/javascript"></script>
    <link rel='stylesheet' type='text/css' href='./fullcalendar/redmond/theme.css' />
	<script type='text/javascript' src='./fullcalendar/fullcalendar/fullcalendar.js'></script>
	<link rel='stylesheet' type='text/css' href='./fullcalendar/fullcalendar/fullcalendar.css' />
	
    <script src="./src/js/cookie.js"></script>
    <script src="./src/js/expose.js"></script>

    <script src="./src/js/jquery.datetimeentry.js"></script>
    <script src="./src/js/jquery.datetimeentry-ru.js"></script>

    <script type="text/javascript" src="jqgrid/js/i18n/grid.locale-ru.js"></script>
    <script type="text/javascript" src="jqgrid/js/jquery.jqGrid.min.js"></script>

    <script src="./timeline/timeline_js/timeline-api.js?bundle=true" type="text/javascript"></script>

	<script src="./all copy.js"></script>

	<link rel="stylesheet" type="text/css" href="pro_dropdown_3/pro_dropdown_3.css" />

    <link rel="stylesheet" type="text/css" media="screen" href="jqgrid/css/ui.jqgrid.css" />

	
	<script src="pro_dropdown_3/stuHover.js" type="text/javascript"></script>

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

 if (!user($_COOKIE['email'],$_COOKIE['pass'])) { echo "<script> document.location = 'login.html'; </script>"; exit; }
 echo "<script>$.cookie('brand','$fpk_brand',{ expires: 30 });</script>";
 echo "<script>$.cookie('fpk_id','$fpk_id',{ expires: 30 });</script>";
 echo "<script>$.cookie('fpk_job','$fpk_job',{ expires: 30 });</script>";
?>


<body>
<div id="wrap">
  <div id="header">



<ul id="nav">
   
	<li class="top"><a href="#nogo2" class="top_link"><span class="down" id="brand-ico"><img height="17px" src=".\img\logo-<? echo $fpk_brand; ?>.png" style="padding-top:2px;"></span></a>
		<ul class="sub tabs">
		    <li><b>Статистика</b></li>
		    <? if (($fpk_id==11) or ($fpk_id==18)  or ($fpk_id==23) or ($fpk_id==64)  or ($fpk_id==57) or ($fpk_id==67) or ($fpk_id==17) or (stristr($fpk_job,'иректор'))) 
		             { 
		             echo '<li id="cup"><a href="#nogo23" id="cup">Активность дня</a></li>'; 
		             } ?>
			<li id="stat"><a href="#nogo23" id="stat">Активность по месяцам</a></li>
			<li id="statistic"><a id="statistic" href="#">Длина контрактов в днях (TimeLine)</a></li> 
		    <?
		    if ((stristr($fpk_job,'иректор')) or (stristr($fpk_job,'руководитель')))
		    echo '
		    <li><b>Настройки</b></li>
			<li id="SetupUser"><a href="#nogo23" id="SetupUser">Управление пользователями</a></li>';
			?>
			<li id="SetupModels"><a href="#nogo23" id="SetupModels">Типы продукции</a></li>';
		    
			 
		</ul>

	<li class="top"><a href="#nogo2" class="top_link"><span class="down" id="brand"><? echo $fpk_brand; ?></span></a>
		<ul class="sub" id="selectbrand">
		    <li><b>Выбор бренда</b></li>
		    <? if (($fpk_id==11) or ($fpk_id==18) or ($fpk_id==23)  or ($fpk_id==57) or ($fpk_id==64) or ($fpk_id==67) or ($fpk_id==17) or (stristr($fpk_job,'иректор'))) 
		             { 
		             echo mod_ShowBrandlist(1); 
		             } ?>
		</ul>
	<li class="top" id="manager-menu"><a href="#nogo2" id="products" class="top_link"><span class="down"  id="selectmanager"><? echo ( $_COOKIE['mymanager']); if (!$_COOKIE['mymanager']) echo "Все"; ?></span></a>
		<ul class="sub" id="userlist">
			<li><a href="#nogo4">Все</a></li>
			<li><b>Менеджеры</b></li>
		    <? echo mod_ShowUserlist(" job LIKE '%неджер%'"); ?>
			<li><b>Остальные</b></li>
		    <? echo mod_ShowUserlist(" job NOT LIKE '%неджер%'"); ?>
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
	<li class="top"><a href="#nogo53" id="shop" class="top_link"><span class="down">Справка</span></a>
		<ul class="sub">
			<li><b>Инструкция</b></li>
			<li><a target="_blank" href="/fpk/wiki/?page=%D1%EF%F0%E0%E2%EA%E0%CF%EE%CF%F0%EE%E3%F0%E0%EC%EC%E5%D4%CF%CA">Справка по ФПК</a></a></li>
		</ul>
	<li class="top"><a href="#n" id="online" class="top_link"><span class="down" style="margin-left:5px;width:200px;"><? echo $fpk_user_short; ?></span></a>
		<ul class="sub" id="whoonline">
		</ul>
	</li>
	
	<?

function gws_daterus() {

//-- определяем массив для месяцев --
$mounth = array(января, февраля, марта, апреля, мая, июня, июля, августа, сентября, октября, ноября, декабря);
//-- определяем массив для дней недели --
$week = array(воскресенье, понедельник, вторник, среда,четверг, пятница, суббота);

$date_m=$mounth[date('n')-1];
$date_w=$week[date('w')];
$date_d=date('d');

return $date_w." ".$date_d." ".$date_m;

}
?>
  <div id="search">Поиск: <input id="textfilter" value=""></div>
	
  <div class="search-ico"><img height="16px" width="16px" src=".\img\find.png" style=""></div>
  <div style="float:right;font-size:16px;color:#333"><? echo gws_daterus(); ?>&nbsp;&nbsp;</div>

</ul>









    
  </div>
  <div id="content">
    <div id="left-col">


	<div class="reiting1" title="Рейтинг менеджера за 7 прошедших дней">&nbsp;</div>

        <div id="top-left-menu" style="height:10px;">
		<div id="bubu" style="display:none; height:0"></div>
		<div id="bubu2" style="display:none; height:0"></div>
		</div>
<div id="indented" class="box"> 
        <ul class="tabs"> 
        	<li>
                <a id="actual" href="#"><img src="img/contact.png" class="left-ico-1">В работе
                <div class="left-amount" id="actual"></div></a>
            </li> 

        	<li id="lidogovors" class="current">
                <a id="dogovors" href="#"><img src="img/1dogovor.png" class="left-ico-1">Договора
                <div class="left-amount" id="dogovors"></div></a> 
            </li> 

        	<li id="vidan">
                <a id="vidan" href="#"><img src="img/1vidacha.png" class="left-ico-1">Выданы
                <div class="left-amount" id="vidan"></div></a> 
            </li> 


        	<li>
                <a id="credits" href="#"><img src="img/1credit.png" class="left-ico-1">Кредиты
                <div class="left-amount" id="credits"></div></a> 
            </li> 

        	<li>
                <a id="out" href="#"><img src="img/out.png" class="left-ico-1">Out
                </a> 
            </li> 

        	<li>
                <a id="journal_v" href="#"><img src="img/1vidacha.png" class="left-ico-1" style="opacity:0.3">Журнал выдач</a> 
            </li> 
        	<li>
                <a id="journal_t" href="#"><img src="img/1test-drive.png" class="left-ico-1" style="opacity:0.3">Журнал ком.предложений</a> 
            </li> 

        	<li>
                <a id="statistic2" href="#"><img src="img/day.png" class="left-ico-1">Отчет за день
                <div class="left-amount2" id="rr1" title="Договора"></div>
                </a> 
            </li> 
        	<li id="do">
                <a id="do" href="#"><img src="img/do.png" class="left-ico-1">Дела
                <div class="left-amount-do" id="do" title="Просроченные дела"></div><div class="left-amount-do2" id="do" title="Дела на сегодня"></div></a> 
            </li> 

        </ul> 
    </div>
        <div id="bottom-left-menu">

		<div id="datepicker" style="font-size:11; margin-top:5px; margin-bottom:5px;margin-left:5px;"></div>
        </div>
        <div id="datediv"  style="visibility: hidden"><? echo gmdate("Y-m-d",cheltime(time())); ?></div>
		<div id="bubu" style="visibility:hidden; height:0"></div>


    </div>


    <div id="right-col">
	<?
    //if (@$r=='') include "pages/fpk-main.php"; else include "pages/fpk-".$r.".php"; 
	include "pages/fpk-clients.php";
	?>
	<br>
    </div>
    
    
  </div>
  <div id="footer">
   
    <div class="title" style="float:left;padding-left:10px;font-size:12px;padding-top:5px;"></div> 
      <div class="roundfooter" id="r5" id3="tst" title="Ком-предложения" style="margin-right:20px"></div>
      <img src="img/1test-drive.png" width="15px" align="right" style="padding-right:2px;padding-top:5px;opacity:0.7">
      <div class="roundfooter" id="r4" id3="vz" title="Визиты"></div>
      <img src="img/1vizit.png" width="18px" align="right" style="padding-right:2px;padding-top:5px;opacity:0.7">
      <div class="roundfooter" id="r3" id3="zv" title="Звонки"></div>
      <img src="img/1zvonok.png" width="15px" align="right" style="padding-right:2px;padding-top:5px;opacity:0.7">

      <div class="roundfooter" id="r6" id3="prognoz" title="Прогнозируемые выдачи в этом месяце" style="cursor:pointer"></div>
      <img src="img/1vidacha.png" width="15px" align="right" style="padding-right:2px;padding-top:4px;opacity:0.4;">

      <div class="roundfooter" id="r2" id3="vd" title="Выдачи"></div>
      <img src="img/1vidacha.png" width="15px" align="right" style="padding-right:2px;padding-top:4px;opacity:0.7">
      <div class="roundfooter" id="r1" id3="dg" title="Договора"></div>
      <img src="img/1dogovor.png" width="15px" align="right" style="padding-right:2px;padding-top:5px;opacity:0.7">

  
  
  
  </div>
</div>

<div id="chat1" class="chat" who="11111111">

<div id="chattop">
<table width="100%%" border="0">
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
  <textarea name="content" class="textbox" id="content" style="height:36px; padding:2px 0px 0px 3px; width:98%; font-size:110%;  overflow-x: auto; overflow-y: hidden; position:relative; resize: none;font-family:Arial, Helvetica, sans-serif"></textarea>
</div>

</div>



<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->

</script>
</body>
</html>