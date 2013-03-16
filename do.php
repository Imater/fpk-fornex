<?
include "db.php";
include('SimpleImage.php');


$fpk_brand=$_COOKIE['brand'];
$fpk_id=$_COOKIE['fpk_id'];
$fpk_job=$_COOKIE['fpk_job'];

 if (isset($HTTP_GET_VARS['_jpg_csimd'])) 
    { 
	}
 else header('Content-type: text/html; charset=utf-8');

//if ($fpk_brand=='Toyota-Wostok')
//{  $fp = fopen('log.html', "a+");
//  @fwrite($fp, 'rrr='.$_SERVER['HTTP_HOST'].' : '.date("Y-m-d H:i:s",cheltime(time()+5*60*60)).' : '.$_SERVER['HTTP_REFERER'].' : <b>'.$fpk_id.'</b> : '.$fpk_job.':'.$fpk_brand.'<br>' );
//  fclose($fp); }


$db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
//mysql_query_my("SET NAMES utf8");
mysql_select_db('h116',$db);   
if (!$db) { echo "Ошибка подключения к SQL :("; exit();}


user2($_COOKIE['email'],$_COOKIE['pass']);



//  $('#indicator').load("do.php?email="+email+"&pass="+pass+"&brand="+brand+"&job="+job, function ()
$sqlnews2="
	UPDATE  `1_users` SET  
	`lastvizit` =  '".gmdate("Y-m-d H:i:s",cheltime(time()))."'
	WHERE  `id` ='".$fpk_id."' LIMIT 1";
    if ($fpk_id!=0) $result2 = mysql_query_my($sqlnews2); 




if (isset($HTTP_GET_VARS['cars_left'])) 
{
echo "<ul><li class_id='-1'>Все модели</li>";

	$w1 = "(SELECT count(*) cnt FROM cars WHERE state LIKE '1%' AND `cars`.klasse_id = `klasses`.id ) cnt1";
	$w2 = "(SELECT count(*) cnt FROM cars WHERE state LIKE '2%' AND `cars`.klasse_id = `klasses`.id ) cnt2";
	$w3 = "(SELECT count(*) cnt FROM cars WHERE state LIKE '3%' AND `cars`.klasse_id = `klasses`.id ) cnt3";

	$sqlnews = "SELECT *, $w1, $w2, $w3 FROM klasses ORDER by name";

  $result = mysql_query_my($sqlnews); 
  $i=0;
  while (@$sql = mysql_fetch_array($result))
    {
    echo '<li class_id="'.$sql['id'].'">'.$sql['name'].' <span class="li_count">'.$sql['cnt1'].'+'.$sql['cnt2'].'+'.$sql['cnt3'].'</span></li>';
    }
  echo '</ul>';


exit;
}

if (isset($HTTP_GET_VARS['cars_right'])) 
{
  $id = $HTTP_GET_VARS['cars_right'];

if($id!=-1)  
  $where = "cars.klasse_id = '".$id."'";
else
  $where = "true";

  $sqlnews = "SELECT cars.*,models.name,colors.color,colors.desc,colors.metallic,interiors.desc interior_desc FROM cars 
LEFT JOIN models ON models.id=cars.model_id 
LEFT JOIN colors ON colors.code=cars.color_id
LEFT JOIN interiors ON interiors.code=cars.interior_id
WHERE $where ORDER by state, models.name, colors.color";

//echo $sqlnews;

  $result = mysql_query_my($sqlnews); 
  $i=1;
  while (@$sql = mysql_fetch_array($result))
    {
    $state = $sql['state'];
    
    echo '<h6 myid="'.$sql['id'].'" group_by="'.$state.'"><span style="display:inline-block;width:40px;margin-right:5px;text-align:right;color:lightgray">'.$i.'.</span> '.$sql['name'].'<i> — '.$sql['color'].' ['.$sql['interior_desc'].']</i><b>' .$sql['price'].'</b></h6>';
	echo '<div class="m_about">';
		echo "<div class='m_label'>Номер заказа:</div><div class='m_text'>".$sql['order']."</div><br>";
		echo "<div class='m_label'>Vin:</div><div class='m_text'>".$sql['vin']."</div><br>";
		echo "<div class='m_label'>Дата производства:</div><div class='m_text'>".$sql['prod_date']."</div><br>";
		echo "<div class='m_label'>Дата прихода:</div><div class='m_text'>".$sql['arrival']."</div><br>";

		if ($sql['order']==1) $metallic = 'металлик';
		else $metallic = 'не металлик';

		echo "<div class='m_label'>Цвет кузова:</div><div class='m_text'>".$sql['desc']." (".$metallic.")</div><br>";
		
		$opt = $sql['real_options'];
		$opt = str_replace("'","",$opt);
		$opt = explode("- ",$opt);
						
		echo "<br><div class='m_label'>Опции:</div><div class='m_text' id='m_options'>"."</div><br>";
		
	echo '</div>';
	$i++;
    }


exit;
}

if (isset($HTTP_GET_VARS['cars_right_opts'])) 
{
  $id = $HTTP_GET_VARS['cars_right_opts'];

  $sqlnews = "SELECT cars.* FROM cars WHERE id = '$id'";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_array($result);

		$opt = $sql['real_options'];
		$opt = str_replace("'","",$opt);
		$opt = explode("- ",$opt);
		
		$text = '<ul>';
		
		
		for($i=1;$i<count($opt);$i++)
			{
			  $code = trim($opt[$i]);

			  $sqlnews2 = "SELECT `desc` FROM opts WHERE `code` = '$code' AND `klasse_id` = '".$sql['klasse_id']."'";
//			  echo $sqlnews2;
			  $result2 = mysql_query_my($sqlnews2); 
	  		  @$sql2 = mysql_fetch_array($result2);
	  		  
	  		  if(!$sql2['desc'])
	  		  	{
				  $sqlnews2 = "SELECT `desc` FROM opts WHERE `code` = '$code'";
//				  echo $sqlnews2;
				  $result2 = mysql_query_my($sqlnews2); 
	  			  @$sql2 = mysql_fetch_array($result2);
	  			  if( $sql2['desc'] ) $sql2['desc'] = '? '.$sql2['desc'];
	  		  	}
	  		  
	  		  $text .= "<li>".$code." — ".$sql2['desc']."</li>";

			}
			
		$text .= '</ul>';
				
		echo $text;
		
exit;
}


if (isset($HTTP_GET_VARS['ShowGTD'])) 
 {
 echo "<h2>GTD</h2>";
 echo "<div class='GTD'>Тут будет дерево";
 echo "<ul>
   		  <li>Клиенты</li>
   		    <ul>
   		    <li><input type='checkbox'>В работе</li>
   		    <li>Договора</li>
   		    <li>Выданы</li>
   		    <li>Кредиты</li>
   		    </ul>
   		  <li>Календарь</li>
   		    <ul>
   		    <li>Дела</li>
   		    <li>Выдачи</li>
   		  <li>Календарь</li>
   		    <ul>
   		    <li>Дела</li>
   		    <li>Выдачи</li>
   		    <li>Тест-драйвы</li>
   		    <li>Подготовки</li>
   		  <li>Календарь</li>
   		    <ul>
   		    <li>Дела</li>
   		    <li>Выдачи</li>
   		    <li>Тест-драйвы</li>
   		    <li>Подготовки</li>
   		  <li>Календарь</li>
   		    <ul>
   		    <li>Дела</li>
   		    <li>Выдачи</li>
   		    <li>Тест-драйвы</li>
   		    <li>Подготовки</li>
   		  <li>Календарь</li>
   		    <ul>
   		    <li>Дела</li>
   		    <li>Выдачи</li>
   		    <li>Тест-драйвы</li>
   		    <li>Подготовки</li>
   		    </ul>
   		    </ul>
   		    </ul>

   		    </ul>

   		    <li>Тест-драйвы</li>
   		    <li>Подготовки</li>
   		    </ul>
   		  <li>Отчеты</li>
   		  <li>Настройки</li>
   		  <li>Новости</li>
   	   </ul>";
 echo "</div>";
 exit;
 }
 
 
 
function dirlist($dir, $bool = "dirs"){
   $truedir = $dir;
   $dir = scandir($dir);
   if($bool == "files"){ // dynamic function based on second pram
      $direct = 'is_dir'; 
   }elseif($bool == "dirs"){
      $direct = 'is_file';
   }
   foreach($dir as $k => $v){
      if(($direct($truedir.$dir[$k])) || $dir[$k] == '.' || $dir[$k] == '..' ){
         unset($dir[$k]);
      }
   }
   $dir = array_values($dir);
   return $dir;
}
function countFiles($dir){ 

    return count(array_filter(glob($dir.'/*'), 'is_file')); 
} 

if (isset($HTTP_GET_VARS['message_on'])) 
 {
$sqlnews2="
	UPDATE  `1_users` SET  
	`message_on` =  '".$HTTP_GET_VARS['message_on']."'
	WHERE  `id` ='".$fpk_id."' LIMIT 1";

  $result = mysql_query_my($sqlnews2); 

 exit;
} 


if (isset($HTTP_GET_VARS['make-all-news-read'])) 
 {

  $sqlnews="UPDATE `1_news` SET `whoread`=CONCAT(`whoread`,'|$fpk_id|') WHERE `whoread` NOT LIKE '%|$fpk_id|%' AND  `towho`= '|brand=$fpk_brand|'";  
  $result = mysql_query_my($sqlnews); 
  echo $sqlnews;

 exit;
} 


 
if (isset($HTTP_GET_VARS['scandir1'])) 
 {

 $dr=dirlist("./upload/files/clients", "files"); // confirm list on files in the directory  
for($i=0; $i<count($dr); $i++)
  {
  $sqlnews="UPDATE 1_clients SET files = '".countFiles('./upload/files/clients/'.$dr[$i])."' WHERE id='".$dr[$i]."' LIMIT 1";  
  //$result = mysql_query_my($sqlnews); 
  echo $dr[$i].'-'.countFiles('./upload/files/clients/'.$dr[$i]).'<br>';
  }



 exit;
} 

if (isset($HTTP_GET_VARS['FirstSettings'])) 
 {
  $manager = $HTTP_GET_VARS['ShowReiting'];
  echo "<h2>Ваши персональные настройки:</h2><div class='paneto2'><h3 id2='settings'>Вецель Евгений Анатольевич</h3></div><div class='pane'><div class='settings'>
  <input id='turn_on_alerts' hint='Включить в Google Chrome возможность всплывающих сообщений, даже если окно свернуто.' name='show_alert' type='button' value='Включить всплывающие уведомления Google Chrome' style='font-size:+1em;background:#ff8136;-webkit-border-radius:10px;'><br>
  <input id='turn_on_alerts2' hint='Тестировать.' name='show_alert' type='button' value='Тестировать уведомления Google Chrome' style='font-size:+1em;background:#ff8136;-webkit-border-radius:10px;'>
  </div>
  </div>";

//<input value='eugene.leonar@gmail.com' size='50'>

$sqlnews = "SELECT * FROM 1_settings WHERE tojob=''";

  $result = mysql_query_my($sqlnews); 
  while (@$sql = mysql_fetch_array($result))
    {
      if ($sql['type']=='checkbox') 
         echo "<div id=".$sql['id']." class='paneto2' groupby='".$sql['groupsettings']."'>
               <h3 id2='settings' id=".$sql['id'].">
               <INPUT TYPE=CHECKBOX ".$sql['defaultvalue']." 
               NAME=".$sql['short']." VALUE=yes>&nbsp;".$sql['name']."</h3></div>
         <div id=".$sql['id']." class='pane' style='display:none'><div class='settings'>".$sql['description']."</div></div>
         
         
         ";
    }

  

  
  exit;
 }

function cntSum($m, $sqlnews)
{
global $iii, $rrr, $itogo;

        $rrr=5;

        $iii=0;
     	$news=displayNewsAll("fpk-clients-json.php",$sqlnews);
     	$itogo+=(integer)($iii/$m);

     	$rrr=0;

		$sum = '<span class=sumcost itogo=#ITOGO#>'.$iii.' / '.$m.' = <font color=lightgray>'.(integer)($iii/$m).' т.р.</font></span>';
		
     	$news = str_replace('#VD#',$sum,$news);

return $news;
}

////Рейтинг всех менеджеров развёрнутый
if (isset($HTTP_GET_VARS['ShowReiting'])) 
 {
  $manager = $HTTP_GET_VARS['ShowReiting'];
  $gr = $HTTP_GET_VARS['gr'];
  $d1='2011-07-15';
  $d2='2011-10-15';
  $itogo=0;

 if ($manager=='Все') $manager="%";
        $groupby = 'gr';


        ///////////
		$news = cntSum(1, "SELECT *, 'Выдачи: #VD#' gr from 1_clients WHERE brand='$fpk_brand' AND manager LIKE '$manager' AND vd >= '$d1' AND vd <='$d2' LIMIT 600");

		$news .= cntSum(2, "SELECT *, 'Договора: #VD#' gr from 1_clients WHERE brand='$fpk_brand' AND manager LIKE '$manager' AND dg >= '$d1' AND dg <= '$d2' LIMIT 600");

		$news .= cntSum(4, "SELECT *, 'Ком-предложения: #VD#' gr from 1_clients WHERE brand='$fpk_brand' AND manager LIKE '$manager' AND tst >= '$d1' AND tst <= '$d2'  AND 1_clients.out = '0000-00-00 00:00:00' LIMIT 600");

		$news .= cntSum(7, "SELECT *, 'Визиты: #VD#' gr from 1_clients WHERE brand='$fpk_brand' AND manager LIKE '$manager' AND vz >= '$d1' AND vz <= '$d2'  AND 1_clients.out = '0000-00-00 00:00:00' LIMIT 600");

		$news .= cntSum(10, "SELECT *, 'Звонки: #VD#' gr from 1_clients WHERE brand='$fpk_brand' AND manager LIKE '$manager' AND zv >= '$d1' AND zv <= '$d2' AND 1_clients.out = '0000-00-00 00:00:00' LIMIT 600");


		$news .= cntSum(4*5, "SELECT *, 'Ком-предложения OUT: #VD#' gr from 1_clients WHERE brand='$fpk_brand' AND manager LIKE '$manager' AND tst >= '$d1' AND tst <= '$d2'  AND 1_clients.out != '0000-00-00 00:00:00' LIMIT 600");

		$news .= cntSum(7*5, "SELECT *, 'Визиты OUT: #VD#' gr from 1_clients WHERE brand='$fpk_brand' AND manager LIKE '$manager' AND vz >= '$d1' AND vz <= '$d2'  AND 1_clients.out != '0000-00-00 00:00:00' LIMIT 600");

		$news .= cntSum(10*5, "SELECT *, 'Звонки OUT: #VD#' gr from 1_clients WHERE brand='$fpk_brand' AND manager LIKE '$manager' AND zv >= '$d1' AND zv <= '$d2' AND 1_clients.out != '0000-00-00 00:00:00' LIMIT 600");


     	$news = str_replace('#ITOGO#',$itogo,$news);

     	$news = str_replace('},]','}]','['.$news.']');
     	//echo $sqlnews;
    	echo $news; 
		exit;
	   }



///Загрузка
if (isset($HTTP_GET_VARS['csv-load-files'])) 
 {

$dir = $HTTP_GET_VARS['csv-load-files'];

function translit($string)
{
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => "'",  'ы' => 'y',   'ъ' => "'",
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
 
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => "'",  'Ы' => 'Y',   'Ъ' => "'",
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}

class Uploader
{
	private $fileName;
	private $contentLength;
	private $path;
	private $log;
	
	public function __construct($uploads)
	{
		$this->path=$uploads;
		//$log=fopen($this->path . 'log.txt','w');
        if (array_key_exists('HTTP_X_FILE_NAME', $_SERVER) && array_key_exists('CONTENT_LENGTH', $_SERVER)) {
            $this->fileName = $_SERVER['HTTP_X_FILE_NAME'];
			//fwrite($log,"Receiving '" .  $this->fileName . "'\n");
            $this->contentLength = $_SERVER['CONTENT_LENGTH'];
        } else throw new Exception("Error retrieving headers");
	}
    
    public function receive()
    {
        if (!$this->contentLength > 0) {
            throw new Exception('No file uploaded!');
        }
		echo 'Путь='.$this->path . $this->fileName.' : '.translit($this->fileName).'#';
        file_put_contents(
            $this->path . translit($this->fileName),
            file_get_contents("php://input")
        );
        
		$file = './'. $this->path . $this->fileName;

   jsLog("Загружен файл ($file).",0,3,'');
		
		
		$fileto=$this->path . 'thumb/'.translit($this->fileName);
		
   $image = new SimpleImage();
   $image->load($file);

   $image->resizeToHeight(1024);
   $image->save($file);		

   $image->resizeToHeight(300);
   $image->save($fileto);		

		echo $file.' = '.$fileto;

		//fclose($log);
        return true;
    }
}

$uploads="upload/".$dir."/";

if(!is_dir($uploads)) mkdir($uploads, 0777);
if(!is_dir($uploads.'thumb/')) mkdir($uploads.'thumb/', 0777);

//  $fp = fopen('its2.txt', "w");
//  @fwrite($fp, 'rrr='.$dir);
//  fclose($fp);

try {
	$ft = new Uploader($uploads);
	$ft->receive();
} catch (Exception $e) {
//	$fd=fopen($uploads . 'err.txt','w');
//    fwrite($fd,'Caught exception: ' .  $e->getMessage() . "\n");
//	fclose($fd);
}

exit;
}


if (isset($HTTP_GET_VARS['textfilter'])) 
{
$q = strtolower($_GET["q"]);
$radio = $_COOKIE['menu-current'];

if (!$q) return;

$sqlnews = "SELECT fio, manager FROM 1_clients WHERE fio LIKE '%$q%' AND brand = '$fpk_brand' LIMIT 50";

if (($radio==14) or ($radio==15) or ($radio==16))
	$sqlnews = "SELECT DISTINCT(i3) fio, (CONCAT((SELECT count(*) FROM 1_cars cr2 WHERE 1_cars.i3 = cr2.i3 AND cr2.i21 NOT LIKE 'SOLD%' AND cr2.i21 NOT LIKE '%Продан клиенту%' AND cr2.i12 NOT LIKE '%отменен%'), ' шт')) manager FROM 1_cars WHERE i3 LIKE '%$q%'  AND 1_cars.i21 NOT LIKE 'SOLD%' AND 1_cars.i21 NOT LIKE '%Продан клиенту%' AND 1_cars.i12 NOT LIKE '%отменен%' ORDER by i3 LIMIT 500";


//echo $sqlnews;

  $result = mysql_query_my($sqlnews); 
  $i=0;
  while (@$sql = mysql_fetch_array($result))
    {
    $res[$i]['name'] = $sql['fio'];
    
    $fiom = explode(' ',$sql['manager']);
    
    $res[$i]['manager'] = $fiom[0];
    $i++;
    }

//$result[]['name']='ФПК';
//$result[]['name']='Фамилия';

echo json_encode($res);
exit;
}

if (isset($HTTP_GET_VARS['textout'])) 
{
$q = strtolower($_GET["q"]);
$radio = $_COOKIE['menu-current'];

if (!$q) return;

$sqlnews = "SELECT fio, manager FROM 1_clients WHERE fio LIKE '%$q%' AND brand = '$fpk_brand' LIMIT 50";

if (($radio==14) or ($radio==15) or ($radio==16))
	$sqlnews = "SELECT DISTINCT(i3) fio, (CONCAT((SELECT count(*) FROM 1_cars cr2 WHERE 1_cars.i3 = cr2.i3 AND cr2.i21 NOT LIKE 'SOLD%' AND cr2.i21 NOT LIKE '%Продан клиенту%' AND cr2.i12 NOT LIKE '%отменен%'), ' шт')) manager FROM 1_cars WHERE i3 LIKE '%$q%'  AND 1_cars.i21 NOT LIKE 'SOLD%' AND 1_cars.i21 NOT LIKE '%Продан клиенту%' AND 1_cars.i12 NOT LIKE '%отменен%' ORDER by i3 LIMIT 500";


//echo $sqlnews;

  $result = mysql_query_my($sqlnews); 
  $i=0;
  while (@$sql = mysql_fetch_array($result))
    {
    $res[$i]['name'] = $sql['fio'];
    
    $fiom = explode(' ',$sql['manager']);
    
    $res[$i]['manager'] = $fiom[0];
    $i++;
    }

//$result[]['name']='ФПК';
//$result[]['name']='Фамилия';

echo json_encode($res);
exit;
}



if (isset($HTTP_GET_VARS['phonefilter'])) 
{
$q = strtolower($_GET["q"]);
if (!$q) return;
if (strlen($q)>=7) $q = mb_substr($q, strlen($q)-7, strlen($q),'utf-8');

$sqlnews = "SELECT phone1, fio, manager FROM 1_clients WHERE phone1 LIKE '%$q%' AND brand = '$fpk_brand' LIMIT 10 UNION
SELECT phone2, fio, manager FROM 1_clients WHERE phone2 LIKE '$q%' AND brand = '$fpk_brand' LIMIT 10 UNION
SELECT phone3, fio, manager FROM 1_clients WHERE phone3 LIKE '$q%' AND brand = '$fpk_brand' LIMIT 10 UNION
SELECT phone4, fio, manager FROM 1_clients WHERE phone4 LIKE '$q%' AND brand = '$fpk_brand' LIMIT 10";


//echo $sqlnews;

  $result = mysql_query_my($sqlnews); 
  $i=0;
  while (@$sql = mysql_fetch_array($result))
    {
    $res[$i]['phone1'] = $sql['phone1'];
    
    $fiom = explode(' ',$sql['manager']);
    $fiofio = explode(' ',$sql['fio']);
    
    $res[$i]['fio'] = $fiofio[0].' - '.$fiom[0];
    $i++;
    }

//$result[]['name']='ФПК';
//$result[]['name']='Фамилия';

echo json_encode($res);
exit;
}



if (isset($HTTP_GET_VARS['ShowTypeNews'])) 
{
$q = strtolower($_GET["q"]);
if (!$q) return;

$sqlnews = "SELECT DISTINCT(nn.tag) name, (SELECT count(*) cnt FROM 1_news WHERE 1_news.tag = nn.tag) cnt FROM 1_news nn";

  $result = mysql_query_my($sqlnews); 
  $i=0;
  while (@$sql = mysql_fetch_array($result))
    {
    $res[$i]['name'] = $sql['name'];
    $res[$i]['cnt'] = $sql['cnt'];
    $i++;
    }

//$result[]['name']='ФПК';
//$result[]['name']='Фамилия';

echo json_encode($res);
exit;
}

if (isset($HTTP_GET_VARS['DeleteFile'])) 
{
  $id=$HTTP_GET_VARS['DeleteFile'];
  
  $idd = explode("/",$id);
  
  $file = "./upload/$idd[2]/thumb/$idd[3]";
  
  if($id) { unlink($id); unlink($file); }

  jsLog("Удален файл ($id).",0,3,'');

  
exit;
}

if (isset($HTTP_GET_VARS['NewsToNote'])) 
{
  $id=$HTTP_GET_VARS['NewsToNote'];
  
  $sqlnews="SELECT towho FROM 1_news WHERE id='$id' LIMIT 1";  

  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_array($result);
  
  $towho = $sql['towho'];
  
  $towho = $towho."|$fpk_id|";
  
  $sqlnews="UPDATE 1_news SET towho = '$towho' WHERE id='$id' LIMIT 1";  

  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_array($result);
  

exit;
}

if (isset($HTTP_GET_VARS['NoteToNews'])) 
{
  $id=$HTTP_GET_VARS['NoteToNews'];
  
  $sqlnews="SELECT towho FROM 1_news WHERE id='$id' LIMIT 1";  

  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_array($result);
  
  $towho = $sql['towho'];
  
  $towho = str_replace("|$fpk_id|","|$fpk_brand|",$towho);
  
  echo $towho;
  
  $sqlnews="UPDATE 1_news SET towho = '$towho' WHERE id='$id' LIMIT 1";  

  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_array($result);
  

exit;
}



if (isset($HTTP_GET_VARS['DeleteNews'])) 
{
  $id=$HTTP_GET_VARS['DeleteNews'];
  
  $sqlnews="DELETE FROM 1_news WHERE id='$id' LIMIT 1";  

  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_array($result);

  if($id) full_del_dir('upload/'.$id);
  
   jsLog("Удалена новость (№$id).",0,3,'');
 
  
exit;
}

function full_del_dir ($directory)
  {
  $dir = opendir($directory);
  while(($file = readdir($dir)))
  {
    if ( is_file ($directory."/".$file))
    {
      unlink ($directory."/".$file);
    }
    else if ( is_dir ($directory."/".$file) &&
             ($file != ".") && ($file != ".."))
    {
      full_del_dir ($directory."/".$file);  
    }
  }
  closedir ($dir);
  rmdir ($directory);
  }


if (isset($HTTP_POST_VARS['postnews'])) 
{
$text=$_POST['postnews'];
$id=$_POST['id'];

  $sqlnews="UPDATE 1_news SET 
            1_news.text = '$text',
            1_news.title = '".$_POST['titlenews']."',
            1_news.tag = '".$_POST['selecttypenews']."'
            
            WHERE id='$id' LIMIT 1";  

  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_array($result);

  jsLog("Новость №$id отредактированна.",0,3,$sqlnews);


exit;
}

if (isset($HTTP_GET_VARS['AddNews'])) 
 {
$sqlnews="INSERT INTO `1_news` (`id`, `title`, `text`, `tag`, `date1`, `date2`, `manager`, `whoread`, `towho`, `important`) VALUES (NULL, 'Новость ".gmdate("Y-m-d H:i:s",cheltime(time()))."', '', '', '".gmdate("Y-m-d H:i:s",cheltime(time()))."', '".gmdate("Y-m-d H:i:s",time()+60*60*24*31)."', '$fpk_id', '|$fpk_id|', '|brand=$fpk_brand|', '3')";

echo $sqlnews;


   $result = mysql_query_my($sqlnews); 

   $sqlnews="SELECT max(id) maxid FROM `1_news`";

   $result = mysql_query_my($sqlnews); 

   $sql = mysql_fetch_object ($result);
   echo $sql->maxid;

  jsLog("Новость №$sql->maxid добавленна.",0,5,'');


exit;
 }

if (isset($HTTP_GET_VARS['ShowNews'])) 
 {
 	
 
  $radio=$HTTP_GET_VARS['ShowSQLcars'];
  $manager = $HTTP_GET_VARS['manager'];
  $order2 = $HTTP_GET_VARS['order2'];
  $filter=$HTTP_GET_VARS['filter'];
  $alldate=$HTTP_GET_VARS['ALLDate'];
  $vin=$HTTP_GET_VARS['vin'];
  $id=$HTTP_GET_VARS['id'];

  $groupby=$HTTP_GET_VARS['groupby'];
    if ($groupby=='undefined') $groupby='date_month';


  $type = $HTTP_GET_VARS['ShowNews'];
  
  if ($id) 
      {
      $sqlnews="SELECT *, LEFT(1_news.date1,7) date_month, 1_news.id id1, 1_users.fio fio, 1_users.job, 1_users.brand mybrand FROM 1_news JOIN 1_users ON 1_users.id = 1_news.manager WHERE 1_news.id=".$id."";
	  //Отмечаем что этот пользователь читал новость//
	  $sqlnews2 = "UPDATE 1_news SET whoread = CONCAT(whoread,'|".$fpk_id."|') WHERE id = $id AND whoread NOT LIKE '%|$fpk_id|%' LIMIT 1;";
	  $result2 = mysql_query_my($sqlnews2); 
      }
    else
      {
if ($type==1)  
  $sqlnews="SELECT *, LEFT(1_news.date1,7) date_month, 1_news.id id1, 1_users.fio fio, 1_users.job, 1_users.brand mybrand FROM 1_news JOIN 1_users ON 1_users.id = 1_news.manager WHERE ((1_news.towho LIKE '%|user=$fpk_id|%') OR (1_news.towho LIKE '%|brand=$fpk_brand|%')  OR (1_news.towho = '%')) ORDER by $groupby DESC, 1_news.date1 DESC LIMIT 70";  

if ($type==3)  
  $sqlnews="SELECT *, LEFT(1_news.date1,7) date_month, 1_news.id id1, 1_users.fio fio, 1_users.job, 1_users.brand mybrand FROM 1_news JOIN 1_users ON 1_users.id = 1_news.manager WHERE ((1_news.towho LIKE '%|user=$fpk_id|%') OR (1_news.towho LIKE '%|brand=$fpk_brand|%')  OR (1_news.towho = '%'))  AND 1_news.whoread NOT LIKE '%|$fpk_id|%' AND date1 < NOW() - INTERVAL 10 MINUTE ORDER by 1_news.date1 DESC  LIMIT 3";  


if ($type==2)  
  $sqlnews="SELECT *, 1_news.id id1, 1_users.fio fio, 1_users.job, 1_users.brand mybrand FROM 1_news JOIN 1_users ON 1_users.id = 1_news.manager WHERE (1_news.towho LIKE '%|$fpk_id|%') ORDER by 1_news.tag, 1_news.date1 DESC LIMIT 70";  


if ($type==4)  
  $sqlnews="SELECT *, LEFT(1_news.date1,7) date_month, 1_news.id id1, 1_users.fio fio, 1_users.job, 1_users.brand mybrand FROM 1_news JOIN 1_users ON 1_users.id = 1_news.manager WHERE (1_news.towho LIKE '%|help|%') ORDER by $groupby DESC, 1_news.date1 DESC LIMIT 70";  

      }
//	echo $sqlnews;

  $result = mysql_query_my($sqlnews); 
  $j=0;
  while (@$sql = mysql_fetch_array($result))
    {
    $fio = explode(' ', $sql['fio']);
    
/////////////////////Дата/////////    
       $long="";
//$dd=(int)( ((strtotime($sql['date1']))-cheltime(time()) )/60/60*10)/10; 
$dd=(int)( ((gmstrtotime($sql['date1']))-cheltime(gmmktime()) )/60/60*10)/10; 


if (($dd>24) or ($dd<-24)) 
   { 
    $dd=(int)($dd/24); 
    $long="long";
    if ($dd>=0) $days="+ ".$dd." дн";
       else
    $days=$dd." дн";
   }
else
   { 
    if ($dd>=0) $days="+ ".$dd." ч";
       else
    $days=$dd." ч";
   }
/////////////////////////////////    
    
    $answer[$j]=$sql;
    $answer[$j]['fioshort']=$fio[0];

    if (stristr($sql['whoread'],"|$fpk_id|")) $answer[$j]['newsnew']="0.7";
    else $answer[$j]['newsnew']="1";

    $answer[$j]['files']=news_files($id);
    
    $job = (stristr($fpk_job,'иректор')) || (stristr($fpk_job,'руковод'));

    
    if ( ($fpk_id == $sql['manager']) or ($job))
      $answer[$j]['canedit']='block';
    else
      $answer[$j]['canedit']='none';

      $answer[$j]['whoread2']='<br><br>- - -<br>Прочитали: '.whoread($sql['whoread']);

    
    $answer[$j]['titleshort']=mb_substr(str_replace('"',"`",$sql['title']), 0, 44,'utf-8');

	$tag = explode(' - ',$sql['tag']);
	
    $answer[$j]['tagshort']=$tag[1];
    
    $answer[$j]['groupby']=$sql[$groupby];
    
    $answer[$j]['NEWSDATE']='<span style="opacity:'.$answer[$j]["newsnew"].'" class="shortdate'.$long.' roundleft">'.$days.'</span>';
    $j++;
    }
		if ($answer=='') echo '';
		else
    	  echo json_encode($answer); 
		exit;
	   }

function whoread($whoread)
{
$txt = explode('||','|'.$whoread.'|');


for ($i=1;$i<count($txt)-1;$i++)
  {
  if ($i!=1) $answ .= ', ';
  
  	$sqlnews="SELECT fio FROM `1_users` WHERE id=".$txt[$i];
  	$result = mysql_query_my($sqlnews); 
  	@$sql = mysql_fetch_object ($result);
  
  $answ .= mod_fioshort2($sql);
  }

return $answ;
}




function news_files($id)
{

$dir = "./upload/$id/";   //задаём имя директории
    if(is_dir($dir)) {   //проверяем наличие директории
         $files = scandir($dir);    //сканируем (получаем массив файлов)
         array_shift($files); // удаляем из массива '.'
         array_shift($files); // удаляем из массива '..'

            $file_list.= '<table width="100%" height="100px"><tr height=100px>';

         for($i=0; $i<sizeof($files); $i++) 
            {

            $ext=end(explode(".",$files[$i]));
            
            if ($files[$i]=='thumb') continue;
            
            
			if (@stristr('jpeg,jpg,png,gif',$ext)) 
			    {
				$file_list.= '<td><img class="image" src="'.$dir.'thumb/'.$files[$i].'" srcbig="'.$dir.$files[$i].'" height="100px"></td>';  //выводим все файлы
 				}
			  else
			    {
				if (@stristr('doc,xls,zip,pdf,txt,mp4',$ext)) 
				    {
	    	        $file_list.= '<td><a target="_blank" href="'.str_replace(' ','%20',$dir.$files[$i]).'" title="'.$files[$i].'"><img class="doc" src="img/'.strtolower($ext).'.png" height="100px"></a></td>';  //выводим все файлы
	    	        }
	    	      else
	    	        $file_list.= '<td><a target="_blank" href="'.str_replace(' ','%20',$dir.$files[$i]).'" title="'.$files[$i].'"><img class="doc" src="img/none.png" height="100px"></a></td>';  //выводим все файлы
	            }
            $file_list2.= '<td align="center" valign="top" style="font-size:9px"><span id2="'.$id.'" class="delimg" href='.str_replace(' ','%20',$dir.$files[$i]).'><b>удалить - </b></span>'.$files[$i].'</td>';
            }
            $file_list.= '</tr><tr>'.$file_list2.'</tr></table>';


    } 
    else return '<font color=gray>Файлов нет. Перетащите файлы в эту панель.</font>';
    

return $file_list;
}


if (isset($HTTP_GET_VARS['h3'])) 
 {
   $h3=$HTTP_GET_VARS['h3'];
   $group=$HTTP_GET_VARS['groupby'];

   if (stristr($group,';'))	   
     {
      $status = str_replace(";","",$group);
      
      $sqlnews="UPDATE 1_clients SET status = '$status' WHERE id=$h3";
      $result = mysql_query_my($sqlnews); 
     }

   if (stristr($group,' - желание'))	   
     {
      $icon = $group[0];
      $sqlnews="UPDATE 1_clients SET icon = '$icon' WHERE id=$h3";
      $result = mysql_query_my($sqlnews); 
     }

 jsLog("Клинта перетащили мышкой в новый сатус.",$h3,0,$sqlnews);

 exit;
 }

if (isset($HTTP_GET_VARS['UpdateCarsBusy']))
{
    	$sqlnews3 = "UPDATE 1_cars SET clients = '', dogovor = 0 ";
	    $result3 = mysql_query_my($sqlnews3); 

  $sqlnews="SELECT * from 1_cars WHERE i8 != ''";

  $result = mysql_query_my($sqlnews); 

  while (@$sql = mysql_fetch_array($result))
    {
    echo '<hr>'.$sql['i8'].' = ';

    $sqlnews2="SELECT * from 1_clients WHERE vin = '".$sql['i8']."'";
    $result2 = mysql_query_my($sqlnews2); 
	while (@$sql2 = mysql_fetch_array($result2))
    	{
    	if (($sql2['dg']=='0000-00-00 00:00:00') or ($sql2['out']!='0000-00-00 00:00:00'))
      		{
      		$dogovor=0.3;
      		}
      	else 
      	    {
		    $dogovor=1;      	  
      	    }
    	if ($sql2['out']=='0000-00-00 00:00:00')
    	  {
    	   $sqlnews3 = "UPDATE 1_cars SET clients = CONCAT(clients,'".$sql2['id'].",'), dogovor = $dogovor WHERE id = '".$sql['id']."'";
	       $result3 = mysql_query_my($sqlnews3); 
	      }
		}
    }


exit;
}

if (isset($HTTP_GET_VARS['ShowSQLcars'])) 
 {
  $radio=$HTTP_GET_VARS['ShowSQLcars'];
  $manager = $HTTP_GET_VARS['manager'];
  $groupby = $HTTP_GET_VARS['groupby'];
  $order2 = $HTTP_GET_VARS['order2'];
  $filter=str_replace(' ','%', $HTTP_GET_VARS['filter']);
  
  $alldate=$HTTP_GET_VARS['ALLDate'];
  $vin=$HTTP_GET_VARS['vin'];
  
  
  if($vin)
    {
	$sqlnews="SELECT 1_cars . * , 1_clients.fio, 1_clients.icon2, 1_clients.id clientid
FROM 1_cars
LEFT JOIN 1_clients ON ((1_clients.vin = 1_cars.i8) AND (1_clients.vin<>''))
WHERE 1_cars.i8 = '$vin'
ORDER BY 1_cars.i21, 1_cars.i3, 1_clients.fio
LIMIT 0 , 1";    
    }
  else
    {
    $fields = array ('1_cars.i3', '1_cars.i5', '1_cars.i8');
	$in1="FALSE ";
	
	for($j=0; $j<count($fields); $j++)
	   {
			$explodeFilter = explode(",", $filter);
			for ($i=0; $i<count($explodeFilter); $i++) 
			     {
				 if (strlen(trim($explodeFilter[$i]))>=2) $in1 .= " OR ".$fields[$j]." LIKE '%".trim($explodeFilter[$i])."%'";
				 }
	   }
	if ($filter=='') { $in1 = 'TRUE'; $first = 1;}
	else $first=0;

  	
  	if ($radio == 14) $sqlnews = "SELECT *,UCASE(1_cars.i21) i21 FROM 1_cars
WHERE ($in1) AND 1_cars.i21 NOT LIKE 'SOLD%' AND 1_cars.i21 NOT LIKE '%Продан клиенту%' AND 1_cars.i12 NOT LIKE '%отменен%'
ORDER BY 1_cars.i21, 1_cars.i3
LIMIT $first , 700";

  	if ($radio == 15) $sqlnews = "SELECT * FROM 1_cars
WHERE ($in1) AND 1_cars.i21 NOT LIKE 'SOLD%' AND 1_cars.i21 NOT LIKE '%Продан клиенту%' AND 1_cars.i12 NOT LIKE '%отменен%' 
AND dogovor < 0.5
ORDER BY 1_cars.i21, 1_cars.i3
LIMIT $first , 700";

  	if ($radio == 16) $sqlnews = "SELECT * FROM 1_cars
WHERE ($in1) AND 1_cars.i21 NOT LIKE 'SOLD%' AND 1_cars.i21 NOT LIKE '%Продан клиенту%' AND 1_cars.i12 NOT LIKE '%отменен%'
AND dogovor > 0
ORDER BY 1_cars.i21, 1_cars.i3
LIMIT $first , 700";

//  	echo "'$in1' : <hr>".$sqlnews;
    }

  $result = mysql_query_my($sqlnews); 
  $j=0;
  while (@$sql = mysql_fetch_array($result))
    {
    $color=explode(' /',$sql['i5']);
    $fio=explode(' ',$sql['fio']);
    $model=explode('/',$sql['i3']);

if($sql['dg']=='0000-00-00 00:00:00') { $gray='#6e6e6e'; $lock='lock'; }
  else { $gray="#000"; $lock='unlock'; }

if (!$sql['icon2']) { $color2 = '#2b365a'; }
else
  {
   if ($sql['icon2']=='5') { $cl1=0.05; $cl2=0.0; }
   if ($sql['icon2']=='4') { $cl1=0.15; $cl2=0.2; }
   if ($sql['icon2']=='3') { $cl1=0.3; $cl2=0.35; }
   if ($sql['icon2']=='2') { $cl1=0.4; $cl2=0.45; }
   if ($sql['icon2']=='1') { $cl1=0.95; $cl2=0.96; }
   if ($sql['icon2']=='0') { $cl1=0; $cl2=0; }
   $color2 =  "-webkit-gradient(linear, right top, left top, color-stop($cl1, #2b365a), color-stop($cl2, #516F8F));";
   //return '#516F8F';
  }


    $answer[$j]=$sql;
    $answer[$j]['color']=$color[0];
    $answer[$j]['color2']=$color2;
    $answer[$j]['fioshort']=$fio[0];
    $answer[$j]['model']=$model[0];
    $answer[$j]['gray']=$gray;

    if ($sql['i12']=='SO Blocked') $answer[$j]['colorstatus']='red';
    else $answer[$j]['colorstatus']='gray';

    $answer[$j]['lock']=$lock;

		  $sqlnews3="SELECT fio FROM 1_clients WHERE id IN (".$sql['clients']." -5) ORDER by dg DESC";
		  $result3 = mysql_query_my($sqlnews3); 
		  $clients1='';
		  $kk=0;
		  while (@$sql3 = mysql_fetch_array($result3))
		    {
		    if ($kk>0) $clients1 .= ',';
		    $fioclient = explode(' ',$sql3['fio']);
		    $clients1 .= $fioclient[0];
		    $kk++;
		    }

    $answer[$j]['clientsFIO']=$clients1;


    $j++;
    }

    	echo json_encode($answer); 
		exit;
	   }





if (isset($HTTP_GET_VARS['csv-load'])) 
 {


class Uploader
{
	private $fileName;
	private $contentLength;
	private $path;
	private $log;
	
	public function __construct($uploads)
	{
		$this->path=$uploads;
		$log=fopen($this->path . 'log.txt','w');
        if (array_key_exists('HTTP_X_FILE_NAME', $_SERVER) && array_key_exists('CONTENT_LENGTH', $_SERVER)) {
            $this->fileName = $_SERVER['HTTP_X_FILE_NAME'];
			fwrite($log,"Receiving '" .  $this->fileName . "'\n");
            $this->contentLength = $_SERVER['CONTENT_LENGTH'];
        } else throw new Exception("Error retrieving headers");
	}
    
    public function receive()
    {
        if (!$this->contentLength > 0) {
            throw new Exception('No file uploaded!');
        }
		
        file_put_contents(
            $this->path . $this->fileName,
            file_get_contents("php://input")
        );
        
		fclose($log);

 jsLog("Загружен CSV файл с автомобилями ($this->fileName).",$h3,3,'');

        return true;
    }
}

$uploads="upload/";
try {
	$ft = new Uploader($uploads);
	$ft->receive();
} catch (Exception $e) {
	$fd=fopen($uploads . 'err.txt','w');
    fwrite($fd,'Caught exception: ' .  $e->getMessage() . "\n");
	fclose($fd);
}
fclose($log);

exit;
}









if (isset($HTTP_GET_VARS['csv'])) 
 {
	$uploads="upload/";

  $fh = fopen($uploads.$HTTP_GET_VARS['csv'], "r");
  
	$sqlnews = "TRUNCATE TABLE `1_cars`";
	$result = mysql_query_my($sqlnews);

  $filename=$HTTP_GET_VARS['csv'];

  $time=gmdate("Y-m-d H:i:s",cheltime(time()));
  echo "<h1>Обработка CSV файла ($filename)<br>завершена $time</h1>";
  $ii=0;
while (! feof($fh))
  {
	if ($ii>5000) break;
	$line = fgets($fh, 4096);
	$line = iconv('windows-1251', 'utf-8', $line);
	$l = explode(';',$line);

	
	if ($ii==0) $ll=$l;
	else
		{
		  $options=$l[19].';';
		  for ($k=20; $k<=48; $k++)
		    if ($l[$k]) $options.=$l[$k].';';
		    
		    
			$sqlnews="INSERT INTO `1_cars` (`id`, `i0`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `i9`, `i10`, `i11`, `i12`, `i13`, `i14`, `i15`, `i16`, `i17`, `i18`, `i19`, `i20`, `i21`, `i22`, `i23`, `i24`, `i25`, `i26`, `i27`, `i28`, `i29`, `i30`, `i31`, `i32`, `i33`, `i34`, `i35`, `i36`, `i37`, `i38`, `i39`, `i40`) VALUES (NULL, '$l[0]', '$l[1]', '$l[3]', '$l[4]', '$l[5]', '$l[6]', '$l[7]', '$l[8]', '$l[9]', '$l[10]', '$l[11]', '$l[12]', '$l[13]', '$l[14]', '$l[15]', '$l[16]', '$l[17]', '$l[18]', '$options', '$l[49]', '$l[53]', '$l[54]', '$l[55]', '$l[56]', '$l[57]', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$time');	  		";
			$result = mysql_query_my($sqlnews);
	  	}
	$ii++;
  }
  echo "<h2>Добавлено : $ii автомобилей.</h2>";

 jsLog("Обновлен CSV файл с автомобилями добавлено $ii автомобилей.",$h3,3,'');

  
fclose($fh);
 
 exit;
 }

if (isset($HTTP_GET_VARS['leftdo'])) 
 {
  $type = $HTTP_GET_VARS['leftdo'];
  $manager = $HTTP_GET_VARS['manager'];
  $current = $HTTP_GET_VARS['current'];
  $alldate=$HTTP_GET_VARS['ALLDate'];
  if ($manager=='Все') $manager='%';

  if ($fpk_job == 'Кредитный эксперт') $credit=" OR (1_do.type='Кредит')";

  $sqlnews="SELECT count(*) cnt FROM 1_do  LEFT JOIN 1_clients ON 1_do.client=1_clients.id WHERE date2 LIKE '$alldate%' AND 1_clients.brand = '$fpk_brand' AND (1_do.manager LIKE '$manager' $credit) AND 1_do.checked='0000-00-00 00:00:00' ORDER by date2";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  $cnt_today=$sql->cnt;

  $sqlnews="SELECT count(*) cnt FROM 1_do  LEFT JOIN 1_clients ON 1_do.client=1_clients.id WHERE date2 LIKE '$alldate%' AND 1_clients.brand = '$fpk_brand' AND (1_do.manager LIKE '$manager' $credit) AND 1_do.checked!='0000-00-00 00:00:00' ORDER by date2";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  $cnt_did=$sql->cnt;

  $sqlnews="SELECT count(*) cnt FROM 1_do  LEFT JOIN 1_clients ON 1_do.client=1_clients.id WHERE date2 < '$alldate%' AND 1_clients.brand = '$fpk_brand' AND (1_do.manager LIKE '$manager' $credit) AND 1_do.checked='0000-00-00 00:00:00' ORDER by date2";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  $cnt_past=$sql->cnt;

  	$sqlnews="SELECT count(*) cnt FROM 1_do LEFT JOIN 1_clients ON 1_do.client=1_clients.id 
  	WHERE date2 LIKE '%' 
  	AND ((1_clients.brand = '$fpk_brand') or (1_do.brand = '$fpk_brand')) 
  	AND ((1_do.host LIKE '$manager%') AND (1_do.manager <> 1_do.host)) 
  	AND 1_do.client>0
  	AND 1_do.checked='0000-00-00 00:00:00' ";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  $cnt_slave=$sql->cnt;

  
  
 if ($type == 'today')
  	$sqlnews="SELECT 1_do.*, 1_do.id doid, 1_clients.id clientid, 1_do.manager man2, 1_clients.fio, 1_models.short short  FROM 1_do LEFT JOIN 1_clients ON 1_do.client=1_clients.id LEFT JOIN 1_models ON 1_models.id=1_clients.model 
  	WHERE date2 LIKE '$alldate%' 
  	AND ((1_clients.brand = '$fpk_brand') or (1_do.brand = '$fpk_brand')) 
  	AND ((1_do.manager LIKE '$manager') OR (1_do.manager LIKE '$manager')$credit) 
  	AND 1_do.checked='0000-00-00 00:00:00' 
  	ORDER by date2";

 if ($type == 'did')
  	$sqlnews="SELECT 1_do.*, 1_do.id doid, 1_clients.id clientid , 1_do.manager man2, 1_clients.fio, 1_models.short short  FROM 1_do  LEFT JOIN 1_clients ON 1_do.client=1_clients.id  LEFT JOIN 1_models ON 1_models.id=1_clients.model WHERE date2 LIKE '$alldate%' AND 1_clients.brand = '$fpk_brand' AND (1_do.manager LIKE '$manager' $credit) AND 1_do.checked!='0000-00-00 00:00:00' ORDER by date2";

 if ($type == 'past')
  	$sqlnews="SELECT 1_do.*, 1_do.id doid, 1_clients.id clientid, 1_do.manager man2, 1_clients.fio, 1_models.short short    FROM 1_do  LEFT JOIN 1_clients ON 1_do.client=1_clients.id  LEFT JOIN 1_models ON 1_models.id=1_clients.model WHERE date2 < '$alldate%' AND 1_clients.brand = '$fpk_brand' AND (1_do.manager LIKE '$manager' $credit) AND 1_do.checked='0000-00-00 00:00:00' ORDER by date2";

 if ($type == 'slave')
  	$sqlnews="SELECT 1_do.*, 1_do.id doid, 1_clients.id clientid, 1_do.manager man2, 1_clients.fio, 1_models.short short  FROM 1_do LEFT JOIN 1_clients ON 1_do.client=1_clients.id    LEFT JOIN 1_models ON 1_models.id=1_clients.model 
  	WHERE date2 LIKE '%' 
  	AND ((1_clients.brand = '$fpk_brand') or (1_do.brand = '$fpk_brand')) 
  	AND ((1_do.host LIKE '$manager%') AND (1_do.manager <> 1_do.host)) 
  	AND 1_do.client>0
  	AND 1_do.checked='0000-00-00 00:00:00' 
  	ORDER by date2";


//  echo $sqlnews;
  $result = mysql_query_my($sqlnews); 
  $i=0;	
  while (@$sql = mysql_fetch_object ($result))
        {
		$data['data'][$i]['cnt_today']=$cnt_today;
		$data['data'][$i]['cnt_did']=$cnt_did;
		$data['data'][$i]['cnt_past']=$cnt_past;
		$data['data'][$i]['cnt_slave']=$cnt_slave;
		
		$data['data'][$i]['doid']=$sql->doid;
		$data['data'][$i]['clientid']=$sql->clientid;
		$data['data'][$i]['icontype']=mod_icontypemini($sql);
		$data['data'][$i]['caption']=$sql->text;
		
		$slave = explode(' ', $sql->man2);
		
		$data['data'][$i]['slave']=' [Исполнитель:'.$slave[0].']';
		
		if ($sql->host == $sql->man2 ) $data['data'][$i]['slave']='';
		
		$data['data'][$i]['fio']=mod_fioshort2($sql);
		$data['data'][$i]['model']=mod_modelshort($sql);
		if ($sql->fio=='') 
		   {
		   $data['data'][$i]['fio']='не клиентское';
		   $data['data'][$i]['model']='';
		   }

   $dat = showdatejson($sql->date2,$sql);
    //return '{"class":"'.$dat[0].'","date":"'.$dat[1].'","days":"'.$dat[2].'"}';   

		$data['data'][$i]['date']['classdo']=$dat[0];
		$data['data'][$i]['date']['date']=$dat[1];
		$data['data'][$i]['date']['days']=$dat[2];
		
//		$data['data'][$i]['datecolor']=mod_date2json($sql);

		$host = explode(' ', $sql->host);
		
		if ($manager=='%') $data['data'][$i]['manager']='[Поручил:'.$host[0].']';
		else if (($sql->host) != ($sql->man2)) $data['data'][$i]['manager']='[Поручил:'.$host[0].']';
		         else $data['data'][$i]['manager']='';
		
		
		$i++;
		}
  echo json_encode($data);
 }




if (isset($HTTP_GET_VARS['ShowSQL'])) 
 {
  $radio=$HTTP_GET_VARS['ShowSQL'];
  $manager = $HTTP_GET_VARS['manager'];
  $groupby = $HTTP_GET_VARS['groupby'];
  $order_after_group = $HTTP_GET_VARS['order_after_group'];
  $order2 = $HTTP_GET_VARS['order2'];
  $filter=$HTTP_GET_VARS['filter'];
  $alldate=$HTTP_GET_VARS['ALLDate'];


 if ( ($manager=='Все') or (stristr($filter,'+')) ) $manager="%";
 $filter=str_replace("+","",$filter);
  
  if ($radio==-5)
     {
     $sqlnews="SELECT * FROM 1_clients WHERE id IN ($filter -5)";
	 $groupby = 'manager';
	
	 $iii=0;

	 $news=displayNewsAll("fpk-clients-json.php",$sqlnews);
     $news = str_replace('},]','}]','['.$news.']');
	 echo $news;
 	 
 	 exit;     
     
     }
  
  if ($radio==-2) 
     {
    $fields = array ('1_clients.fio', '1_clients.manager', '1_clients.phone1', '1_clients.phone2', '1_clients.phone3', 
	'1_clients.phone4','1_clients.comment','1_clients.adress','1_do.text', '1_do.comment', '1_clients.vin', '1_clients.status');
	$in1="FALSE ";
	if ($manager!="%") $in2="AND cl.out='0000-00-00 00:00:00' ";
	
	for($j=0; $j<count($fields); $j++)
	   {
			$explodeFilter = explode(",", $filter);
			for ($i=0; $i<count($explodeFilter); $i++) 
			     {
				 if (strlen(trim($explodeFilter[$i]))>2) $in1 .= " OR ".$fields[$j]." LIKE '%".trim($explodeFilter[$i])."%'";
				 }
	   }
	 $sqlnews="SELECT * FROM 1_clients cl WHERE cl.brand LIKE '$fpk_brand' AND cl.id IN (SELECT DISTINCT(1_clients.id) FROM 1_clients LEFT JOIN 1_do ON 1_do.client=1_clients.id WHERE $in1) AND cl.manager LIKE '$manager' ".$in2." ORDER by manager, status LIMIT 0,200";
	 
	 $groupby = 'manager';
	
	 $iii=0;

	 if (($HTTP_GET_VARS['json'])==8)
	 	 $news=displayNewsAll("fpk-clients-json0.php",$sqlnews);
	 	else
	 	 $news=displayNewsAll("fpk-clients-json.php",$sqlnews);
     $news = str_replace('},]','}]','['.$news.']');
	 echo $news;
	 
    jsLog("Поиск клиентов по запросу: ($filter) среди менеджеров: ($manager). Найдено $iii клиентов.",0,1,$iii);
	 
	 
     exit;
     }

  $sqlnews="SELECT * FROM `1_menu` WHERE id=".$radio;
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);

if ($groupby=='undefined')
  if ($manager!='%') 
     {
      if ($sql->groupby!='') 
         $groupby=$sql->groupby; 
        else
           $groupby="manager";
     }
  else
    $groupby=$sql->groupby;
    
	if (isset($HTTP_GET_VARS['type'])) //При клике в Roundfooter2
	   {
	   if ($radio==888) { $man = $manager; if ($man=='Все') $man='%'; $groupby="manager";}
	     if ($HTTP_GET_VARS['downmenu']==1) 	     $order="manager";
			else $order=$HTTP_GET_VARS['type'];
	     
	     $mybrand = str_replace('brand','',$HTTP_GET_VARS['brand']);
	     
		 $sqlnews="SELECT *, 1_clients.".$HTTP_GET_VARS['type']." typetime FROM 1_clients WHERE  1_clients.brand LIKE '".$mybrand."'  AND 1_clients.".$HTTP_GET_VARS['type']." LIKE '$alldate%' AND 1_clients.manager LIKE '$man%' ORDER by 1_clients.".$order;
		 
	     if ($HTTP_GET_VARS['type']=='out2') 
	        {
		 $sqlnews="SELECT *, 1_clients.out typetime FROM 1_clients WHERE  1_clients.brand LIKE '".$HTTP_GET_VARS['brand']."'  AND 1_clients.out LIKE '$alldate%' AND 1_clients.dg != '0000-00-00 00:00:00' AND 1_clients.manager LIKE '$man%' ORDER by 1_clients.out";
			}		 
		//echo $sqlnews;
	     if ($HTTP_GET_VARS['type']=='prognoz') 
	        {
             $groupby="icon2";
			 $sqlnews="SELECT 1_clients.*,1_models.model mymodel,1_models.cost mycost,1_models.short FROM `1_clients` LEFT JOIN 1_models ON 1_clients.model = 1_models.id WHERE 1_clients.brand LIKE '".$HTTP_GET_VARS['brand']."'  AND 1_clients.icon2>=1 AND vd='0000-00-00 00:00:00' ORDER by 1_clients.icon2 DESC";
	        }
	      

     	$news=displayNewsAll("fpk-clients-json.php",$sqlnews);
     	$news = str_replace('},]','}]','['.$news.']');
     	//echo $sqlnews;
    	echo $news; 
		exit;
	   }



  if ($HTTP_GET_VARS['ShowSQL']==12) $groupby="creditmanager";
  
  $sqlnews=$sql->selectsql;
  
  if ($order_after_group!='undefined') $order2=$order_after_group.' DESC';
  if ($groupby=='undefined') $groupby = $sql->groupby;

  
   $sqlnews=str_replace(array('{MANAGER}','{BRAND}','{ORDER}','{ORDER2}', '{DATE}', '{fpk_id}'),array($manager, $fpk_brand, $groupby.' ', $order2, $alldate, $fpk_id), $sqlnews);

  $sqlnews=str_replace(array('icon2', 'icon ','by vd_month '),array('icon2 DESC','icon DESC ','by vd_month DESC '), $sqlnews);

	$page = $HTTP_GET_VARS['page'];
	
//	$re = mysql_query_my($sqlnews);
//	$num = mysql_num_rows($re);
	
//	echo '<hr>'.$num.'<hr>';
	
//	if ($page>=($num/30)) echo 'STOP!!!!!!';
	
	$max=60;
	
//	if ($page>=1) $max=70;
	
	if (isset($HTTP_GET_VARS['page'])) $sqlnews .= " LIMIT ".($page*$max).", $max";

	$news=displayNewsAll("fpk-clients-json.php",$sqlnews);
	$news = str_replace('},]','}]','['.$news.']');
//	echo $sqlnews.'<br>';
	echo $news;
	exit;
 }
/////////////////////////////////////////////////////////////////////////////

if (isset($HTTP_GET_VARS['menu'])) 
 {
  $manager = $HTTP_GET_VARS['manager'];
  $current = $HTTP_GET_VARS['current'];
  $alldate=$HTTP_GET_VARS['ALLDate'];
  if ($manager=='Все') $manager='%';
 
 //Показывать ли отчет Холдинг и настройки пользователей
 if ( stristr($fpk_job,'иректор') ) $not_in='999999';
 else $not_in='22,28';
 
 if($fpk_brand=='1') $not_in2="9999999";
 else $not_in2='2';
 
  $sqlnews="SELECT *, (SELECT count(*) cnt FROM 1_menu m2 WHERE m2.parent_id = m1.id ) childs FROM `1_menu` m1 WHERE m1.parent_id=".$HTTP_GET_VARS['menu'].' AND m1.show=1 AND m1.id NOT IN ('.$not_in.') AND m1.id NOT IN ('.$not_in2.')  order by m1.orderid';
  
  $result = mysql_query_my($sqlnews); 
  $i=0;	
  while (@$sql = mysql_fetch_object ($result))
        {
		$data['data'][$i]['id']=$sql->id;
		$data['data'][$i]['caption']=$sql->caption;
		$data['data'][$i]['left_pic']=$sql->left_pic;
		$data['data'][$i]['parent_id']=$sql->parent_id;
		if ($sql->id==$current) $data['data'][$i]['current']='current';
		$data['data'][$i]['short_caption']=$sql->short_caption;
		$data['data'][$i]['hint']=$sql->title;
		$data['data'][$i]['childs']=$sql->childs;
		if (($sql->amount1==0) and ($sql->amount2==0) and (true)) $data['data'][$i]['right_arrow']='block';
			else $data['data'][$i]['right_arrow']='none';

		if (($sql->amount1==1) and ($sql->amount2==0)) 
		   {
		   $sqlnews1=$sql->amount1sql;
		   $sqlnews1=str_replace(array('{MANAGER}','{BRAND}','{DATE}','{MANAGER}', '{fpk_id}'),array($manager, $fpk_brand, $alldate, $manager, $fpk_id), $sqlnews1);
		   $result1 = mysql_query_my($sqlnews1); 
		   @$sql1 = mysql_fetch_object ($result1);
		   
		   $data['data'][$i]['right_amount1cnt']=$sql1->cnt;
		   $data['data'][$i]['right_amount1']='block';
		   }
			else $data['data'][$i]['right_amount1']='none';

		if (($sql->amount2==1)) 
		    {
		   $sqlnews1=$sql->amount1sql;
		   $sqlnews1=str_replace(array('{MANAGER}','{BRAND}','{DATE}'),array($manager, $fpk_brand, $alldate), $sqlnews1);
		   $result1 = mysql_query_my($sqlnews1); 
		   @$sql1 = mysql_fetch_object ($result1);
		   
		   $data['data'][$i]['right_amount1cnt']=$sql1->cnt;
/////////////////////////////////////////
		   $sqlnews1=$sql->amount2sql;
		   $sqlnews1=str_replace(array('{MANAGER}','{BRAND}','{DATE}'),array($manager, $fpk_brand, $alldate), $sqlnews1);
		   $result1 = mysql_query_my($sqlnews1); 
		   @$sql1 = mysql_fetch_object ($result1);
		   
		   $data['data'][$i]['right_amount2cnt']=$sql1->cnt;

		    $data['data'][$i]['right_amount2']='block';
		    }
		   else $data['data'][$i]['right_amount2']='none';
			

		$i++;
		}
		
  echo json_encode($data);
  exit;
 }


if (isset($HTTP_GET_VARS['menu_groupby'])) 
 {
  $sqlnews="SELECT groupbyfields, groupby FROM 1_menu WHERE id = ".$HTTP_GET_VARS['menu_groupby'];
  
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);

	$fields = explode('#',$sql->groupbyfields);

	for($i=0; $i< count($fields);$i++ )
	  {
	  $f = explode('/',$fields[$i]);
	$data['groupby'][$i]['name']=$f[0];
	$data['groupby'][$i]['field']=$f[1];
	$data['groupby'][$i]['field2']=$f[2];

  if ($f[1] == $sql->groupby) $data['groupby'][$i]['checked']='checked';
  else
	$data['groupby'][$i]['checked']='';

	  }
  echo json_encode($data);
	  
  exit;
 }			
	



if (isset($HTTP_GET_VARS['maketmp'])) 
 {
 
	$sqlnews="SELECT * FROM `1_clients`";
    $result = mysql_query_my($sqlnews); 
	
  while (@$sql = mysql_fetch_object ($result))
	     {
		$sqlnews2="
			UPDATE  `1_clients` SET  
			`tmp` =  '".mod_model2($sql)."'
			WHERE  `id` ='".$sql->id."' LIMIT 1";
			
	    $result2 = mysql_query_my($sqlnews2); 
		echo $sqlnews2.'<hr>';
		 
		 
		 }
 exit;
 }



if (isset($HTTP_GET_VARS['savemodel'])) 
{
$oper=$_POST['oper'];

$id=$_POST['id'];
$model=$_POST['model'];
$short=$_POST['short'];
$cost=$_POST['cost'];
$show=$_POST['show'];
$brand=$_POST['brand'];


  if ($oper=='add')
     {
	 $sqlnews="INSERT INTO `1_models` (`id`, `model`, `brand`, `cost`, `show`, `short`) VALUES (NULL, '$model', '$fpk_brand', '$cost', '$show', '$short')";
	 
    jsLog("Добавлена новая модель ($model)",0,3,$sqlnews);
     }

  if ($oper=='edit')
     {
     $sqlnews="UPDATE `1_models` SET `model` = '$model', `cost` = '$cost', `show` = '$show', `short` = '$short' WHERE `1_models`.`id` = $id;";     
    jsLog("Отредактированна модель $model",0,3,$sqlnews);
     
     }

  if ($oper=='del')
     {
	 $sqlnews1="SELECT count(*) cnt FROM `1_clients` WHERE model='$id' LIMIT 1";
     $result1 = mysql_query_my($sqlnews1);
     @$sql1 = mysql_fetch_object ($result1);
     
     
     
     if ($sql1->cnt == 0) 
        {
        $sqlnews="DELETE FROM `1_models` WHERE id='$id' LIMIT 1";
        jsLog("Удалена модель №$id",0,3,$sqlnews);

        }
     else 
        {
        echo "Вы не можете удалить эту модель, она используется $sql1->cnt раз";
        jsLog("Отказ в удалении модели №$id, т.к. она уже используется",0,3,$sqlnews);
        }
	 
     }

//  $fp = fopen('its2.txt', "w");
//   @fwrite($fp, 'rrr='.$sqlnews);
//  fclose($fp);
     $result = mysql_query_my($sqlnews);
     @$sql = mysql_fetch_object ($result);

}



if (isset($HTTP_GET_VARS['ShowStatPlotCUP'])) 
{

    $alldate=date('Y-m-', strtotime($HTTP_GET_VARS['date']) );

  	$stat=stat("_cup2.txt");
	if ($alldate == gmdate("Y-m-",cheltime(time()))) $dif_sec=time()-$stat[9];
	else $dif_date=10000;
	

if($dif_sec>600)
{

$step=30*24*60*60;

  $k=0;

  $alldate=date('Y-m-', strtotime($HTTP_GET_VARS['date']) );
  $old_vd=0;
  $old_dg=0;
  $old_out=0;
for ($i=1; $i<=31; $i++)
    {
    if ($i<=9) $i='0'.$i;
    
    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE dg LIKE '".$alldate.$i."%' AND 1_clients.out='0000-00-00 00:00:00'";
    $result = mysql_query_my($sqlnews); 
    @$sql = mysql_fetch_object ($result);
	$data[0]['interpolate']=false;
	$data[0]['interpolateSteps']=20;
	$data[0]['label']='Договора';
	$data[0]['data'][$k][0]=(strtotime( $alldate.$i ))*1000;
	if (strtotime( $alldate.$i )>time()) $data[0]['data'][$k][1]=$old_dg;
	  else
		{
		$data[0]['data'][$k][1]=$sql->cnt;
		$old_dg=$sql->cnt;
		}

    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE vd LIKE '".$alldate.$i."%' AND 1_clients.out='0000-00-00 00:00:00'";
    $result = mysql_query_my($sqlnews); 
    @$sql = mysql_fetch_object ($result);
	$data[1]['interpolate']=false;
	$data[1]['interpolateSteps']=2;
	$data[1]['label']='Выдачи';
	$data[1]['data'][$k][0]=(strtotime( $alldate.$i ))*1000;
	if (strtotime( $alldate.$i )>time()) $data[1]['data'][$k][1]=$old_vd;
	else
		{
		$data[1]['data'][$k][1]=$sql->cnt;
		$old_vd=$sql->cnt;
		}

    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE 1_clients.out LIKE '".$alldate.$i."%' AND 1_clients.dg!='0000-00-00 00:00:00'";
    //echo $sqlnews;
    $result = mysql_query_my($sqlnews); 
    @$sql = mysql_fetch_object ($result);
	$data[2]['interpolate']=false;
	$data[2]['interpolateSteps']=2;
	$data[2]['label']='Расторжения';
	$data[2]['data'][$k][0]=(strtotime( $alldate.$i ))*1000;
	if (strtotime( $alldate.$i )>time()) $data[2]['data'][$k][1]=$old_out;
	else
		{
		$data[2]['data'][$k][1]=$sql->cnt;
		$old_out=$sql->cnt;
		}
	  
	  $k++;
	 }


 $mytext = json_encode($data);

  $fp = fopen('_cup2.txt', "w");
  @fwrite($fp, $mytext);
  fclose($fp);
  echo $mytext;
  
}
else
{
  	readfile('_cup2.txt');
}  	


exit;
}





if (isset($HTTP_GET_VARS['ShowStatPlot'])) 
{

$step=30*24*60*60;

	$mans=$HTTP_GET_VARS['mans'];
	$gr=$HTTP_GET_VARS['gr'];
	
	$mans='"'.str_replace(',','","',$mans).'"';

	if (($HTTP_GET_VARS['mans']!='') AND $HTTP_GET_VARS['mans']!='Итого') $m = "AND fio IN (".$mans.")";

    if ($gr=='manager') $sqlnews="SELECT fio FROM `1_users` WHERE brand = '$fpk_brand' AND (job LIKE '%менеджер%' OR job LIKE '%руководитель%')".$m;
    
    if ($gr=='model') $sqlnews="SELECT id fio FROM `1_models` WHERE brand = '$fpk_brand' ".str_replace('fio','id',$m);

    if ($gr=='commercial') $sqlnews="SELECT DISTINCT(commercial) fio FROM `1_clients` WHERE brand = '$fpk_brand' ".str_replace('fio','commercial',$m);
	
//	echo $sqlnews;
	
    $result = mysql_query_my($sqlnews); 
  $k=0;
  while (@$sql = mysql_fetch_object ($result))
    {
	$j=0;
  for ($y=2010;$y<=2011;$y++)	
	for ($i=1; $i<=12; $i++)
	  {
	  $dd1=mktime(0,0,0,$i,1,$y);
	  $dd2=mktime(0,0,0,$i+1,0,$y);
	  
	  $d1=date("Y-m-d", $dd1);
	  $d2=date("Y-m-d", $dd2);

	  if (($y==2010) AND ($i<8)) continue;
	  if ($dd2>(time()+30*24*60*60)) continue;

	  if ($dd1>=time()) 
	     { 
	     $multiply=30/15; 
	     }


	  //echo $d1.' : '.$d2.'<br>';
	  $multiply=1;
	  $type = $HTTP_GET_VARS['ShowStatPlot'];
	  $col="count";
	  $dd=1;
	  if ($type=="le_table_dg") { $vd = Cn($fpk_brand,'dg','%',$gr,$d1,$d2,''); }
	  if ($type=="le_table_vd") { $vd = Cn($fpk_brand,'vd','%',$gr,$d1,$d2,''); }
	  if ($type=="le_table_tst") { $vd = Cn($fpk_brand,'tst','%',$gr,$d1,$d2,''); }
	  if ($type=="le_table_vz") { $vd = Cn($fpk_brand,'vz','%',$gr,$d1,$d2,''); }
	  if ($type=="le_table_zv") { $vd = Cn($fpk_brand,'zv','%',$gr,$d1,$d2,''); }
	  if ($type=="le_table_out") { $vd = Cn($fpk_brand,'1_clients.out','%',$gr,$d1,$d2,''); }
	  if ($type=="le_table_out2") { $vd = Cn($fpk_brand,'1_clients.out','%',$gr,$d1,$d2,' AND dg!="0000-00-00 00:00:00" '); }

	  if ($type=="le_table_days") { $col="days"; $vd = Cn($fpk_brand,'vd','%',$gr,$d1,$d2,''); $dd=$vd['count'][$sql->fio]; }
	  if ($type=="le_table_credits") { $col="credits"; $vd = Cn($fpk_brand,'vd','%',$gr,$d1,$d2,''); $dd=$vd['count'][$sql->fio]/100; }
    
	  $data[$k]['interpolate']=true;
	  if($HTTP_GET_VARS['mans']=='Итого') $data[$k]['interpolate']=false;
	  $data[$k]['interpolateSteps']=10;
	  
	  $data[$k]['label']=$sql->fio;
	  if ($gr=='manager') $data[$k]['label']=mod_fioshort2($sql);
	  if ($gr=='model') $data[$k]['label']=mod_modelfio($sql);
	  	  
	  
	  if($HTTP_GET_VARS['mans']=='Итого') $data[$k]['label']='Итого';
	  $data[$k]['data'][$j][0]=strtotime($d1)*1000;
	  if ($dd!=0) $data[$k]['data'][$j][1]=$vd[$col][$sql->fio]/$dd*$multiply;
	  else $data[$k]['data'][$j][1]=0;

	  if($HTTP_GET_VARS['mans']=='Итого') $data[$k]['data'][$j][1]=$vd['max2'];
	  $j++;
  	  }
  	 if($HTTP_GET_VARS['mans']=='Итого') break;
  	 $k++;
	}


echo json_encode($data);
exit;
}


if (isset($HTTP_GET_VARS['ShowStat'])) 
 {
  //print_r( Cn('Peugeot','tst','%','manager','2011-03-01','2011-03-31') );
    $curPage = $_POST['page'];
    $rowsPerPage = $_POST['rows'];
    $sortingField = $_POST['sidx'];
    $sortingOrder = $_POST['sord'];

  
  $i=0;
  $answer['page'] = 1;
  $answer['total'] = 1;
  $answer['records'] = 1;

//  $field='manager';
//  $field='commercial';
  $field=$HTTP_GET_VARS['field'];

  if ($field=='manager') $sqlnews="SELECT fio FROM `1_users` WHERE brand = '$fpk_brand' AND (job LIKE '%менеджер%' OR job LIKE '%руководитель%')";

  if ($field=='commercial') $sqlnews="SELECT DISTINCT(commercial) fio FROM `1_clients` WHERE brand = '$fpk_brand'";
  if ($field=='model') $sqlnews="SELECT DISTINCT(model) fio FROM `1_clients` WHERE brand = '$fpk_brand'";


    //echo $sqlnews;
    $result = mysql_query_my($sqlnews); 


	$d1=$HTTP_GET_VARS['d1'];
	$d2=$HTTP_GET_VARS['d2'];
	$d1=$_COOKIE['d1'];
	$d2=$_COOKIE['d2'];

	$gray="#b9b9b9";
	
	$vd = Cn($fpk_brand,'vd','%',$field,$d1,$d2,'');
	$dg = Cn($fpk_brand,'dg','%',$field,$d1,$d2,'');
	$tst = Cn($fpk_brand,'tst','%',$field,$d1,$d2,'');
	$vz = Cn($fpk_brand,'vz','%',$field,$d1,$d2,'');
	$zv = Cn($fpk_brand,'zv','%',$field,$d1,$d2,'');
	$out = Cn($fpk_brand,'1_clients.out','%',$field,$d1,$d2,'');
	$out2 = Cn($fpk_brand,'1_clients.out','%',$field,$d1,$d2,' AND dg!="0000-00-00 00:00:00" ');


    while (@$sql = mysql_fetch_object ($result))
      {
      $gr=$sql->fio;
              
      $sum=($vd['count'][$gr]+$dg['count'][$gr]+$tst['count'][$gr]+$vz['count'][$gr]+$zv['count'][$gr]);
      
	  if ($sum!=0) 
	  	{
	  	$answer['rows'][$i]['id']=$gr;
  		$answer['rows'][$i]['cell'][0]=$i+1;

  		$answer['rows'][$i]['cell'][1]=$gr;
	if ($field=='manager')	
  		$answer['rows'][$i]['cell'][1]=mod_fioshort2($sql);
	if ($field=='model')	
  		$answer['rows'][$i]['cell'][1]=mod_modelfio($sql);

		@$conv=(integer)($vd['count'][$gr]/$dg['count'][$gr]*100);
		
  		if ($vd['count'][$gr]) $answer['rows'][$i]['cell'][2]=$vd['procent'][$gr].'% <a id="showclients" href="#" title="'.$vd['clients'][$gr].'"><font color="'.$gray.'">('.$vd['count'][$gr].')</font></a> <a title="Конверсия выдач = Выдачи/Договора" style="color:darkgreen">'.$conv.'%';


		@$conv=(integer)($dg['count'][$gr]/($vz['count'][$gr]+$zv['count'][$gr])*100);
  		
  		if ($dg['count'][$gr]) $answer['rows'][$i]['cell'][3]=$dg['procent'][$gr].'% <a id="showclients" href="#" title="'.$dg['clients'][$gr].'"><font color="'.$gray.'">('.$dg['count'][$gr].')</font></a> <a title="Конверсия договоров = Договора/(Визиты+Первичные звонки)" style="color:darkgreen">'.$conv.'%';
  		
		@$conv=(integer)($tst['count'][$gr]/($vz['count'][$gr])*100);

  		if ($tst['count'][$gr]) $answer['rows'][$i]['cell'][4]=$tst['procent'][$gr].'% <a id="showclients" href="#" title="'.$tst['clients'][$gr].'"><font color="'.$gray.'">('.$tst['count'][$gr].')</font></a> <a title="Конверсия ком-предложений = Ком-предл./Визиты" style="color:darkgreen">'.$conv.'%';

		@$conv=(integer)($vz['count'][$gr]/($zv['count'][$gr])*100);

  		if ($vz['count'][$gr]) $answer['rows'][$i]['cell'][5]=$vz['procent'][$gr].'% <a id="showclients" href="#" title="'.$vz['clients'][$gr].'"><font color="'.$gray.'">('.$vz['count'][$gr].')</font></a> <a title="Конверсия визитов = Визиты/Звонки" style="color:darkgreen">'.$conv.'%';

  		if ($zv['count'][$gr]) $answer['rows'][$i]['cell'][6]=$zv['procent'][$gr].'% <a id="showclients" href="#" title="'.$zv['clients'][$gr].'"><font color="'.$gray.'">('.$zv['count'][$gr].')</font></a>';

  		$answer['rows'][$i]['cell'][7]=$gr;
	if ($field=='manager')	
  		$answer['rows'][$i]['cell'][7]=mod_fioshort2($sql);
	if ($field=='model')	
  		$answer['rows'][$i]['cell'][7]=mod_modelfio($sql);

		@$conv=(integer)($out['count'][$gr]/($zv['count'][$gr]+$vz['count'][$gr])*100);

  		if ($out['count'][$gr]) $answer['rows'][$i]['cell'][8]=$out['procent'][$gr].'% <a id="showclients" href="#" title="'.$out['clients'][$gr].'"><font color="'.$gray.'">('.$out['count'][$gr].')</font></a> <a title="Конверсия Out = Out / (Визиты+Звонки)" style="color:darkgreen">'.$conv.'%';

		@$conv=(integer)($out2['count'][$gr]/($dg['count'][$gr])*100);

  		if ($out2['count'][$gr]) $answer['rows'][$i]['cell'][9]=$out2['procent'][$gr].'% <a id="showclients" href="#" title="'.$out2['clients'][$gr].'"><font color="'.$gray.'">('.$out2['count'][$gr].')</font></a> <a title="Конверсия Расторжений = Расторжения / (Договора)" style="color:darkgreen">'.$conv.'%';

  		if ($vd['count'][$gr]) $answer['rows'][$i]['cell'][10]='<a id="showclients" href="#" title="'.$vd['clients'][$gr].'">'.(integer)($vd['days'][$gr]/$vd['count'][$gr]).' дн</a>';

  		if ($vd['count'][$gr]) $answer['rows'][$i]['cell'][11]=(integer)(100*($vd['credits'][$gr]/$vd['count'][$gr])).'% <a id="showclients" href="#" title="'.$vd['clients'][$gr].'"><font color="'.$gray.'">('.$vd['credits'][$gr].')</font></a>';
  		
  		@$answer['rows'][$i]['cell'][12]=(integer)($vd['cost'][$gr]/$vd['count'][$gr]);
  		$i++;
  		}
  	  }

	  	$answer['rows'][$i]['id']='Итого';
  		$answer['rows'][$i]['cell'][0]='';
  		$answer['rows'][$i]['cell'][1]='<b>Итого:</b>';
  		if ($vd['max2']) $answer['rows'][$i]['cell'][2]='<b>'.$vd['max2'].'</b>';
  		if ($dg['max2']) $answer['rows'][$i]['cell'][3]='<b>'.$dg['max2'].'</b>';
  		if ($tst['max2']) $answer['rows'][$i]['cell'][4]='<b>'.$tst['max2'].'</b>';
  		if ($vz['max2']) $answer['rows'][$i]['cell'][5]='<b>'.$vz['max2'].'</b>';
  		if ($zv['max2']) $answer['rows'][$i]['cell'][6]='<b>'.$zv['max2'].'</b>';
  		if ($vz['max2']) $answer['rows'][$i]['cell'][7]='';
  		if ($out['max2']) $answer['rows'][$i]['cell'][8]='<b>'.$out['max2'].'</b>';
  		if ($out2['max2']) $answer['rows'][$i]['cell'][9]='<b>'.$out2['max2'].'</b>';
  		if ($vd['days2']) $answer['rows'][$i]['cell'][10]='<b>'.(integer)($vd['days2']/$vd['max2']).' дн';
  		if ($vd['days2']) $answer['rows'][$i]['cell'][11]='<b>'.(integer)($vd['credits2']/$vd['max2']*100).' %</b>';
  		
  		
  		$answer['rows'][$i]['cell'][12]='<b>'.(integer)(array_sum($vd['cost'])/$vd['max2']).' р</b>';

//	print_r($answer);
  
  
  echo json_encode($answer);
  exit;
 }

function Cn($brand, $type, $procent, $line, $d1, $d2, $w)
{

	$d2=$d2." 23:59:59";

    $sqlnews="SELECT * FROM `1_clients` WHERE brand = '".$brand."' AND $type>='$d1' AND $type<='$d2' $w ORDER by 'line'";
    $sqlnews2="SELECT count(*) cnt FROM `1_clients` WHERE brand = '".$brand."' AND $type>='$d1' AND $type<='$d2' $w ORDER by 'line'";
    $result2 = mysql_query_my($sqlnews2);
    @$sql2 = mysql_fetch_object ($result2);
    $max=$sql2->cnt;
    $cost22=0;
    
//	echo $sqlnews;
    $result = mysql_query_my($sqlnews);
    $i=0;
    while (@$sql = mysql_fetch_object ($result))
       {
        if ($line=='manager') $gr=$sql->manager;
        if ($line=='commercial') $gr=$sql->commercial;
        if ($line=='model') $gr=$sql->model;
        
        
		$answer['count'][$gr] += 1;
		
		$days = (strtotime($sql->vd) - strtotime($sql->dg))/(24*60*60);
		if ($days<100) 
		    {
		    $answer['days'][$gr] += $days;
		    if ($type=='vd') $answer['days2'] += $days;
		    }
		if(stristr($sql->creditmanager,'редит'))
		    {
		    $answer['credits'][$gr] += 1;
		    $answer['credits2'] += 1;
		    }

		$answer['clients'][$gr] .= $sql->id.',';
		$answer['procent'][$gr] = (integer)(($answer['count'][$gr]/$max)*100);
		$answer['max'][$gr] = $max;
	    
	    $answer['cost'][$gr] += $sql->cost;
	    if ($sql->cost==0)  //Если цена нулевая, ищем в справочнике модели
	       {
	       $sqlnews77='SELECT cost FROM 1_models WHERE id='.$sql->model;
		    $result77 = mysql_query_my($sqlnews77);
		    @$sql77 = mysql_fetch_object ($result77);
	       
	       $answer['cost'][$gr] += $sql77->cost;
	       if ($sql77->cost==0) $answer['cost'][$gr] += 600000;
		   $cost22=$answer['cost'][$gr];

	       }

		$answer['max2'] = $max;
		$answer['cost22'] += $cost22;
		
       }
       
	return $answer;
}


function CnM($brand, $type, $procent, $line, $d1, $d2, $w)
{

	$d2=$d2." 23:59:59";

    $sqlnews="SELECT * FROM `1_clients` WHERE manager LIKE 'Тарас%' AND brand = '".$brand."' AND $type>='$d1' AND $type<='$d2' $w ORDER by '$line'";
    $sqlnews2="SELECT count(*) cnt FROM `1_clients` WHERE manager LIKE 'Тарас%' AND brand = '".$brand."' AND $type>='$d1' AND $type<='$d2' $w ORDER by '$line'";
    $result2 = mysql_query_my($sqlnews2);
    @$sql2 = mysql_fetch_object ($result2);
    $max=$sql2->cnt;
    $cost22=0;
    
    $result = mysql_query_my($sqlnews);
    $i=0;
    while (@$sql = mysql_fetch_object ($result))
       {
        if ($line=='manager') $gr=$sql->manager;
        if ($line=='commercial') $gr=$sql->commercial;
        if ($line=='model') $gr=$sql->model;
        
		$answer['count'][$gr] += 1;
		
		$days = (strtotime($sql->vd) - strtotime($sql->dg))/(24*60*60);
		if ($days<100) 
		    {
		    $answer['days'][$gr] += $days;
		    if ($type=='vd') $answer['days2'] += $days;
		    }
		if(stristr($sql->creditmanager,'редит'))
		    {
		    $answer['credits'][$gr] += 1;
		    $answer['credits2'] += 1;
		    }

		$answer['clients'][$gr] .= $sql->id.',';
		$answer['procent'][$gr] = (integer)(($answer['count'][$gr]/$max)*100);
		$answer['max'][$gr] = $max;
	    
	    $answer['cost'][$gr] += $sql->cost;
	    if ($sql->cost==0)  //Если цена нулевая, ищем в справочнике модели
	       {
	       $sqlnews77='SELECT cost FROM 1_models WHERE id='.$sql->model;
		    $result77 = mysql_query_my($sqlnews77);
		    @$sql77 = mysql_fetch_object ($result77);
	       
	       $answer['cost'][$gr] += $sql77->cost;
	       if ($sql77->cost==0) $answer['cost'][$gr] += 600000;
		   $cost22=$answer['cost'][$gr];

	       }

		$answer['max2'] = $max;
		$answer['cost22'] += $cost22;
		
       }
       
	return $answer;
}


if (isset($HTTP_GET_VARS['ShowStatManager'])) 
 {
  //print_r( Cn('Peugeot','tst','%','manager','2011-03-01','2011-03-31') );
    $curPage = $_POST['page'];
    $rowsPerPage = $_POST['rows'];
    $sortingField = $_POST['sidx'];
    $sortingOrder = $_POST['sord'];

  
  $i=0;
  $answer['page'] = 1;
  $answer['total'] = 1;
  $answer['records'] = 1;

//  $field='manager';
//  $field='commercial';
  $field=$HTTP_GET_VARS['field'];

	$d1=$HTTP_GET_VARS['d1'];
	$d2=$HTTP_GET_VARS['d2'];
	$d1=$_COOKIE['d1'];
	$d2=$_COOKIE['d2'];

	$gray="#b9b9b9";

function getDatesByWeek($_week_number, $_year = null) {
        $year = $_year ? $_year : date('Y');
        $week_number = sprintf('%02d', $_week_number);
        $date_base = strtotime($year . 'W' . $week_number . '1 00:00:00');
        $date_limit = strtotime($year . 'W' . $week_number . '7 23:59:59');
        return array($date_base, $date_limit);
}

	for($i=0;$i<=date('W')-1;$i++)
	  {
		$dates = getDatesByWeek($i, 2011);
//		echo date('Y-m-d H:i:s', $dates[0]) . ' - ' . date('Y-m-d H:i:s', $dates[1]) . '<br />';

		$d1=date('Y-m-d H:i:s', $dates[0]);
		$d2=date('Y-m-d H:i:s', $dates[1]);

	$vd = CnM($fpk_brand,'vd','%',$field,$d1,$d2,'');
	$dg = CnM($fpk_brand,'dg','%',$field,$d1,$d2,'');
	$tst = CnM($fpk_brand,'tst','%',$field,$d1,$d2,'');
	$vz = CnM($fpk_brand,'vz','%',$field,$d1,$d2,'');
	$zv = CnM($fpk_brand,'zv','%',$field,$d1,$d2,'');
	$out = CnM($fpk_brand,'1_clients.out','%',$field,$d1,$d2,'');
	$out2 = CnM($fpk_brand,'1_clients.out','%',$field,$d1,$d2,' AND dg!="0000-00-00 00:00:00" ');

		print_r($vd);
		echo $i.'<hr>';
      $gr='Тарасова Татьяна Викторовна';
              
      $sum=($vd['count'][$gr]+$dg['count'][$gr]+$tst['count'][$gr]+$vz['count'][$gr]+$zv['count'][$gr]);
//      echo '<b>'.$sum.'</b>';
	  if ($sum!=0) 
	  	{
	  	$answer['rows'][$i]['id']='Тарасова Татьяна Викторовна';
  		$answer['rows'][$i]['cell'][0]=$i+1;

  		$answer['rows'][$i]['cell'][1]=$gr;
  		
		$conv=(integer)($vd['count'][$gr]/$dg['count'][$gr]*100);
		
  		if ($vd['count'][$gr]) $answer['rows'][$i]['cell'][2]=$vd['procent'][$gr].'% <a id="showclients" href="#" title="'.$vd['clients'][$gr].'"><font color="'.$gray.'">('.$vd['count'][$gr].')</font></a> <a title="Конверсия выдач = Выдачи/Договора" style="color:darkgreen">'.$conv.'%';


		$conv=(integer)($dg['count'][$gr]/($vz['count'][$gr]+$zv['count'][$gr])*100);
  		
  		if ($dg['count'][$gr]) $answer['rows'][$i]['cell'][3]=$dg['procent'][$gr].'% <a id="showclients" href="#" title="'.$dg['clients'][$gr].'"><font color="'.$gray.'">('.$dg['count'][$gr].')</font></a> <a title="Конверсия договоров = Договора/(Визиты+Первичные звонки)" style="color:darkgreen">'.$conv.'%';
  		
		$conv=(integer)($tst['count'][$gr]/($vz['count'][$gr])*100);

  		if ($tst['count'][$gr]) $answer['rows'][$i]['cell'][4]=$tst['procent'][$gr].'% <a id="showclients" href="#" title="'.$tst['clients'][$gr].'"><font color="'.$gray.'">('.$tst['count'][$gr].')</font></a> <a title="Конверсия ком-предложения. = Ком-предл./Визиты" style="color:darkgreen">'.$conv.'%';

		$conv=(integer)($vz['count'][$gr]/($zv['count'][$gr])*100);

  		if ($vz['count'][$gr]) $answer['rows'][$i]['cell'][5]=$vz['procent'][$gr].'% <a id="showclients" href="#" title="'.$vz['clients'][$gr].'"><font color="'.$gray.'">('.$vz['count'][$gr].')</font></a> <a title="Конверсия визитов = Визиты/Звонки" style="color:darkgreen">'.$conv.'%';

  		if ($zv['count'][$gr]) $answer['rows'][$i]['cell'][6]=$zv['procent'][$gr].'% <a id="showclients" href="#" title="'.$zv['clients'][$gr].'"><font color="'.$gray.'">('.$zv['count'][$gr].')</font></a>';

  		$answer['rows'][$i]['cell'][7]=$gr;

		$conv=(integer)($out['count'][$gr]/($zv['count'][$gr]+$vz['count'][$gr])*100);

  		if ($out['count'][$gr]) $answer['rows'][$i]['cell'][8]=$out['procent'][$gr].'% <a id="showclients" href="#" title="'.$out['clients'][$gr].'"><font color="'.$gray.'">('.$out['count'][$gr].')</font></a> <a title="Конверсия Out = Out / (Визиты+Звонки)" style="color:darkgreen">'.$conv.'%';

		$conv=(integer)($out2['count'][$gr]/($dg['count'][$gr])*100);

  		if ($out2['count'][$gr]) $answer['rows'][$i]['cell'][9]=$out2['procent'][$gr].'% <a id="showclients" href="#" title="'.$out2['clients'][$gr].'"><font color="'.$gray.'">('.$out2['count'][$gr].')</font></a> <a title="Конверсия Расторжений = Расторжения / (Договора)" style="color:darkgreen">'.$conv.'%';

  		if ($vd['count'][$gr]) $answer['rows'][$i]['cell'][10]='<a id="showclients" href="#" title="'.$vd['clients'][$gr].'">'.(integer)($vd['days'][$gr]/$vd['count'][$gr]).' дн</a>';

  		if ($vd['count'][$gr]) $answer['rows'][$i]['cell'][11]=(integer)(100*($vd['credits'][$gr]/$vd['count'][$gr])).'% <a id="showclients" href="#" title="'.$vd['clients'][$gr].'"><font color="'.$gray.'">('.$vd['credits'][$gr].')</font></a>';
  		
  		$answer['rows'][$i]['cell'][12]=(integer)($vd['cost'][$gr]/$vd['count'][$gr]);
  		}
  	  }

	  	$answer['rows'][$i]['id']='Итого';
  		$answer['rows'][$i]['cell'][0]='';
  		$answer['rows'][$i]['cell'][1]='<b>Итого:</b>';
  		if ($vd['max2']) $answer['rows'][$i]['cell'][2]='<b>'.$vd['max2'].'</b>';
  		if ($dg['max2']) $answer['rows'][$i]['cell'][3]='<b>'.$dg['max2'].'</b>';
  		if ($tst['max2']) $answer['rows'][$i]['cell'][4]='<b>'.$tst['max2'].'</b>';
  		if ($vz['max2']) $answer['rows'][$i]['cell'][5]='<b>'.$vz['max2'].'</b>';
  		if ($zv['max2']) $answer['rows'][$i]['cell'][6]='<b>'.$zv['max2'].'</b>';
  		if ($vz['max2']) $answer['rows'][$i]['cell'][7]='';
  		if ($out['max2']) $answer['rows'][$i]['cell'][8]='<b>'.$out['max2'].'</b>';
  		if ($out2['max2']) $answer['rows'][$i]['cell'][9]='<b>'.$out2['max2'].'</b>';
  		if ($vd['days2']) $answer['rows'][$i]['cell'][10]='<b>'.(integer)($vd['days2']/$vd['max2']).' дн';
  		if ($vd['days2']) $answer['rows'][$i]['cell'][11]='<b>'.(integer)($vd['credits2']/$vd['max2']*100).' %</b>';
  		
  		
  		$answer['rows'][$i]['cell'][12]='<b>'.(integer)(array_sum($vd['cost'])/$vd['max2']).' р</b>';

//	print_r($answer);
  
  
  echo json_encode($answer);

  exit;
 }




if (isset($HTTP_GET_VARS['saveuser'])) 
 {

  $sqlnews="SELECT fio FROM `1_users` WHERE id=".$_POST['id'];
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  $man=$sql->fio;


 $sqlnews="
	UPDATE  `1_clients` SET  
	`manager` =  '".$_POST['fio']."'
	WHERE  brand='".$_POST['brand']."' AND `manager` ='".$man."'";
    $result2 = mysql_query_my($sqlnews); 


 $sqlnews="
	UPDATE  `1_users` SET  
	`fio` =  '".$_POST['fio']."',
	`job` =  '".$_POST['job']."',
	`email` =  '".$_POST['email']."'
	WHERE  `id` ='".$_POST['id']."' LIMIT 1";
    $result2 = mysql_query_my($sqlnews); 
 
 exit;
 }
 

if (isset($HTTP_GET_VARS['saveuser2'])) 
{
$oper=$_POST['oper'];

$id=$_POST['id'];
$model=$_POST['model'];
$short=$_POST['short'];
$cost=$_POST['cost'];
$show=$_POST['show'];
$brand=$_POST['brand'];


  if ($oper=='add')
     {
     }

  if ($oper=='edit')
     {
 		 $sqlnews="SELECT fio FROM `1_users` WHERE id=".$_POST['id'];
 		 $result = mysql_query_my($sqlnews); 
 		 @$sql = mysql_fetch_object ($result);
 		 $man=$sql->fio;
 		
 		
 		$sqlnews="
 			UPDATE  `1_clients` SET  
 			`manager` =  '".$_POST['fio']."'
 			WHERE `manager` ='".$man."'";
 		   $result2 = mysql_query_my($sqlnews); 
 		
 		
 		$sqlnews="
 			UPDATE  `1_users` SET  
 			`fio` =  '".$_POST['fio']."',
 			`job` =  '".$_POST['job']."',
 			`email` =  '".$_POST['email']."'
 			WHERE  `id` ='".$_POST['id']."' LIMIT 1";
 		   $result2 = mysql_query_my($sqlnews); 
 		   
        jsLog("Отредактирован пользователь ($man)",0,3,$sqlnews);
 		   
 		   
     }

  if ($oper=='del')
     {
 	 $sqlnews="SELECT fio FROM `1_users` WHERE id=".$_POST['id'];
 	 $result = mysql_query_my($sqlnews); 
 	 @$sql = mysql_fetch_object ($result);
 	 $man=$sql->fio;


	 $sqlnews1="SELECT count(*) cnt FROM `1_clients` WHERE manager='$man' LIMIT 1";
     $result1 = mysql_query_my($sqlnews1);
     @$sql1 = mysql_fetch_object ($result1);
     
     if (($sql1->cnt == 0) || ($fpk_job=='Генеральный директор')) $sqlnews="DELETE FROM `1_users` WHERE id='$id' LIMIT 1";
     else echo "Вы не можете удалить пользователя, он используется $sql1->cnt раз";
	 
     jsLog("Попытка удаления пользователя (".$_POST['id'].")",0,3,$sqlnews);
	 
     }

//  $fp = fopen('its2.txt', "w");
//   @fwrite($fp, 'rrr='.$sqlnews);
//  fclose($fp);
     $result = mysql_query_my($sqlnews);
     @$sql = mysql_fetch_object ($result);

}


 
 
if (isset($HTTP_GET_VARS['createdo'])) 
 {
 
  $manager=$HTTP_GET_VARS['manager'];
  $startdate=date("Y-m-d H:i:s",strtotime($HTTP_GET_VARS['start']));
  $enddate=date("Y-m-d H:i:s",strtotime($HTTP_GET_VARS['end']));
  $after=$HTTP_GET_VARS['after'];
  if ($after) 
    {
    $time = time()+$after*60;
    
    $startdate=date("Y-m-d H:i:s",$time);
    $enddate=date("Y-m-d H:i:s",$time + 30*60);
    }
  
  $title=$HTTP_GET_VARS['createdo'];
 
  $sqlnews="INSERT INTO `1_do` (`id`, `client`, `brand`, `manager`, `date1`, `date2`, `text`, `comment`, `checked`, `type`, `host`, `important`, `repeat`, `remind`, `created`, `changed`, `starred`, `hostcheck`, `shablon`) VALUES (NULL, '0', '$fpk_brand', '$manager', '$enddate', '$startdate', '$title', '', '0000-00-00 00:00:00', '', '', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '')";
  $result = mysql_query_my($sqlnews); 
  
  //echo $sqlnews;
  
  @$sql = mysql_fetch_object ($result);

  $sqlnews="SELECT max(id) cnt FROM `1_do`";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);

echo $sql->cnt;

     jsLog("Создано дело №$sql->cnt",0,3,'');


exit; 


  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  echo $sql->date2;
  $time = strtotime($sql->date2)+$HTTP_GET_VARS['days']*24*60*60+$HTTP_GET_VARS['minutes']*60;
  if ($HTTP_GET_VARS['allday']==0) $newtime = gmdate("Y-m-d H:i:s",cheltime($time));
  else  $newtime = gmdate("Y-m-d 00:00:00",cheltime($time));

  $sqlnews="UPDATE `1_do` SET date2 = '".$newtime."' WHERE id=".$HTTP_GET_VARS['movedo']." LIMIT 1";
  echo $sqlnews;
  
  $result = mysql_query_my($sqlnews); 
  
 exit;
 }

if (isset($HTTP_GET_VARS['movedo'])) 
 {
//$('#bubu').load("do.php?movedo="+event.id+"&days="+delta+"&minutes="+minutedelta, function ()  
  $sqlnews="SELECT * FROM `1_do` WHERE id=".$HTTP_GET_VARS['movedo'];
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  
  $client = $sql->client;
  $txt = $sql->text;
  
  $readonly = mod_doreadonly($sql);
  
  if ($readonly=='readonly') { echo 'Вы не можете перемещать чужие дела! Перемещение не сохранено. Обратитесь к руководителю.'; exit; }
  
  $time = gmstrtotime($sql->date2)+$HTTP_GET_VARS['days']*24*60*60+$HTTP_GET_VARS['minutes']*60;
  $time2 = gmstrtotime($sql->date1)+$HTTP_GET_VARS['days']*24*60*60+$HTTP_GET_VARS['minutes']*60;
  
  if ($HTTP_GET_VARS['allday']==0) $newtime = gmdate("Y-m-d H:i:s",($time));
  
  else  $newtime = gmdate("Y-m-d 00:00:00",($time));
  $newtime2 = gmdate("Y-m-d H:i:s",($time2));
  
  echo $newtime;

  $sqlnews="UPDATE `1_do` SET date2 = '".$newtime."', date1 = '".$newtime2."' WHERE id=".$HTTP_GET_VARS['movedo']." LIMIT 1";
  
  $result = mysql_query_my($sqlnews); 
  
  jsLog("Перемещение дела №".$HTTP_GET_VARS['movedo']." ($txt)",$client,3,$sqlnews);
  
  
 exit;
 }

////Рейтинг в меню
if (isset($HTTP_GET_VARS['reiting'])) 
 {
    $alldate=gmdate("Y-m-d",cheltime(time()));
    $alldatemonth=gmdate("Y-m",cheltime(time()));
	$alldate=$HTTP_GET_VARS['date'];
	$alldatemonth=substr( $HTTP_GET_VARS['date'], 0, 7 );
	$dat = gmdate("Y-m-d",(strtotime($alldate)-$HTTP_GET_VARS['days']*60*24*60)); //'2011-02-20';
    //Выданы
    $sqlnews="SELECT fio,manager,1_clients.cost cost, 1_models.cost modelcost FROM `1_clients` LEFT JOIN `1_models` ON `1_models`.id=`1_clients`.model WHERE `1_clients`.brand = '".$fpk_brand."' AND vd>'$dat' AND manager NOT LIKE 'Показан%' AND manager NOT LIKE 'Балчуг%' ORDER by manager";
    $result = mysql_query_my($sqlnews); 
    while (@$sql = mysql_fetch_object ($result))
       {
       	  if ($sql->cost==0)  //Если цена нулевая, ищем в справочнике модели
	       {
	       $cost1 = $sql->modelcost;

	       if ($sql->modelcost==0) $cost1 = 600000;
	       }
	     else $cost1 = $sql->cost;
       
        $vd[$sql->manager]+=$cost1;
        $man[$sql->manager]+=$cost1;
	 if ($HTTP_GET_VARS['days']<50) $hint[$sql->manager].="Выдача ".$sql->fio." за ".$cost1."\n";
       }

    //Договора
    $sqlnews="SELECT fio,manager,1_clients.cost cost, 1_models.cost modelcost FROM `1_clients` LEFT JOIN `1_models` ON `1_models`.id=`1_clients`.model WHERE `1_clients`.brand = '".$fpk_brand."' AND dg>'$dat' AND 1_clients.out='0000-00-00 00:00:00' AND manager NOT LIKE 'Показан%' AND manager NOT LIKE 'Балчуг%' ORDER by manager";
    
    $result = mysql_query_my($sqlnews); 
    while (@$sql = mysql_fetch_object ($result))
       {
       
       	  if ($sql->cost==0)  //Если цена нулевая, ищем в справочнике модели
	       {
	       $cost1 = $sql->modelcost;
	       if ($sql->modelcost==0) $cost1 = 600000;
	       }
       
       
       
        $dg[$sql->manager]+=$cost1/2;
        $man[$sql->manager]+=$cost1/2;
      if ($HTTP_GET_VARS['days']<50)  $hint[$sql->manager].="Договор ".$sql->fio." за ".$cost1."\n";
       }


    $sqlnews="SELECT fio,manager,1_clients.cost cost, 1_models.cost modelcost FROM `1_clients` LEFT JOIN `1_models` ON `1_models`.id=`1_clients`.model WHERE `1_clients`.brand = '".$fpk_brand."' AND tst>'$dat' AND 1_clients.out='0000-00-00 00:00:00' AND manager NOT LIKE 'Показан%' AND manager NOT LIKE 'Балчуг%' ORDER by manager";
    
    $result = mysql_query_my($sqlnews); 
    while (@$sql = mysql_fetch_object ($result))
       {
       
       	  if ($sql->cost==0)  //Если цена нулевая, ищем в справочнике модели
	       {
	       $cost1 = $sql->modelcost;
	       if ($sql->modelcost==0) $cost1 = 600000;
	       }
       
       
       
        $dg[$sql->manager]+=$cost1/10;
        $man[$sql->manager]+=$cost1/10;
      if ($HTTP_GET_VARS['days']<50)  $hint[$sql->manager].="Ком-предл. ".$sql->fio." за ".$cost1."\n";
      }

    $sqlnews="SELECT manager,1_clients.cost cost, 1_models.cost modelcost FROM `1_clients` LEFT JOIN `1_models` ON `1_models`.id=`1_clients`.model WHERE `1_clients`.brand = '".$fpk_brand."' AND vz>'$dat' AND 1_clients.out='0000-00-00 00:00:00' AND manager NOT LIKE 'Показан%' AND manager NOT LIKE 'Балчуг%' ORDER by manager";
    
    $result = mysql_query_my($sqlnews); 
    while (@$sql = mysql_fetch_object ($result))
       {
       
       	  if ($sql->cost==0)  //Если цена нулевая, ищем в справочнике модели
	       {
	       $cost1 = $sql->modelcost;
	       if ($sql->modelcost==0) $cost1 = 600000;
	       }
       
       
       
        $dg[$sql->manager]+=$cost1/20;
        $man[$sql->manager]+=$cost1/20;
       }

   @arsort($man);
   
      @$max=$man[key($man)];
   if ($HTTP_GET_VARS['reiting']==3) echo '<li><b>Рейтинг за '.$HTTP_GET_VARS['days'].' дней</b></li><li><b>с '.$dat.' до '.$alldate.'</b></li>';
   for($i=0;$i<count($man);$i++)
      {
      @$procent = (integer)(($man[key($man)]/$max)*100);
      $sum = (integer)(($man[key($man)]));
      
      

      if (($HTTP_GET_VARS['manager']!='Все') and ($HTTP_GET_VARS['reiting']==1) and ($HTTP_GET_VARS['manager']==key($man))) 
         { 
         echo ($i+1).' место - '.$procent.'%'; 
         if ($i==0) echo '<img src="img/crown.png" title="Вы лучше всех. Так держать." style="position:absolute;top:42px;left:100px;width:50px;">';
         if ($i==1) echo '<img src="img/crown.png" title="Поднажми чуть-чуть и станешь лучшим!" style="position:absolute;top:42px;left:110px;width:25px;opacity:0.8">';
         if ($i==count($man)-1) echo '<img src="img/ushanka.png" title="У вас очень низкие продажи. Встряхнитесь." style="position:absolute;top:40px;left:110px;width:40px;opacity:1">';
         //echo $i;
         }

      
      if ($HTTP_GET_VARS['reiting']==3) echo '<li><a title="Сумма:'.$sum."\n".$hint[key($man)].'" href="#nogo28" style="width:250px;float:left;">'.key($man).'</a><a style="width:43px;float:left;text-align:right;">'.$procent.'%</a></li>';
      next($man); 
//print_r($hint);
      }
   if ($HTTP_GET_VARS['reiting']==1) echo '&nbsp;';
   if ($HTTP_GET_VARS['reiting']==2) echo '&nbsp;';
exit;
 }


if (isset($HTTP_GET_VARS['newscup'])) 
 { 
    $alldate=gmdate("Y-m-d",cheltime(time()));
    $alldatemonth=gmdate("Y-m",cheltime(time()));
    
	$alldate=$HTTP_GET_VARS['date'];
	$alldatemonth=mb_substr( $HTTP_GET_VARS['date'], 0, 7,'utf-8' );

//  $sqlnews="SELECT count(*) cnt FROM `1_brands`";
  $sqlnews="SELECT count(*) cnt FROM `1_brands` WHERE 1_brands.Show=1 AND id IN (SELECT DISTINCT(brand) FROM 1_clients WHERE brand!='') ORDER by brandname DESC, title DESC";
  
  //AND vz>DATE_ADD(NOW(), INTERVAL -1 MONTH)

  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  $maxcnt = $sql->cnt;
  
//  $sqlnews="SELECT *, id brand FROM `1_brands` ORDER by brandname DESC, title DESC";
  $sqlnews="SELECT *, id brand FROM `1_brands` WHERE 1_brands.Show=1 AND id IN (SELECT DISTINCT(brand) FROM 1_clients WHERE brand!='' AND vz>DATE_ADD(NOW(), INTERVAL -1 MONTH)) ORDER by brandname DESC, title DESC";

  $result = mysql_query_my($sqlnews); 

  for ($k = 0; $k<= $maxcnt; $k++)
     {
	  @$sql = mysql_fetch_object ($result);
 	  $brand = $sql->brand;
 	  if ($k==$maxcnt) $brand = '%';

    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=5 AND vd='0000-00-00 00:00:00' AND 1_clients.out='0000-00-00 00:00:00' AND brand LIKE '".$brand."'";
    $result1 = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result1);
    $plan1 = $sql1->cnt;

    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=4 AND vd='0000-00-00 00:00:00' AND 1_clients.out='0000-00-00 00:00:00' AND brand LIKE '".$brand."'";
    $result1 = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result1);
    $plan2 = $sql1->cnt;
    
    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=3 AND vd='0000-00-00 00:00:00' AND 1_clients.out='0000-00-00 00:00:00' AND brand LIKE '".$brand."'";
    $result1 = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result1);
    $plan3 = $sql1->cnt;
    
    $vd = cnt2("vd",$alldatemonth,$brand);
    
 	$js[$brand]['amount'][0]=cnt2("dg",$alldate,$brand)." (".cnt2("dg",$alldatemonth,$brand).')';
 	$js[$brand]['amount'][1]=cnt2("vd",$alldate,$brand)." (".cnt2("vd",$alldatemonth,$brand).')';
 	$js[$brand]['amount'][2]=cnt2("zv",$alldate,$brand)." (".cnt2("zv",$alldatemonth,$brand).')';
 	$js[$brand]['amount'][3]=cnt2("vz",$alldate,$brand)." (".cnt2("vz",$alldatemonth,$brand).')';
 	$js[$brand]['amount'][4]=cnt2("tst",$alldate,$brand)." (".cnt2("tst",$alldatemonth,$brand).')';

 	$js[$brand]['amount'][5]=cnt2("out2",$alldate,$brand)." (".cnt2("out2",$alldatemonth,$brand).')';

    $js[$brand]['amount'][6]=$plan1.'+'.$plan2.'+'.$plan3;

    $js[$brand]['amount'][7]='Выданы = '.$vd.' / Подтвержденные: '.($vd+$plan1).' / Вероятные: '.($vd+$plan1+$plan2).' / Маловероятные: '.($vd+$plan1+$plan2+$plan3);


	}
    
//    if (date("Y-m-d",cheltime(time())) == $alldate ) mailto($js,$alldate);
    
if($HTTP_GET_VARS['newscup']==888) echo json_encode($js); 	

exit;
}

function mailto($js,$alldate)
{
if ($fpk_brand!="Peugeot") return true;

$text=$js['Peugeot']['amount'][0].' договоров  / '.$js['Peugeot']['amount'][1].' выдач';

 
  $sqlnews="SELECT status FROM `1_users` WHERE id=11";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  
  if (($sql->status)!=$text)
     {

	    $sqlnews2="SELECT fio, 1_models.model, status, comment FROM `1_clients` LEFT JOIN 1_models ON 1_models.id = 1_clients.model WHERE dg LIKE '$alldate%' AND 1_clients.brand='Peugeot' ORDER by dg DESC";
	    
  		$result2 = mysql_query_my($sqlnews2); 
  		$i=1;
  		$text2="<h3>Договора:</h3>";
		while (@$sql2 = mysql_fetch_object ($result2))
     		{
     		$text2=$text2.''.$i.'. (<b>'.$sql2->model.'</b> '.$sql2->status.') '.$sql2->fio.' <font color=gray><i>['.$sql2->comment.']</i></font><br><br>';
     		$i++;
     		}

	 $sqlnews="UPDATE  `1_users` SET  `status` =  '$text' WHERE  `1_users`.`id` =11 LIMIT 1;";
     $result = mysql_query_my($sqlnews); 



$to  = "Вецель Евгений <eugene.leonar@gmail.com>, " ; 
$to .= "Балчугов Сергей <sbalchugov@gmail.com>"; 

$subject = $text; 

$message = " 
<html> 
    <head> 
        <title>В Леонар Авто сейчас: $text</title> 
    </head> 
    <body> 
    	<h2>В Леонар Авто сейчас: $text</h2>
        <p>$text2</p> 
        <br>
        <br>
        <font color=gray>---<br>Отправляется автоматически при изменении договоров или выдач</font>
    </body> 
</html>"; 

$headers  = "Content-type: text/html; charset=utf8 \r\n"; 
$headers .= "From: ФПК <birthday@example.com>\r\n"; 

mail($to, $subject, $message, $headers); 


     
     }

}

if (isset($HTTP_GET_VARS['cup'])) 
 {
    $alldate=gmdate("Y-m-d",cheltime(time()));
    $alldatemonth=gmdate("Y-m",cheltime(time()));

	$alldate=$HTTP_GET_VARS['date'];
	$alldatemonth=substr( $HTTP_GET_VARS['date'], 0, 7 );

  	$stat=stat("_cup1.txt");
	if ($alldate == gmdate("Y-m-d",cheltime(time()))) $dif_sec=time()-$stat[9];
	else $dif_date=10000;

if($dif_sec>10)
{
  $mytext = ' <h2>Активность за '.gmdate("d-m-Y", strtotime($HTTP_GET_VARS['date'])+24*60*60 ).'<span style="float:right"><a href="#" id="detstat" style="color:#5c5c5c;font-size:14px">детальная статистика</a></span></h2>';
  
  $startTime = microtime();
  
  $sqlnews="SELECT count(*) cnt FROM `1_brands` WHERE 1_brands.Show=1 AND id IN (SELECT DISTINCT(brand) FROM 1_clients WHERE brand!='' AND vz>DATE_ADD(NOW(), INTERVAL -1 MONTH)) ORDER by brandname DESC, title DESC";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  $maxcnt = $sql->cnt;

//  $sqlnews="SELECT * FROM `1_brands` WHERE 1_brands.Show=1 ORDER by brandname DESC, title DESC";

  //показываю только те бренды у которых активность была в течении 1 месяца
  $sqlnews="SELECT * FROM `1_brands` WHERE 1_brands.Show=1 AND id IN (SELECT DISTINCT(brand) FROM 1_clients WHERE brand!='' AND vz>DATE_ADD(NOW(), INTERVAL -1 MONTH)) ORDER by brandname DESC, title DESC";

  $result = mysql_query_my($sqlnews); 


  for ($k = 0; $k<= $maxcnt; $k++)
     {
	  @$sql = mysql_fetch_object ($result);
 	  $brand = $sql->id;
 	  
 	  if ($k==$maxcnt) {$brand = '%'; $brand3='ALL';}
 	  else $brand3=$brand;
 	  
 	  $dg=cnt2("dg",$alldate,$brand)." (".cnt2("dg",$alldatemonth,$brand).')';
 	  $vd=cnt2("vd",$alldate,$brand)." (".cnt2("vd",$alldatemonth,$brand).')';
 	  $zv=cnt2("zv",$alldate,$brand)." (".cnt2("zv",$alldatemonth,$brand).')';
 	  $vz=cnt2("vz",$alldate,$brand)." (".cnt2("vz",$alldatemonth,$brand).')';
 	  $tst=cnt2("tst",$alldate,$brand)." (".cnt2("tst",$alldatemonth,$brand).')';
 	  $out=cnt2("out2",$alldate,$brand)." (".cnt2("out2",$alldatemonth,$brand).')';
 	  
 	  if ($k==$maxcnt) { $brandlogo = 'logo-seyho.png'; $op=' style="opacity:0.75" '; }
 	  else { $brandlogo = $sql->logo; $op = ''; }

	  
	  $mytext .= '<h5 '.$op.' class="notloaded" id2="brand'.$brand3.'" id="'.$brand.'" brandtitle="'.$sql->title.'" logo="img\\'.$sql->logo.'"><img width="30px" src="img\\'.$brandlogo.'" hint="'.$sql->title.'" align="left">&nbsp;';
      $mytext .= '
      <img src="img/1dogovor.png" width="15px" align="left" style="padding-left:15px;padding-right:2px;padding-top:2px;opacity:0.7">
      <div class="roundfooter2" id="dg" title="Договора">'.$dg.'</div>
      <img src="img/1vidacha.png" width="15px" align="left" style="padding-right:2px;padding-top:1px;opacity:0.7">
      <div class="roundfooter2" id="vd" title="Выдачи">'.$vd.'</div>

      <img src="img/OUT.png" width="15px" align="left" style="padding-right:2px;padding-top:1px;opacity:0.7">
      <div class="roundfooter2" id="out2" title="Расторжения" style="font-size:12px;width:50px;opacity:1">'.$out.'</div>

      <img src="img/1zvonok.png" width="15px" align="left" style="padding-right:2px;padding-top:2px;opacity:0.7">
      <div class="roundfooter2" id="zv" title="Звонки">'.$zv.'</div>
      <img src="img/1vizit.png" width="18px" align="left" style="padding-right:2px;padding-top:2px;opacity:0.7">
      <div class="roundfooter2" id="vz" title="Визиты">'.$vz.'</div>
      <img src="img/1test-drive.png" width="15px" align="left" style="padding-right:2px;padding-top:2px;opacity:0.7">
      <div class="roundfooter2" id="tst" title="Ком-предложения" style="margin-right:20px">'.$tst.'</div>
      ';


///////////////////////////////////////////////

	
    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=5 AND vd='0000-00-00 00:00:00' AND 1_clients.out='0000-00-00 00:00:00' AND brand LIKE '".$brand."'";
    $result1 = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result1);
    $plan1 = $sql1->cnt;

    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=4 AND vd='0000-00-00 00:00:00' AND 1_clients.out='0000-00-00 00:00:00' AND brand LIKE '".$brand."'";
    $result1 = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result1);
    $plan2 = $sql1->cnt;
    
    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=3 AND vd='0000-00-00 00:00:00' AND 1_clients.out='0000-00-00 00:00:00' AND brand LIKE '".$brand."'";
    $result1 = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result1);
    $plan3 = $sql1->cnt;
    
    $vd = cnt2("vd",$alldatemonth,$brand);


    $short='<font color=#FFF>'.($vd+$plan1+$plan2+$plan3).'</font> = '.$vd.' выд. + '.$plan1.' подтв. + '.$plan2.' вер. + '.$plan3.' мал.';
    $long='Выданы = '.$vd.' / Подтвержденные: '.($vd+$plan1).' / Вероятные: '.($vd+$plan1+$plan2).' / Маловероятные: '.($vd+$plan1+$plan2+$plan3);

	$mytext .= '<div class="roundfooter2" id="prognoz" title="'.$long.'" style="float:right;width:315px;font-size:13px;color:lightgray;text-align:center;">'.$short.'</div><img src="img/1vidacha.png" width="15px" title="Планируемые выдачи в этом месяце" align="left" style="float:right;padding-right:2px;padding-top:1px;opacity:0.3">';



	  $mytext .=  '</h5><div class="pane-stat" id="'.$brand.'">';
	  $mytext .=  '<ul class=tabsmini>';
	  $mytext .=  '<li><a id2=dg href=# brand="'.$brand.'" class=current>Договора</a></li>';
	  $mytext .=  '<li><a id2=vd href=# brand="'.$brand.'">Выдачи</a></li>';
	  $mytext .=  '<li><a id2=out2 href=# brand="'.$brand.'" >Расторжения</a></li>';
	  $mytext .=  '<li><a id2=out3 href=# brand="'.$brand.'" >Прич.растор.</a></li>';
	  $mytext .=  '<li><a id2=out href=# brand="'.$brand.'" >OUT</a></li>';
	  $mytext .=  '<li><a id2=zv href=# brand="'.$brand.'" >Звонки</a></li>';
	  $mytext .=  '<li><a id2=vz href=# brand="'.$brand.'" >Визиты</a></li>';
	  $mytext .=  '<li><a id2=tst href=# brand="'.$brand.'" >Ком-предложения</a></li>';
	  $mytext .=  '<span class="radiobyday">';
	  $mytext .=  '<input type="checkbox" name="group1" id="gr" value="model" checked> модели&nbsp;&nbsp;';
	  $mytext .=  '<input type="checkbox" name="group1" id="gr" value="from"> реклама&nbsp;&nbsp;';
	  $mytext .=  '<input type="checkbox" name="group1" id="gr" value="manager"> менеджеры';
	  $mytext .=  '</span>';
	  $mytext .=  '<span class="checkbyday"><input brand="mmm'.$brand.'" class="byday" type="checkbox" checked="checked">помесячно</span><br>';
	  $mytext .=  '</ul>';
	  $mytext .=  '<div class="pane-stat3" id="'.$brand.'"></div>

	  <center>
	  <font color=lightgray align=right>'.$long.'</font></center></div><div style="clear:both"></div>';
	  
	  
	  
	  
	 }
	 $mytext .=  '<br>';

  $fp = fopen('_cup1.txt', "w");
  @fwrite($fp, $mytext);
  fclose($fp);
  echo $mytext;
}
else
{
  	readfile('_cup1.txt');
  	echo $dif_sec;
}  	
	 
//	 echo $mytext;
	 
exit;
}




if (isset($HTTP_GET_VARS['cupAdmin'])) 
 {
  echo ' <h2>Панель Администратора '.gmdate("d-m-Y", strtotime($HTTP_GET_VARS['date'])+24*60*60 ).'<span style="float:right"><a href="#" id="detstat" style="color:#5c5c5c;font-size:14px">детальная статистика</a></span></h2>';
  
  $sqlnews="SELECT count(*) cnt FROM `1_users` WHERE brand = $fpk_brand AND job LIKE '%Менеджер%'";
  $result = mysql_query_my($sqlnews); 
  @$sql = mysql_fetch_object ($result);
  $maxcnt = $sql->cnt;

  $sqlnews="SELECT * FROM `1_users` WHERE brand = $fpk_brand AND job LIKE '%Менеджер%' ORDER by fio DESC";
  
  $result = mysql_query_my($sqlnews); 

    $alldate=gmdate("Y-m-d",cheltime(time()));
    $alldatemonth=gmdate("Y-m",cheltime(time()));

	$alldate=$HTTP_GET_VARS['date'];
	$alldatemonth=substr( $HTTP_GET_VARS['date'], 0, 7 );

  for ($k = 0; $k<= $maxcnt; $k++)
     {
	  @$sql = mysql_fetch_object ($result);
 	  $fio = $sql->fio;
 	  if ($k==$maxcnt) $fio = '%';
 	  
 	  $sqlnews3="SELECT count(*) cnt FROM `1_doadmin` WHERE brand = $fpk_brand AND manager LIKE '$fio' AND type='zv' AND date1 LIKE '".$alldate."%'  AND brand = '".$fpk_brand."'";
	  $result3 = mysql_query_my($sqlnews3); 
	  @$sql3 = mysql_fetch_object ($result3);
	  $zv = $sql3->cnt;
	  if ($zv==0) $zv='&nbsp';

 	  $sqlnews3="SELECT count(*) cnt FROM `1_clients` WHERE brand = $fpk_brand AND manager LIKE '$fio' AND zv LIKE '".$alldate."%' AND brand = '".$fpk_brand."'";
	  $result3 = mysql_query_my($sqlnews3); 
	  @$sql3 = mysql_fetch_object ($result3);
	  $zv2 = $sql3->cnt;
	  if ($zv>$zv2) $zv=''.$zv.' <font color=#ffa5c0>></font>';
	  if ($zv==$zv2) $zv=''.$zv.' <font color=lightgreen>=</font>';
	  if (($zv<$zv2) &&($zv2!=0)) $zv=''.$zv.' <font color=lightgreen><</font>';
	  if ($zv2==0) $zv2='&nbsp';



 	  $sqlnews3="SELECT count(*) cnt FROM `1_doadmin` WHERE brand = $fpk_brand AND manager LIKE '$fio' AND type='vz' AND date1 LIKE '".$alldate."%'  AND brand = '".$fpk_brand."'";
	  $result3 = mysql_query_my($sqlnews3); 
	  @$sql3 = mysql_fetch_object ($result3);
	  $vz = $sql3->cnt;
	  if ($vz==0) $vz='&nbsp';

 	  $sqlnews3="SELECT count(*) cnt FROM `1_clients` WHERE brand = $fpk_brand AND manager LIKE '$fio' AND vz LIKE '".$alldate."%' AND brand = '".$fpk_brand."'";
	  $result3 = mysql_query_my($sqlnews3); 
	  @$sql3 = mysql_fetch_object ($result3);
	  $vz2 = $sql3->cnt;
	  if ($vz>$vz2) $vz=''.$vz.' <font color=#ffa5c0>></font>';
	  if ($vz==$vz2) $vz=''.$vz.' <font color=lightgreen>=</font>';
	  if (($vz<$vz2) &&($vz2!=0)) $vz=''.$vz.' <font color=lightgreen><</font>';
	  if ($vz2==0) $vz2='&nbsp';
	  

 	  $sqlnews3="SELECT count(*) cnt FROM `1_doadmin` WHERE manager LIKE '$fio' AND type='tst' AND date1 LIKE '".$alldate."%' AND brand = '".$fpk_brand."'";
	  $result3 = mysql_query_my($sqlnews3); 
	  @$sql3 = mysql_fetch_object ($result3);
	  $tst = $sql3->cnt;
	  if ($tst==0) $tst='&nbsp';

 	  $sqlnews3="SELECT count(*) cnt FROM `1_clients` WHERE brand = $fpk_brand AND manager LIKE '$fio' AND tst LIKE '".$alldate."%'";
	  $result3 = mysql_query_my($sqlnews3); 
	  @$sql3 = mysql_fetch_object ($result3);
	  $tst2 = $sql3->cnt;
	  if ($tst>$tst2) $tst=''.$tst.' <font color=#ffa5c0>></font>';
	  if ($tst==$tst2) $tst=''.$tst.' <font color=lightgreen>=</font>';
	  if (($tst<$tst2) &&($tst2!=0)) $tst=''.$tst.' <font color=lightgreen><</font>';
	  if ($tst2==0) $tst2='&nbsp';
	   	  

 	  $sqlnews3="SELECT * FROM `1_doadmin` WHERE brand = $fpk_brand AND manager LIKE '$fio' AND date1 LIKE '".$alldate."%' ORDER by date1";
	  $result3 = mysql_query_my($sqlnews3); 
	  $long='';
	  while(@$sql3 = mysql_fetch_object ($result3))
	    {
	    $long=$long.'<font color=gray>'.$sql3->manager.'</font> - '.$sql3->type.' - '.$sql3->date1.' <a id="deltype" id2="'.$sql3->id.'" href="#">- удалить</a><br>';
	    };


 	  if ($k==$maxcnt) { $brandlogo = 'logo-seyho.png'; $op=' style="opacity:0.75" '; }
 	  else { $brandlogo = $sql->logo; $op = ''; }


	  echo '<h5 '.$op.' class="notloaded" id2="'.$fio.'" id="'.$fio.'" brandtitle="'.$sql->job.'">'.$sql->fio.'&nbsp;';
    echo '
      <img src="img/1zvonok.png" width="15px" align="left" style="padding-right:2px;padding-top:2px;opacity:0.7">
      <div class="roundfooter2" id="zv" title="Звонки">'.$zv.'  '.$zv2.'</div>
      <img src="img/1vizit.png" width="18px" align="left" style="padding-right:2px;padding-top:2px;opacity:0.7">
      <div class="roundfooter2" id="vz" title="Визиты">'.$vz.'  '.$vz2.'</div>
      <img src="img/1test-drive.png" width="15px" align="left" style="padding-right:2px;padding-top:2px;opacity:0.7">
      <div class="roundfooter2" id="tst" title="Ком-предложения" style="margin-right:20px">'.$tst.'  '.$tst2.'</div>
      ';
	  

	  echo '</h5><div class="pane-stat" id="'.$brand.'" style=""><center>'.$long.'</center></div>';
	  
	  
	  
	  
	 }
	 echo '<br>';
exit;
}

//добавление клиента Администратором
if (isset($HTTP_GET_VARS['AddAdmin'])) 
 {
 $manager = $HTTP_GET_VARS['manager'];
 $type = $HTTP_GET_VARS['AddAdmin'];
 $mydate = $HTTP_GET_VARS['mydate'].' 13:13:13';
 
	$sqlnews="
INSERT INTO `1_doadmin` (`id`, `manager`, `type`, `date1`, `commercial`,`brand`) VALUES (NULL, '$manager', '$type', '$mydate', '',".$fpk_brand."); ";

   $result = mysql_query_my($sqlnews); 
 
 
 exit;
 }

if (isset($HTTP_GET_VARS['DeleteAdmin'])) 
 {
 $id = $HTTP_GET_VARS['DeleteAdmin'];
 
	$sqlnews="DELETE FROM `1_doadmin` WHERE id=".$id." LIMIT 1";

   $result = mysql_query_my($sqlnews); 
 
 
 exit;
 }


if (isset($HTTP_GET_VARS['ShowManager'])) 
 {
echo "<li><a href='#nogo4'>Все</a></li>";
echo "<li><b>Менеджеры</b></li>";
echo mod_ShowUserlist(" job LIKE '%неджер%'"); 
exit;
 }
 
if (isset($HTTP_GET_VARS['CheckPhone'])) 
 {
 $phone=trim(( $HTTP_GET_VARS['CheckPhone'] ));

    $sqlnews="SELECT COUNT( * ) cnt
FROM  `1_clients` 
WHERE  (`1_clients`.`phone1` LIKE  '$phone%'
OR  `1_clients`.`phone2` LIKE  '$phone%'
OR  `1_clients`.`phone3` LIKE  '$phone%'
OR  `1_clients`.`phone4` LIKE  '$phone%') AND brand='".$fpk_brand."' AND 1_clients.id!=".$HTTP_GET_VARS['client'];
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);
    echo $sql1->cnt;
    exit;
 }


if (isset($HTTP_GET_VARS['Amount'])) 
 {
 $manager=( $HTTP_GET_VARS['Manager'] );
 if ($manager=='Все') $manager='%';

    $sqlnews='SELECT count(*) cnt FROM `1_clients` cl WHERE dg != "0000-00-00 00:00:00" and brand="peugeot" and vd = "0000-00-00 00:00:00" AND manager LIKE "%'.$manager.'%" and cl.out = "0000-00-00 00:00:00"';
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);
    $dg = $sql1->cnt;

    $sqlnews='SELECT count(*) cnt FROM `1_clients` cl WHERE vd != "0000-00-00 00:00:00" and brand="peugeot" AND manager LIKE "%'.$manager.'%" and cl.out = "0000-00-00 00:00:00"';
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);
    $vd = $sql1->cnt;
    
 echo "{\"amount\":[0,0,$dg,$vd,0,0,0,0]}";
 exit;
 }

if (isset($HTTP_GET_VARS['AmountDo'])) 
 {
 $manager=( $HTTP_GET_VARS['Manager'] );
 $date2=$HTTP_GET_VARS['date2'];

 if ($manager=='Все') $manager='%';

    $sqlnews="SELECT count(*) cnt FROM  `1_do` 
	      JOIN 1_clients ON 1_clients.id = 1_do.client 
		  WHERE FALSE OR date2 LIKE '$date2%'  AND 1_clients.brand = '".$fpk_brand."' AND 1_clients.manager LIKE '$manager%' AND 1_do.checked = '0000-00-00 00:00:00'";
	$date2=gmdate("Y-m-d H:i:s",cheltime(time()));	  
	//Просроченные дела
	if($HTTP_GET_VARS['AmountDo']==2)	  
	    $sqlnews="SELECT count(*) cnt FROM  `1_do` 
	      JOIN 1_clients ON 1_clients.id = 1_do.client 
		  WHERE FALSE OR date2 < '$date2' AND date2 NOT LIKE '%00:00:00' AND 1_clients.brand = '".$fpk_brand."' AND 1_clients.manager LIKE '$manager%' AND 1_do.checked = '0000-00-00 00:00:00'";
		  
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);
    
 echo $sql1->cnt;
 exit;
 }
		  
		  
		  

if (isset($HTTP_GET_VARS['Timeline'])) 
 {
 $manager=( $HTTP_GET_VARS['Manager'] );
 if ($manager=='Все') $manager='%';
$json_data = array (
        'wiki-url'=>'http://simile.mit.edu/shelf',
        'wiki-section'=>'Simile Cubism Timeline',
        'dateTimeFormat'=>'Gregorian',
        'events'=> array (
               array(
                       'start'=>'May 28 2006 09:00:00 GMT',
                       'end'=>'Jun 15 2006 09:00:00 GMT'
               ),
               array(
                       'start'=>'Jun 16 2006 00:00:00 GMT',
                       'end'=>'Jun 26 2006 00:00:00 GMT'
               ),
               array(
                       'start'=>'Aug 02 2006 00:00:00 GMT',
                       'title'=>'Trip to Beijing'
               )
       )
);
 
 $sqlnews1="SELECT * FROM `1_clients` WHERE brand = '$fpk_brand' AND manager LIKE '%$manager%' AND NOT dg='0000-00-00 00:00:00' AND 1_clients.out = '0000-00-00 00:00:00' ";
 $result1 = mysql_query_my($sqlnews1); 
	
$i=0;	
 while (@$sql = mysql_fetch_object ($result1))
  {
$color='darkgreen';
$json_data['events'][$i]['title']=( $sql->fio);
if ($sql->dg!='0000-00-00 00:00:00') $json_data['events'][$i]['start']=$sql->dg;
//$json_data['events'][$i]['isDuration']='true';
if ($sql->vd!='0000-00-00 00:00:00') $json_data['events'][$i]['end']=$sql->vd;
else $json_data['events'][$i]['end']=gmdate("Y-m-d H:i:s",cheltime(time()+12*60*60));
if ($sql->vd=='0000-00-00 00:00:00') $color='gray';
$json_data['events'][$i]['color']=$color;
$json_data['events'][$i]['description']=$sql->id;
$i++;
  }


$json_encoded=json_encode($json_data);
echo $json_encoded;

exit;
}





function message_dogovor($sql1)
{
global $fpk_id,$fpk_brand;
		
		if (strstr($sql1->creditmanager,'Кредит')) $credit=" в Кредит";
		if (strstr($sql1->creditmanager,'Безнал')) $credit=" (безнал)";
		if (strstr($sql1->creditmanager,'Нал')) $credit=" (наличные)";
		if (strstr($sql1->creditmanager,'Лизинг')) $credit=" в Лизинг";
		
		if($sql1->status!='') $status = '('.$sql1->status.')';
		else $status="";
		if($sql1->commercial!='') $commercial = '<br>Источник: '.$sql1->commercial.'.';
		$manager = mod_showmanager($sql1);
		if ($sql1->cost>0) $cost =' за '.$sql1->cost.'рублей';
		else $cost="";
		
	    $sqlnews="SELECT model cnt FROM 1_models WHERE id=".$sql1->model;
		$result = mysql_query_my($sqlnews); @$sql2 = mysql_fetch_object ($result);
		$modelname = $sql2->cnt; //длинное название модели

	    $sqlnews="SELECT title cnt, logo FROM 1_brands WHERE id=".$sql1->brand;
		$result = mysql_query_my($sqlnews); @$sql2 = mysql_fetch_object ($result);
		$brandname = str_replace('Челябинск','',$sql2->cnt); //длинное название модели
		$brandname = str_replace(' - ',' ',$brandname); //длинное название модели
		$logo=$sql2->logo;
		
		$fio=mod_fioshort2($sql1);


	    $sqlnews22="SELECT message_on,id FROM 1_users WHERE message_on='true' AND brand=".$fpk_brand;
		$result22 = mysql_query_my($sqlnews22);

 while (@$sql22 = mysql_fetch_object ($result22))
	{
		
    	$sqlnews3 = "INSERT INTO `chat` (`id`, `user`, `msg`, `touser`, `messagedate`, `readed`) VALUES (NULL, '-2', '<img valign=center src=img/$logo>&nbsp;<b>".$brandname."</b><hr> Договор на <b>".$modelname."</b> ".$status.$cost.'<b>'.$credit."</b>.<br>Клиент: <a href=# client_id=".$sql1->id."><b>".$fio."</b></a>.".$commercial."<br>Менеджер: ".$manager."', '".$sql22->id."', NOW(), '');";
    	echo "-----------".$sqlnews3."\n\r";
	    $result3 = mysql_query_my($sqlnews3); 


	}

    	$sqlnews3 = "INSERT INTO `chat` (`id`, `user`, `msg`, `touser`, `messagedate`, `readed`) VALUES (NULL, '-2', '<img valign=center src=img/$logo>&nbsp;<b>".$brandname."</b><hr>!Договор на <b>".$modelname."</b> ".$status.$cost.'<b>'.$credit."</b>.<br>Клиент: <a href=# client_id=".$sql1->id."><b>".$fio."</b></a>.".$commercial."<br>Менеджер: ".$manager."', '11', NOW(), '');";
	    $result3 = mysql_query_my($sqlnews3); 

}






//Проставляем даты звонков, визитов, тестдрайвов и т.д...
if (isset($HTTP_GET_VARS['UpdateIcons'])) 
 {

		//Удаляю все сообщения кроме сегодняшних
		$yesterday = date('Y-m-d',strtotime('-0 day'));
	    $sqlnews="DELETE FROM chat WHERE user=-2 AND messagedate NOT LIKE '$yesterday%'";
		$result = mysql_query_my($sqlnews);


	$sqlnews1="SELECT * FROM `1_clients` WHERE id  LIKE '".$HTTP_GET_VARS['UpdateIcons']."'";
    $result1 = mysql_query_my($sqlnews1); 
	
	echo $sqlnews1.'<hr>';
	
 while (@$sql1 = mysql_fetch_object ($result1))
  {
	$sqlnews="SELECT type,date2,text,checked FROM `1_do` WHERE client = '".$sql1->id."' ORDER BY date2";
	echo $sqlnews.'<hr>';
    $result = mysql_query_my($sqlnews); 
  echo $sql1->fio.'<br>';
  
  
  $zv=$vz=$dg=$tst=$vd=$out=false;	
  $outtext='';
  $i=0;
  while (@$sql = mysql_fetch_object ($result))
	     {
		 $t = $sql->type;
		 echo '<br>'.$sql->date2.' - '.$sql->type;
	if ($sql->checked!="0000-00-00 00:00:00")
	  {
		 if (($i==0) AND in_array($t, array("Звонок") ) AND (!$zv)) { echo "<b> <- Звонок: ".$sql->date2."</b>"; $zv=$sql->date2; } 

		 if ( in_array($t, array("Визит", "Договор", "Кредит") ) AND (!$vz)) { echo "<b> <- Визит: ".$sql->date2."</b>"; $vz=$sql->date2; }

		 if ( in_array($t, array("Договор") ) ) { echo "<b> <- Договор: ".$sql->date2."</b>"; $dg.=$sql->date2.";"; }

		 if ( in_array($t, array("Ком-предложение") ) AND (!$tst)) { echo "<b> <- Ком-предложение: ".$sql->date2."</b>"; $tst=$sql->date2; }

		 if ( in_array($t, array("Выдача") ) ) { echo "<b> <- Выдача: ".$sql->date2."</b>"; $vd.=$sql->date2.";"; }

		 if ( in_array($t, array("OUT") ) ) { echo "<b> <- OUT: ".$sql->date2."</b>"; $out=$sql->date2; $outtext=$sql->text; }
      }

		 $i++;
		 }
		 
   if (($sql1->dg == '0000-00-00 00:00:00') AND ($dg!=false)) 
  		{
  		//новый договор
  		echo "\n\rУРА ДОГОВОР!dg=".$dg."\n\rsql=".$sql1->dg;
  		message_dogovor($sql1);
  		}

   if (($sql1->dg != '0000-00-00 00:00:00') AND ($dg==false)) 
        {
        //договора нет
        echo "\n\rСООБЩАТЬ НЕЧЕГО!dg=".$dg."\n\rsql=".$sql1->dg;
  		//message_dogovor();
        }

		 
   //echo "<font color=red><br>Звонок: $zv <br> Визит: $vz <br> Тест: $tst <br> Договор: $dg <br> Выдача: $vd <br> OUT:$out</font>".'<hr>';
   
   if($dg=="") $dg = "0000-00-00 00:00:00";
   if($vd=="") $vd = "0000-00-00 00:00:00";
   
   	$sqlnews2="UPDATE `1_clients` SET 
	          `zv` = '$zv', 
			  `vz` = '$vz', 
			  `tst` = '$tst', 
			  `dg` = '$dg', 
			  `vd` = '$vd', 
			  `adress` = '$outtext',
			  `out` = '$out' 
			  WHERE `1_clients`.`id` = ".$sql1->id." LIMIT 1;";
    $result2 = mysql_query_my($sqlnews2); 
    
   echo "<hr>".$sqlnews2;
   exit;
  }	



if ($fpk_brand==1)
  {
  
    	$sqlnews3 = "UPDATE 1_cars SET clients = '', dogovor = 0 ";
	    $result3 = mysql_query_my($sqlnews3); 

  $sqlnews="SELECT * from 1_cars WHERE i8 != ''";

  $result = mysql_query_my($sqlnews); 

  while (@$sql = mysql_fetch_array($result))
    {
    echo '<hr>'.$sql['i8'].' = ';

    $sqlnews2="SELECT * from 1_clients WHERE vin = '".$sql['i8']."'";
    $result2 = mysql_query_my($sqlnews2); 
	while (@$sql2 = mysql_fetch_array($result2))
    	{
    	if (($sql2['dg']=='0000-00-00 00:00:00') or ($sql2['out']!='0000-00-00 00:00:00'))
      		{
      		$dogovor=0.3;
      		}
      	else 
      	    {
		    $dogovor=1;      	  
      	    }
    	if ($sql2['out']=='0000-00-00 00:00:00')
    	  {
    	   $sqlnews3 = "UPDATE 1_cars SET clients = CONCAT(clients,'".$sql2['id'].",'), dogovor = $dogovor WHERE id = '".$sql['id']."'";
	       $result3 = mysql_query_my($sqlnews3); 
	      }
		}
    }


  
  
  }



	exit;
 }












if (isset($HTTP_GET_VARS['setonline'])) 
 {

$sqlnews2="
	UPDATE  `1_users` SET  
	`status` =  '$setonline'
	WHERE  `id` ='".$fpk_id."' LIMIT 1";
    if ($fpk_id!=0) $result2 = mysql_query_my($sqlnews2); 
exit;
 }

if (isset($HTTP_GET_VARS['readed'])) 
 {
	mysql_query_my("UPDATE chat SET readed = NOW() WHERE id = '".$HTTP_GET_VARS['readed']."'");
	exit;
 }

if (isset($HTTP_GET_VARS['online'])) 
 {
    echo "<li><a href='login.php'>Выход</a></li>
    	  <li><div id='online' iduser='-2' title='0 минут назад'></div><div id='username' iduser='-2' style='username' idbrand='day.png'>Уведомления ФПК</div></li>
			<li><b>Пользователи чата:</b></li>";

  $sqlnews4="SELECT * FROM `1_brands` ORDER by brandname DESC";
  $result4 = mysql_query_my($sqlnews4); 
  while (@$sql4 = mysql_fetch_object ($result4))
    {
    if($sql4->id == $fpk_brand ) { $b1='<b>'; $b2='</b>'; }
    else { $b1=''; $b2=''; }
    echo "<li><a href='' class='fly'>$b1<img src='img/".$sql4->logo."' height='14'>&nbsp;".$sql4->title."$b2</a> <ul>";
    
	$sqlnews="SELECT id, fio, lastvizit,job FROM `1_users` WHERE brand = '".$sql4->id."' AND job != 'Уволен' ORDER BY lastvizit DESC";
    $result = mysql_query_my($sqlnews); 
	
	  while (@$sql = mysql_fetch_object ($result))
		    {
			$fio=$sql->fio;
		    $explodeName = explode(" ", $fio);
		    $fio = $explodeName[0].' '.mb_substr($explodeName[1],0,1,'utf-8').'.'.mb_substr($explodeName[2],0,1,'utf-8').'.';
		    
			$minutes=-(int)( ((gmstrtotime($sql->lastvizit))-cheltime(gmmktime()) )/60*10)/10; 
			$add='минут';
			if($minutes<2) $status='online';
			if(($minutes>=2) and ($minutes<=20)) $status='away';
			if($minutes>20) $status='offline';
			
			if ($minutes>60) { $minutes=(int)($minutes/60); $add='часов'; }

			if ($minutes>24) { $minutes=(int)($minutes/24); $add='дней'; }
			
	         
	        $iduser=$sql->id;
			if ($sql->id <>$fpk_id) echo "<li  hint='".$sql->job." (был $minutes $add назад)'><div id='$status' iduser='$iduser' title='$minutes $add назад'></div><div id='username' iduser='$iduser' idbrand='".$sql4->logo."' style='username'>$fio</div></li>";
			}
    echo "</ul></li>";
	}
		
	exit;
 }

if (isset($HTTP_GET_VARS['email'])) 
 {
 
 $email = ( $HTTP_GET_VARS['email']);
 $pass = ( $HTTP_GET_VARS['pass']);
 $job = ( $HTTP_GET_VARS['job']);
 $fio = ( $HTTP_GET_VARS['fio']);
 $birthday = $HTTP_GET_VARS['birthday'];
 $brand = ( $HTTP_GET_VARS['brand']);
 
	$sqlnews="
INSERT INTO `1_users` (`id`, `email`, `md5password`, `job`, `fio`, `lastvizit`, `status`, `birthday`, `brand`) VALUES (NULL, '$email', '$pass', '$job', '$fio', '".gmdate("Y-m-d H:i:s",cheltime(time()))."', 'online', '$birthday', '$brand') ";

   $result = mysql_query_my($sqlnews); 
 
 exit;
 }


if (isset($HTTP_GET_VARS['makefio'])) 
 {
 
	$sqlnews="SELECT id, fio FROM `1_clients`";
    $result = mysql_query_my($sqlnews); 
	
  while (@$sql = mysql_fetch_object ($result))
	     {
		$sqlnews2="
			UPDATE  `1_clients` SET  
			`fio` =  '".fio($sql->fio)."'
			WHERE  `id` ='".$sql->id."' LIMIT 1";
			
	    $result2 = mysql_query_my($sqlnews2); 
		echo $sqlnews2.'<hr>';
		 
		 
		 }
 exit;
 }


function ucfirst_utf8($str) {
    if (mb_check_encoding($str,'UTF-8')) {
        $first = mb_substr(
            mb_strtoupper($str, "utf-8"),0,1,'utf-8'
        );
        return $first.mb_substr(
            mb_strtolower($str,"utf-8"),1,mb_strlen($str),'utf-8'
        );
    } else {
        return $str;
    }
}

//echo fio('ООО ПСП Вектор-Плюс');

function fio($fio)
{




    $explodeName = explode(" ", trim($fio));

      
  if(($fio!=strtoupper($fio)) or count($explodeName)!=3)
  return $fio;
  
    for ($i=0; $i<count($explodeName); $i++) {
    	
    	if ($explodeName[$i]=='ООО') return $fio;
    	if ($explodeName[$i]=='АО') return $fio;
    
	    if ($i==0) {    $name = ucfirst_utf8($explodeName[$i]); 
						}

		
        if ($i==1) { if ($explodeName[$i]!='ООО') $name2= ucfirst_utf8($explodeName[$i]);
						else $name2=$explodeName[$i];
					 $name.=' '.$name2;}
		
        if ($i==2) { if ($explodeName[$i]!='ООО') $name2= ucfirst_utf8($explodeName[$i]);
						else $name2=$explodeName[$i];
					 $name.=' '.$name2;}
					 
		if ($i==3) $name.=' '.$explodeName[$i];
		if ($i==4) $name.=' '.$explodeName[$i];
		if ($i==5) $name.=' '.$explodeName[$i];
		if ($i==6) $name.=' '.$explodeName[$i];
	   }


return $name;
}

function utf8_strtolower($string) { 
return mb_convert_case($string, MB_CASE_LOWER, "UTF-8"); 
    }

function utf8_strtoupper($string) { 
return mb_convert_case($string, MB_CASE_UPPER, "UTF-8"); 
    }


//Информация для панели новостей
if (isset($HTTP_GET_VARS['news'])) 
 {
    $alldate=gmdate("Y-m-d",cheltime(time()));
    $alldatemonth=gmdate("Y-m",cheltime(time()));

	$alldate=$HTTP_GET_VARS['date'];
	$alldatemonth=mb_substr( $HTTP_GET_VARS['date'], 0, 7,'utf-8' );
	$startTime=microtime();
    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=5 AND vd='0000-00-00 00:00:00' AND brand='".$fpk_brand."'";
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);
    $plan1 = $sql1->cnt;

    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=4 AND vd='0000-00-00 00:00:00' AND brand='".$fpk_brand."'";
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);
    $plan2 = $sql1->cnt;
    
    $sqlnews="SELECT count(*) cnt FROM `1_clients` WHERE icon2=3 AND vd='0000-00-00 00:00:00' AND brand='".$fpk_brand."'";
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);
    $plan3 = $sql1->cnt;
    
    $vd = cnt("vd",$alldatemonth);

    $js['amount'][0]=cnt("dg",$alldate);
    $js['amount'][1]="".cnt("dg",$alldate)." (".cnt("dg",$alldatemonth).")";
    $js['amount'][2]=cnt("vd",$alldate)." (".$vd.")";
    $js['amount'][3]=cnt("zv",$alldate)." (".cnt("zv",$alldatemonth).")";
    $js['amount'][4]=cnt("vz",$alldate)." (".cnt("vz",$alldatemonth).")";
    $js['amount'][5]=cnt("tst",$alldate)." (".cnt("tst",$alldatemonth).")";

    $js['amount'][6]=$plan1.'+'.$plan2.'+'.$plan3;

    $js['amount'][7]='Выданы = '.$vd.' / Подтвержденные: '.($vd+$plan1).' / Вероятные: '.($vd+$plan1+$plan2).' / Маловероятные: '.($vd+$plan1+$plan2+$plan3);

 	$js['amount'][8]=cnt2("out2",$alldate,$brand)." (".cnt2("out2",$alldatemonth,$brand).')';

//    mail("eugene.leonar@gmail.com", "My Subject", $js['amount'][7]); 
    
if($HTTP_GET_VARS['news']==888) echo json_encode($js); 	

exit;

 echo $fpk_brand." ".$HTTP_GET_VARS['date'].": договор ".cnt("dg",$alldate)."(".cnt("dg",$alldatemonth)."), выдачи ".cnt("vd",$alldate)."(".cnt("vd",$alldatemonth)."),
 первичные звонки ".cnt("zv",$alldate)."(".cnt("zv",$alldatemonth)."), первичные визиты ".cnt("vz",$alldate)."(".cnt("vz",$alldatemonth)."), ком-предложения ".cnt("tst",$alldate)."(".cnt("tst",$alldatemonth)."), план выдач ".(cnt("vd",$alldatemonth)+$planvidach)."(".cnt("vd",$alldatemonth)." уже выдано + $planvidach запланированно).";
 exit;
 }

function cnt2 ($type, $date, $brand)
{
global $fpk_brand,$HTTP_GET_VARS;
$typename="";
$typename["zv"]="Звонок";
$typename["vz"]="Визит";
$typename["tst"]="Ком-предложение";
$typename["OUT"]="OUT";
$typename["dg"]="Договор";
$typename["vd"]="Выдача";

if (strlen($date)==7 ) $dateto=$HTTP_GET_VARS['date'].' 23:59:59';
else $dateto='2200-01-01';


if (!$brand) $brand=$fpk_brand;

	if ($brand=='%') $mybr='';
	else $mybr="AND cl.brand = '$brand'";
	
//    $sqlnews="SELECT count(*) cnt FROM `1_clients` cl WHERE $mybr AND $type LIKE '%$date%' AND $type <= '$dateto' ";
    $sqlnews="SELECT count(*) cnt FROM `1_do` cl WHERE type = '".$typename[$type]."' $mybr AND date2 LIKE '%$date%' AND date2 <= '$dateto' ";
    
    if ($type=='out2')
	    $sqlnews="SELECT count(*) cnt FROM `1_clients` cl WHERE (brand!=10 AND brand!=11) $mybr AND cl.out LIKE '$date%' AND cl.dg != '0000-00-00 00:00:00' AND cl.out <= '$dateto'";
    
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);

return $sql1->cnt;;
}

function cnt ($type, $date)
{
global $fpk_brand;
if (!$brand) $brand=$fpk_brand;

    $sqlnews="SELECT  count(*) cnt FROM `1_clients` cl WHERE cl.brand LIKE '$brand' AND $type LIKE '$date%'";
    $result = mysql_query_my($sqlnews); @$sql1 = mysql_fetch_object ($result);

return $sql1->cnt;;
}

//Вывод клиентов
if (isset($HTTP_GET_VARS['ClientEmpty'])) 
 {
// print_r($HTTP_GET_VARS);
 // $('.accordion2').load("do.php?ClientEmpty=24&Manager="+manager+"&Model="+model+"&Filter="+filter+"&Radio="+radio
 $manager=$HTTP_GET_VARS['Manager'];
 $model=$HTTP_GET_VARS['Model'];
 $filter=$HTTP_GET_VARS['Filter'];
 $id=$HTTP_GET_VARS['id'];
 $brand=$HTTP_GET_VARS['Brand'];

 if ($brand) $fpk_brand = $brand;

 if ( ($manager=='Все') or (stristr($filter,'+')) ) $manager="%";
 $filter=str_replace("+","",$filter);
 
 
 
 $radio=( $HTTP_GET_VARS['Radio'] );
 $radarrange=( $HTTP_GET_VARS['radarrange'] );
 $alldate=( $HTTP_GET_VARS['ALLDate'] );
 $json=$HTTP_GET_VARS['json'];
 
  if ($id<>"") 
     {
	
	 $sqlnews="SELECT * FROM 1_clients cl WHERE cl.brand = '$fpk_brand' AND cl.id IN ($id 0) ORDER by manager";
 // $fp = fopen('its2.txt', "w");
 //  @fwrite($fp, 'rrr='.$sqlnews);
 // fclose($fp);

	 if (($HTTP_GET_VARS['json'])==8)
	 	 $news=displayNewsAll("fpk-clients-json0.php",$sqlnews);
	 	else
	 	 $news=displayNewsAll("fpk-clients-json.php",$sqlnews);
     $news = str_replace('},]','}]','['.$news.']');
	 
	 
	 
	 echo $news;
	 exit;
	 }

 
  if ($filter<>"") 
     {
    $fields = array ('1_clients.fio', '1_clients.manager', '1_clients.phone1', '1_clients.phone2', '1_clients.phone3', 
	'1_clients.phone4','1_clients.comment','1_clients.date','1_clients.adress','1_do.text', '1_do.comment', '1_clients.vin', '1_clients.status');
	$in1="FALSE ";
	if ($manager!="%") $in2="AND cl.out='0000-00-00 00:00:00' ";
	
	for($j=0; $j<count($fields); $j++)
	   {
			$explodeFilter = explode(",", $filter);
			for ($i=0; $i<count($explodeFilter); $i++) 
			     {
				 if (strlen(trim($explodeFilter[$i]))>2) $in1 .= " OR ".$fields[$j]." LIKE '%".trim($explodeFilter[$i])."%'";
				 }
	   }

	 $sqlnews="SELECT * FROM 1_clients cl WHERE cl.brand = '$fpk_brand' AND cl.id IN (SELECT DISTINCT(1_clients.id) FROM 1_clients LEFT JOIN 1_do ON 1_do.client=1_clients.id WHERE $in1) AND cl.manager LIKE '$manager' ".$in2;
 // $fp = fopen('its2.txt', "w");
 //  @fwrite($fp, 'rrr='.$sqlnews);
 // fclose($fp);

	 if (($HTTP_GET_VARS['json'])==8)
	 	 $news=displayNewsAll("fpk-clients-json0.php",$sqlnews);
	 	else
	 	 $news=displayNewsAll("fpk-clients-json.php",$sqlnews);
     $news = str_replace('},]','}]','['.$news.']');
	 
	 
	 
	 echo $news;
	 exit;
	 }

$out = "SELECT distinct(1_clients.id) FROM `1_clients` RIGHT JOIN 1_do ON 1_do.client=1_clients.id WHERE  1_clients.brand = '$fpk_brand' AND 1_clients.manager LIKE '%' AND type IN ('OUT')";

$vidan= "SELECT distinct(1_clients.id) FROM `1_clients` RIGHT JOIN 1_do ON 1_do.client=1_clients.id WHERE  1_clients.brand = '$fpk_brand' AND 1_clients.manager LIKE '%' AND type IN ('Выдача') AND checked <> '0000-00-00 00:00'";

$dogovors = "SELECT distinct(1_clients.id) FROM `1_clients` RIGHT JOIN 1_do ON 1_do.client=1_clients.id WHERE  1_clients.brand = '$fpk_brand' AND 1_clients.manager LIKE '%' AND type IN ('Договор')";

 $inorder='ORDER by cl.manager';
 
 if ($radio=='dogovors') $in="AND type IN ('Договор') AND 1_clients.id NOT IN ($out) AND 1_clients.id NOT IN ($vidan)";
 if ($radio=='credits') { $in="AND type IN ('Кредит') AND 1_clients.id NOT IN ($out) AND 1_clients.id NOT IN ($vidan)"; $manager="%";}
 if ($radio=='credits') $inorder=" ORDER BY creditmanager";
 if ($radio=='do') $in="AND type = 'Do'";
 if ($radio=='out') $in="AND type IN ('OUT')";
 if ($radio=='vidan') $in="AND type = 'Выдача' AND checked <> '0000-00-00 00:00'";
 if ($manager=='Все') $manager='%'; 

 if ($radio=='actual') { $in="AND 1_clients.id NOT IN ($dogovors) AND 1_clients.id NOT IN ($vidan) AND 1_clients.id NOT IN ($out)"; $left='LEFT'; $inorder='ORDER by cl.manager'; }
 //$sqlnews="SELECT 1_clients.id FROM `1_clients` WHERE 1_clients.manager LIKE '$manager' $in";

/////////////////////////////////////////////////////////////////
 $sqlnews="SELECT * FROM 1_clients cl WHERE cl.id IN (SELECT distinct(1_clients.id) FROM `1_clients` $left JOIN 1_do ON 1_do.client=1_clients.id WHERE  1_clients.brand = '$fpk_brand' AND 1_clients.manager LIKE '$manager' $in) $inorder";
 
 if ($json==2)  
    {
    $sqlnews="SELECT count(*) cnt FROM 1_clients cl WHERE cl.id IN (SELECT distinct(1_clients.id) FROM `1_clients` $left JOIN 1_do ON 1_do.client=1_clients.id WHERE  1_clients.brand = '$fpk_brand' AND 1_clients.manager LIKE '$manager' $in) $inorder";
    $result = mysql_query_my($sqlnews); 
    @$sql1 = mysql_fetch_object ($result);
    echo $sql1->cnt;
    exit;
    }




 if ($radio=='radar') 
    { 
    exit;
	}
	
 if ($radio=='statistic2') 
    { 
	 $sqlnews="SELECT *, 1_clients.".$HTTP_GET_VARS['type']." typetime FROM 1_clients WHERE  1_clients.brand = '$fpk_brand' AND 1_clients.manager LIKE '$manager'  AND 1_clients.".$HTTP_GET_VARS['type']." LIKE '$alldate%' ORDER by 1_clients.".$HTTP_GET_VARS['type'];

	 if ($HTTP_GET_VARS['type']=='prognoz') $sqlnews="SELECT * FROM 1_clients WHERE  1_clients.brand = '$fpk_brand' AND 1_clients.icon2 > 1 AND vd='0000-00-00 00:00:00'  AND 1_clients.out='0000-00-00 00:00:00' ORDER by manager,icon2 DESC";


	 //echo $sqlnews;
     $news=displayNewsAll("fpk-clients-json.php",$sqlnews);
     $news = str_replace('},]','}]','['.$news.']');

    echo $news; 
	exit;
	}

 if (isset($HTTP_GET_VARS['json'])) {
               $news=displayNewsAll("fpk-clients-json.php",$sqlnews);
	            $news = str_replace('},]','}]','['.$news.']');


//$news = addslashes( $news,"\n");
			   }
 else $news=displayNewsAll("fpk-clients.php",$sqlnews);
 
echo $news;

exit;
 }



if (isset($HTTP_GET_VARS['Update']))
 {
 $Update=$HTTP_GET_VARS['Update'];

 $slave = $HTTP_GET_VARS['slave'];
 
 if (!$slave) $slave = $fpk_user;

	$sqlnews="
UPDATE  `1_do` SET  
`text` =  '".e($HTTP_GET_VARS['TEXT'])."',
`comment` =  '".e($HTTP_GET_VARS['DOCOMMENT'])."',
`date2` =  '".e($HTTP_GET_VARS['AltEntry'])."',
`type` =  '".e($HTTP_GET_VARS['DOTYPE'])."',
`manager` =  '".e($slave)."',
`changed` =  '".gmdate("Y-m-d H:i:s",cheltime(time()))."'
WHERE  `id` ='".$Update."' LIMIT 1";
  $sqlnews=stripcslashes( $sqlnews);
  $result = mysql_query_my($sqlnews); 
  
 jsLog("Отредактированно дело №".$Update." (".$HTTP_GET_VARS['TEXT'].")",0,3,$sqlnews);
  
  
 exit;
 }
 
function check($ch)
{
if ($ch=='on') return 1;
else return 0;
}

if (isset($HTTP_GET_VARS['UpdateClient']))
 {
 $Update=$HTTP_GET_VARS['UpdateClient'];


	$sqlnews="
UPDATE  `1_clients` SET  

`fio` =  '".e($HTTP_GET_VARS['FIO'])."',
`phone1` =  '".e($HTTP_GET_VARS['PHONE1'])."',
`phone2` =  '".e($HTTP_GET_VARS['PHONE2'])."',
`phone3` =  '".e($HTTP_GET_VARS['PHONE3'])."',
`phone4` =  '".e($HTTP_GET_VARS['PHONE4'])."',
`phone11` =  '".e($HTTP_GET_VARS['PHONE11'])."',
`phone22` =  '".e($HTTP_GET_VARS['PHONE22'])."',
`phone33` =  '".e($HTTP_GET_VARS['PHONE33'])."',
`phone44` =  '".e($HTTP_GET_VARS['PHONE44'])."',
`email` =  '".e($HTTP_GET_VARS['EMAIL'])."',
`pas1` =  '".e($HTTP_GET_VARS['PAS1'])."',
`pas2` =  '".e($HTTP_GET_VARS['PAS2'])."',
`pas3` =  '".e($HTTP_GET_VARS['PAS3'])."',
`pas4` =  '".d(e($HTTP_GET_VARS['PAS4']))."',
`client_adress` =  '".e($HTTP_GET_VARS['CLIENT_ADRESS'])."',
`carpets` =  '".check(e($HTTP_GET_VARS['carpets']))."',
`mudguard` =  '".check(e($HTTP_GET_VARS['mudguard']))."',
`tech_1` =  '".check(e($HTTP_GET_VARS['tech_1']))."',
`tech_2` =  '".check(e($HTTP_GET_VARS['tech_2']))."',
`tires` =  '".check(e($HTTP_GET_VARS['tires']))."',
`clientbirthday` =  '".d(e($HTTP_GET_VARS['CLIENTBIRTHDAY']))."',
`prepay` =  '".e($HTTP_GET_VARS['PREPAY'])."',
`date_contract` =  '".d(e($HTTP_GET_VARS['DATE_CONTRACT']))."',
`manager` =  '".e($HTTP_GET_VARS['manager'])."',
`creditmanager` =  '".e($HTTP_GET_VARS['creditmanager'])."',
`birthday` =  '".(e($HTTP_GET_VARS['BIRTHDAY']))."',
`model` =  '".e($HTTP_GET_VARS['model'])."',
`cost` =  '".e($HTTP_GET_VARS['PRICE'])."',
`vin` =  '".e($HTTP_GET_VARS['VIN'])."',
`status` =  '".e($HTTP_GET_VARS['status'])."',
`commercial` =  '".e($HTTP_GET_VARS['commercial'])."',
`comment` =  '".e($HTTP_GET_VARS['COMMENT'])."'
WHERE  `id` ='".$Update."' LIMIT 1";

  $sqlnews=stripcslashes($sqlnews);
  
  $sqlnews = str_replace(( $HTTP_GET_VARS['FIO']), fio(( $HTTP_GET_VARS['FIO'])),$sqlnews);
  $result = mysql_query_my($sqlnews);

//  echo $sqlnews;
  
 jsLog("Отредактирован клиент №".$Update." (".$HTTP_GET_VARS['TEXT'].")",$Update,3,$sqlnews);

	
 exit;
 }

function e($string) {
    // Escape these characters with a backslash:
    // " \ / \n \r \t \b \f
    $search  = array('\\', "\n", "\t", "\r", "\b", "\f", '"');
    $replace = array(' ', ' ', ' ', ' ', ' ', ' ', '`');
    $string  = str_replace($search, $replace, $string);

    // Escape certain ASCII characters:
    // 0x08 => \b
    // 0x0c => \f
    $string = str_replace(array(chr(0x08), chr(0x0C)), array('\b', '\f'), $string);

    return $string;
}

if (isset($HTTP_GET_VARS['Done']))
 {
 $Done=$HTTP_GET_VARS['Done'];

	$sqlnews="
UPDATE  `1_do` SET  
`manager` =  '".$fpk_user."',
`checked` =  '".gmdate("Y-m-d H:i:s",cheltime(time()))."'
WHERE  `id` ='".$Done."' LIMIT 1";
  $sqlnews=( $sqlnews);
  $result = mysql_query_my($sqlnews); 
  
 jsLog("Выполнено дело №".$Done.".",0,3,'');
  
  
 exit;
 }

if (isset($HTTP_GET_VARS['notDone']))
 {
 $Done=$HTTP_GET_VARS['notDone'];

	$sqlnews="
UPDATE  `1_do` SET  
`checked` =  '0000-00-00 00:00:00'
WHERE  `id` ='".$Done."' LIMIT 1";
  $sqlnews=( $sqlnews);
  $result = mysql_query_my($sqlnews); 

 jsLog("Снято выполнение дела №".$Done.".",0,3,'');

 exit;
 }

if (isset($HTTP_GET_VARS['Adddo']))
 {
 $client=$HTTP_GET_VARS['Adddo'];
 $Type=$HTTP_GET_VARS['Type'];
 echo AddDo($client,$Type,0);
 exit;
 }

if (isset($HTTP_GET_VARS['AddClient']))
 {
global $fpk_user,$fpk_brand;
$Manager=( $HTTP_GET_VARS['Manager']);

$admin = $HTTP_GET_VARS['Admin'];

	$sqlnews="


INSERT INTO  `1_clients` (  `id` ,  `fio` ,  `comment` ,  `phone1` ,  `phone2` ,  `phone3` ,  `phone4` ,  `date` ,  `adress` ,  `birthday` ,  `brand` ,  `manager`, `tmp` ) 
VALUES (
'',  'Клиент (".gmdate("d.m H:i",cheltime(time()))." ".$admin.")',  '',  '',  '',  '',  '',  '".gmdate("Y-m-d",cheltime(time()))."',  '',  '1978-00-00',  '".$fpk_brand."',  '".$Manager."', '".$fpk_job."'
);

		";
   $result = mysql_query_my($sqlnews); 

   $sqlnews="SELECT max(id) maxid FROM `1_clients`";

   $result = mysql_query_my($sqlnews); 

   $sql = mysql_fetch_object ($result);
   
if( $admin!="" )
   $did = 0;
else
   $did = 1;
   
   if ($HTTP_GET_VARS['AddClient']==2) $d=AddDo($sql->maxid,'Звонок',$did,$fpk_user,$Manager);
   if ($HTTP_GET_VARS['AddClient']==3) $d=AddDo($sql->maxid,'Визит',$did,$fpk_user,$Manager);
   if ($HTTP_GET_VARS['AddClient']==6) { $d=AddDo($sql->maxid,'Ком-предложение',$did,$fpk_user,$Manager); $d=AddDo($sql->maxid,'Визит',1,$fpk_user,$Manager); }

   if ($HTTP_GET_VARS['AddClient']==4) { $d=AddDo($sql->maxid,'Звонок',1); $d=AddDo($sql->maxid,'OUT',1); }
   if ($HTTP_GET_VARS['AddClient']==5) { $d=AddDo($sql->maxid,'Визит',1); $d=AddDo($sql->maxid,'OUT',1); }
   if ($HTTP_GET_VARS['AddClient']==7) { $d=AddDo($sql->maxid,'Визит',1); $d=AddDo($sql->maxid,'OUT',1); $d=AddDo($sql->maxid,'Ком-предложение',1); }
   
   echo ($sql->maxid);
 exit;
 }

if (isset($HTTP_GET_VARS['Delete']))
 {
 $Delete=$HTTP_GET_VARS['Delete'];
 DeleteDo($Delete);

 jsLog("Удалено дело №".$Delete.".",0,3,'');

 
 exit;
 }
 
if (isset($HTTP_GET_VARS['DeleteClient']))
 {
 $Delete=$HTTP_GET_VARS['DeleteClient'];
 DeleteClient($Delete);

 jsLog("Удален клиент №".$Delete.".",0,3,'');

 exit;
 }

if (isset($HTTP_GET_VARS['Icon']))
 {
 $Clientid2 = $HTTP_GET_VARS['Icon'];
 
   $sqlnews="SELECT icon FROM `1_clients` WHERE  `id` ='".$Clientid2."' LIMIT 1";
   $result = mysql_query_my($sqlnews); 
   @$sql1 = mysql_fetch_object ($result);
   $icon = $sql1->icon;
   switch($icon)
    {
	case 0 : $icon2=1; break;
	case 1 : $icon2=2; break;
	case 2 : $icon2=3; break;
	case 3 : $icon2=4; break;
    case 4 : $icon2=5; break;
    case 5 : $icon2=0; break;
    } 
	
   $sqlnews="UPDATE `1_clients` SET icon = '$icon2' WHERE  `id` ='$Clientid2' LIMIT 1";
   $result = mysql_query_my($sqlnews); 

	echo $icon2;

exit;
 }

if (isset($HTTP_GET_VARS['Icon2']))
 {
 $Clientid2 = $HTTP_GET_VARS['Icon2'];
 
   $sqlnews="SELECT icon2 FROM `1_clients` WHERE  `id` ='".$Clientid2."' LIMIT 1";
   $result = mysql_query_my($sqlnews); 
   @$sql1 = mysql_fetch_object ($result);
   $icon2 = $sql1->icon2;
   switch($icon2)
    {
	case 0 : $icon2=1; break;
	case 1 : $icon2=2; break;
	case 2 : $icon2=3; break;
	case 3 : $icon2=4; break;
    case 4 : $icon2=5; break;
    case 5 : $icon2=0; break;
    } 
	
   $sqlnews="UPDATE `1_clients` SET icon2 = '$icon2' WHERE  `id` ='$Clientid2' LIMIT 1";
   $result = mysql_query_my($sqlnews); 

	echo $icon2;

exit;
 }


if (isset($HTTP_GET_VARS['Clientid2']))
 {

 $Clientid2 = $HTTP_GET_VARS['Clientid2'];
$sqlnews="SELECT 1_clients.* , 1_models.model mymodel , 1_models.cost mycost , 1_models.short FROM `1_clients` LEFT JOIN 1_models ON 1_clients.model = 1_models.id WHERE 1_clients.id=$Clientid2";

//echo $sqlnews."<hr>";
$news=displayNewsAll("fpk-clients-json0.php",$sqlnews);

 $news = str_replace('},]','}]','['.$news.']');


echo $news;
exit;
 }

if (isset($HTTP_GET_VARS['Statistic']))
 {
 $Manager = $HTTP_GET_VARS['Statistic'];
$sqlnews="SELECT * from 1_clients WHERE 1_clients.brand = $fpk_brand AND manager LIKE '%$Manager%'";

echo $sqlnews."<hr>";
$news=displayNewsAll("fpk-clients.php",$sqlnews);
echo $news;
exit;
 }


exit; 
//Задаем данные для отображения дел
$Date = "%"; // Даты для фильтра или %-отобразить Все Даты "2010-10-04 -> 2010-10-09,2010-10-12 -> 2010-10-14,2010-10-19,2010-10-21 -> 2010-10-22,2010-10-28"
$Manager = "%"; // Имя менеджера "JohnWecel"
$Clientid = "%"; // Номер клиента "23"
$Did = 0; // 1-скрывать ли выполненные дела (0=Все, 1=скрывать выполненные, 2=только выполненные)
$Template = "fpk-do.php"; // Шаблон
$What = "Show"; // Что делать - Show, Edit, Add, Delete
$Host = "%"; // Кто поручил дело
$Search = "%"; // Что ищем "%Курган%
$SearchField = array ("1_clients.fio","1_clients.phone1","1_clients.phone2","1_clients.phone3","1_clients.phone4","1_do.comment","1_do.text","1_clients.comment","1_clients.adress","1_clients.birthday");  
$Brand = $fpk_brand; // Какой бренд
$Type = "%"; // Тип действия
$Hide = 1; // 1=показывать скрытые дела
$Order = "Order by DATE2"; //Сортировка

if (isset($HTTP_GET_VARS['Date'])) $Date = $HTTP_GET_VARS['Date'];
if (isset($HTTP_GET_VARS['Manager'])) $Manager = ( $HTTP_GET_VARS['Manager']);
if (isset($HTTP_GET_VARS['Clientid'])) $Clientid = $HTTP_GET_VARS['Clientid'];
if (isset($HTTP_GET_VARS['Did'])) $Did = $HTTP_GET_VARS['Did'];
if (isset($HTTP_GET_VARS['Template'])) $Template = $HTTP_GET_VARS['Template'];
if (isset($HTTP_GET_VARS['What'])) $What = $HTTP_GET_VARS['What'];
if (isset($HTTP_GET_VARS['Host'])) $Host = $HTTP_GET_VARS['Host'];
if (isset($HTTP_GET_VARS['Search'])) $Search = ( $HTTP_GET_VARS['Search']);
if (isset($HTTP_GET_VARS['Brand'])) $Brand = $fpk_brand;
if (isset($HTTP_GET_VARS['Type'])) $Type = $HTTP_GET_VARS['Type'];
if (isset($HTTP_GET_VARS['Order'])) $Order = $HTTP_GET_VARS['Order'];
if (isset($HTTP_GET_VARS['Hide'])) $Hide = $HTTP_GET_VARS['Hide'];

if($Manager=='Все') $Manager='%';

//Вызываем функцию показа дел
echo ShowMeDo(
$Date,
$Manager,
$Clientid,
$Did,
$Template,
$What,
$Host,
$Search,
$SearchField,
$Brand,
$Type,
$Hide,
$Order
);

function jsLog($txt,$id,$important,$sqlnews1)
 {
   global $fpk_user,$fpk_brand;
   
   $sqlnews1 = str_replace("'",'"',$sqlnews1);
   
   $sqlnews="INSERT INTO `1_log` (`id`, `date1`, `manager`, `brand`, `text`, `client`, `important`,`sqlnews`) 
             VALUES ('', NOW(), '$fpk_user', '$fpk_brand', '$txt', '$id', '$important','".$sqlnews1."');";
 //  @$result = mysql_query_my($sqlnews); 
 }


?>

