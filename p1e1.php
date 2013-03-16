<?php

$fpk_brand=$_COOKIE['brand'];
$fpk_id=$_COOKIE['fpk_id'];

function gws_monthrus($i) {

//-- определяем массив для месяцев --
$mounth = array(январь, февраль, март, апрель, май, июнь, июль, август, сентябрь, октябрь, ноябрь, декабрь);
//-- определяем массив для дней недели --
$week = array(воскресенье, понедельник, вторник, среда,четверг, пятница, суббота);

$date_m=$mounth[(int)gmdate("m",$i)-1];



return $date_m;

}


// Подключение и выбор БД
$config = array(
   'themedir' => "themes/",     // path to dir with themes
   'mysql_host' => "localhost",
   'mysql_user' => "root",
   'mysql_password' => "See6thoh",
);

$db = mysql_connect('localhost', 'root', 'See6thoh');
mysql_query("SET NAMES utf8");
mysql_select_db('h116');

# ВНИМАНИЕ!!!
# Данный код не имеет проверок запрашиваемых данных
# что может стать причиной взлома! Обязательно проверяйте все данные
# поступающие от клиента

$page = $_GET['page'];      // Номер запришиваемой страницы
$limit = $_GET['rows'];     // Количество запрашиваемых записей
$sidx = $_GET['sidx'];      // Номер элемента массива по котору следует производить сортировку
                            // Проще говоря поле, по которому следует производить сортировку
$sord = $_GET['sord'];      // Направление сортировки

// Если не указано поле сортировки, то производить сортировку по первому полю
if(!$sidx) $sidx =1;

// Рассчитаем сколько всего страниц займут данные в БД
if( $count > 0 && $limit > 0) {
    $total_pages = ceil($count/$limit);
} else {
    $total_pages = 0;
}
// Если по каким-то причинам клиент запросил
if ($page > $total_pages) $page=$total_pages;

// Рассчитываем стартовое значение для LIMIT запроса
$start = $limit*$page - $limit;
// Зашита от отрицательного значения
if($start <0) $start = 0;


// Начало xml разметки
$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .=  "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>1</total>";
$s .= "<records>".$count."</records>";

//  $fp = fopen('its2.txt', "w");
//  @fwrite($fp, 'rrr='.$rows);
//  fclose($fp);

$mounth = array("01","02","03","04","05","06","07","08","09","10","11","12");
$mounth2 = array(январь, февраль, март, апрель, май, июнь, июль, август, сентябрь, октябрь, ноябрь, декабрь);

// Строки данных для таблицы gmdate("Y-m-d H:i:s",cheltime(time()))
// Не забудьте обернуть текстовые данные в <![CDATA[]]>
for($j=2012;$j>=2008;$j--)
for($i=12;$i>=1;$i-=1) {
   
    $date=$j."-".$mounth[$i-1];
   
    $sql = @mysql_fetch_object(mysql_query("SELECT count(*) cnt FROM `1_clients` WHERE dg LIKE '".$date."%' AND brand = '".$fpk_brand."'"));
    $dg = $sql->cnt;
    
    $sql = @mysql_fetch_object(mysql_query("SELECT count(*) cnt FROM `1_clients` WHERE vd LIKE '".$date."%' AND brand = '".$fpk_brand."'"));
    $vd = $sql->cnt;

    $sql = @mysql_fetch_object(mysql_query("SELECT count(*) cnt FROM `1_clients` WHERE tst LIKE '".$date."%' AND brand = '".$fpk_brand."'"));
    $tst = $sql->cnt;

    $sql = @mysql_fetch_object(mysql_query("SELECT count(*) cnt FROM `1_clients` WHERE vz LIKE '".$date."%' AND brand = '".$fpk_brand."'"));
    $vz = $sql->cnt;

    $sql = @mysql_fetch_object(mysql_query("SELECT count(*) cnt FROM `1_clients` WHERE zv LIKE '".$date."%' AND brand = '".$fpk_brand."'"));
    $zv = $sql->cnt;

 if(($dg+$vd+$tst+$vz+$zv)>0)
   {
    $s .= "<row id='".$i."'>";
    $s .= "<cell><![CDATA[".$j."]]></cell>";
    $s .= "<cell><![CDATA[".$mounth2[$i-1]."]]></cell>";
    $s .= "<cell>".$vd."</cell>";
    $s .= "<cell>".$dg."</cell>";
    $s .= "<cell>".$tst."</cell>";
    $s .= "<cell>".$vz."</cell>";
    $s .= "<cell>".$zv."</cell>";
    $s .= "</row>";
    }
}
$s .= "</rows>";

// Перед выводом не забывайте выставить header
// с типом контента и кодировкой
header("Content-type: text/xml;charset=utf8");
echo $s;
?>