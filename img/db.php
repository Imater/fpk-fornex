<?

 $r=$GLOBALS['_GET']['r'];
 $f=$GLOBALS['_GET']['f'];
 $do=$GLOBALS['_GET']['do'];
 $client=$GLOBALS['_GET']['client'];
 $Clientid=$GLOBALS['_GET']['Clientid'];
 $Did=$GLOBALS['_GET']['Did'];
 $Template=$GLOBALS['_GET']['Template'];
 $Date=$GLOBALS['_GET']['Date'];
 $Manager=$GLOBALS['_GET']['Manager'];
 $Date=$GLOBALS['_GET']['Date'];
 $What=$GLOBALS['_GET']['What'];
 $Host=$GLOBALS['_GET']['Host'];
 $Search=$GLOBALS['_GET']['Search'];
 $SearchField=$GLOBALS['_GET']['SearchField'];
 $Brand=$GLOBALS['_GET']['Brand'];
 $Type=$GLOBALS['_GET']['Type'];
 $Hide=$GLOBALS['_GET']['Hide'];
 $Order=$GLOBALS['_GET']['Order'];

 $HTTP_POST_VARS=$GLOBALS['_POST'];
 $HTTP_GET_VARS=$GLOBALS['_GET'];
 

$config = array(
   'themedir' => "themes/",     // path to dir with themes
   'mysql_host' => "localhost",
   'mysql_user' => "root",
   'mysql_password' => "See6thoh",
);


function username($shortname) { 
   global $config;     

   return 'Вецель Евгений';
}

function brand($shortname) { 
   global $config;     

   return 'Peugeot';
}

//Верхнее меню для всех страниц ФПК
function menu() { 
return '&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="?r=clients">Клиенты</a> | <a href="?r=stat">Статистика</a> | 
<a href="../Tools/phpmyadmin/index.php" target="_blank">Настройка</a> | 
<a href="file://Aldebaran/pgt-autosales$/" target="_blank">Папка ОП</a></div>';

}


//////////////////////////////////////////////////////////////////////////////

//Вывод таблицы с шаблоном $theme
function displayNewsAll($theme,$sqlnews) { 
   global $config,$r,$iii;
   $r=$GLOBALS['_GET']['r'];

   $result = mysql_query($sqlnews); 
   
   $TXT='';
   if (($theme=='fpk-clients.php') or ($theme=='fpk-clients-empty.php') or ($theme=='fpk-clients-sms.php')) $iii=0;
   while ($sql = mysql_fetch_object ($result))
     {
      $TXT.=displayNewsEntry($sql, $theme, $detail="no");
	  if (($theme=='fpk-clients.php') or ($theme=='fpk-clients-empty.php') or ($theme=='fpk-clients-sms.php')) $iii++;
     } 
   return $TXT;
}

//Вывод одной строки
function displayNewsEntry($sql, $theme, $detail="no") { 
   global $config,$topic;     

   $fullbox=implode("", file($config['themedir'].$theme));
   preg_match_all("/#(.*)#/U",$fullbox,$matches);
   for ($i=0; $i<count($matches[0]); $i++) {
      $func_name="mod_".strtolower($matches[1][$i]);
      if (function_exists($func_name)) {
         $tag=call_user_func($func_name,$sql,66,$detail);
         $fullbox=str_replace($matches[0][$i],$tag,$fullbox);
      } else {
         echo "Func $func_name not exists<br>\n";
      }
   }
   return $fullbox;


}

function UpdateClients()
{
global $HTTP_POST_VARS,$config,$client;
	$sqlnews="UPDATE 1_clients SET 
            fio='".$HTTP_POST_VARS['fio']."',
            phone1='".$HTTP_POST_VARS['phone1']."',
            phone2='".$HTTP_POST_VARS['phone2']."',
            phone3='".$HTTP_POST_VARS['phone3']."',
            phone4='".$HTTP_POST_VARS['phone4']."',
            adress='".$HTTP_POST_VARS['adress']."',
            comment='".$HTTP_POST_VARS['comment']."',
            birthday='".$HTTP_POST_VARS['birthday']."'
	    WHERE id=".$client;
   $result = mysql_query($sqlnews); 

}

function UpdateDo()
{
global $HTTP_POST_VARS,$config,$do,$GLOBALS;
	$sqlnews="
UPDATE  `1_do` SET  

`manager` =  '".$HTTP_POST_VARS['SELECTMANAGER']."',
`date1` =  '".$HTTP_POST_VARS['DATE1']."',
`date2` =  '".$HTTP_POST_VARS['DATE2']."',
`text` =  '".$HTTP_POST_VARS['TEXT']."',
`comment` =  '".$HTTP_POST_VARS['DOCOMMENT']."',
`checked` =  '".$HTTP_POST_VARS['DOCHECKED']."',
`type` =  '".$HTTP_POST_VARS['DOTYPE']."',
`host` =  '".$HTTP_POST_VARS['DOHOST']."',
`important` =  '".$HTTP_POST_VARS['DOIMPORTANT']."',
`remind` =  '".$HTTP_POST_VARS['DOREMIND']."',
`changed` =  '".gmdate("Y-m-d H:i:s",cheltime(time()))."'
WHERE  `id` ='".$do."' LIMIT 1";
 $result = mysql_query($sqlnews); 

}


function AddDo($client,$Type)
{
global $HTTP_POST_VARS,$config,$fpk_user,$fpk_brand;

	$sqlnews="
INSERT INTO  `1_do` (  `id` ,  `client` ,  `brand` ,  `manager` ,  `date1` ,  `date2` ,  `text` ,  `comment` ,  `checked` ,  `type` ,  `host` ,  `important` ,  `repeat` ,  `remind` ,  `created` ,  `changed` ,  `starred` ,  `hostcheck` ,  `shablon` ) 
VALUES (
'',  '".$client."',  '".$fpk_brand."',  '".$fpk_user."',  '".gmdate("Y-m-d H:i:s",cheltime(time()))."',  '".gmdate("Y-m-d H:i:s",cheltime(time()+3*60*60))."',  '".$Type."',  '',  '0000-00-00 00:00:00',  '".$Type."',  '".$fpk_user."',  '50',  '',  '0000-00-00 00:00:00',  '0000-00-00 00:00:00',  '0000-00-00 00:00:00',  '',  '0000-00-00 00:00:00',  '')
";

//echo $sqlnews;
   $result = mysql_query($sqlnews); 

   $sqlnews="SELECT max(id) maxid FROM `1_do`";

   $result = mysql_query($sqlnews); 

   $sql = mysql_fetch_object ($result);
   return($sql->maxid);
   

}

function AddClient($Manager)
{
global $HTTP_POST_VARS,$config,$fpk_user,$fpk_brand;

	$sqlnews="


INSERT INTO  `1_clients` (  `id` ,  `fio` ,  `comment` ,  `phone1` ,  `phone2` ,  `phone3` ,  `phone4` ,  `date` ,  `adress` ,  `birthday` ,  `brand` ,  `manager` ) 
VALUES (
'',  '',  '',  '',  '',  '',  '',  '".gmdate("Y-m-d",time())."',  '',  '1978-00-00',  '".$fpk_brand."',  '".$Manager."'
);

		";
   $result = mysql_query($sqlnews); 

   $sqlnews="SELECT max(id) maxid FROM `1_clients`";

   $result = mysql_query($sqlnews); 

   $sql = mysql_fetch_object ($result);
   return($sql->maxid);

}


function DeleteClient($id)
{
global $HTTP_POST_VARS,  $config;

    $sqlnews="DELETE FROM 1_do WHERE client=".$id." LIMIT 1";
    $result = mysql_query($sqlnews); 
    $sqlnews="DELETE FROM 1_clients WHERE id=".$id." LIMIT 1";
    $result = mysql_query($sqlnews); 

}

function DeleteDo($id)
{
global $HTTP_POST_VARS,  $config;

    $sqlnews="DELETE FROM 1_do WHERE id=".$id." LIMIT 1";
    $result = mysql_query($sqlnews); 

}

////Поля таблицы 1_clients
function mod_fio($sql) { return $sql->fio; }
function mod_id($sql) { return $sql->id; }
function mod_phone1($sql) { return $sql->phone1; }
function mod_phone2($sql) { return $sql->phone2; }
function mod_phone3($sql) { return $sql->phone3; }
function mod_phone4($sql) { return $sql->phone4; }
function mod_adress($sql) { return $sql->adress; }
function mod_manager($sql) { return $sql->manager; }
function mod_creditmanager($sql) { return $sql->creditmanager; }
function mod_showmanager($sql) { 

$explodeName = explode(" ", $sql->manager);

return '['.$explodeName[0].']'; 
}
function mod_icon($sql) { return $sql->icon; }
function mod_birthday($sql) { return $sql->birthday; }
function mod_comment($sql) { return $sql->comment; }

function mod_alldo($sql) { 
global $fpk_brand;
//Задаем даныне для отображения дел
$Date = "%"; // Даты для фильтра или %-отобразить все Даты "2010-10-04 -> 2010-10-09,2010-10-12 -> 2010-10-14,2010-10-19,2010-10-21 -> 2010-10-22,2010-10-28"
$Manager = "%"; // Имя менеджера "JohnWecel"
$Clientid = $sql->id; // Номер клиента "23"
$Did = 0; // 1-скрывать ли выполненные дела (0=все, 1=скрывать выполненные, 2=только выполненные)
$Template = "fpk-do-acordion.php"; // Шаблон
$What = "Show"; // Что делать - Show, Edit, Add, Delete
$Host = "%"; // Кто поручил дело
$Search = "%"; // Что ищем "%Курган%
$SearchField = array ("1_clients.fio","1_clients.phone1","1_clients.phone2","1_clients.phone3","1_clients.phone4","1_do.comment","1_do.text","1_clients.comment","1_clients.adress","1_clients.birthday");  
$Brand = $fpk_brand; // Какой бренд
$Type = "%"; // Тип действия
$Hide = 1; // 1=показывать скрытые дела
$Order = "Order by DATE2 DESC"; //Сортировка

return ShowMeDo(
$Date,
$Manager,
$sql->id,
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
}


////Поля таблицы 1_do

function mod_text($sql) { return $sql->text; }
function mod_type($sql) { return $sql->type; }
function mod_docomment($sql) { return $sql->docomment; }
function mod_clientid($sql) { return $sql->client; }
function mod_doid($sql) { return $sql->doid; }
function mod_dodate($sql) { return $sql->date1; }
function mod_dodate2($sql) { return $sql->date2; }
function mod_dochecked($sql) { return $sql->checked; }
function mod_important($sql) { return $sql->important; }
function mod_doremind($sql) { return $sql->remind; }
function mod_docreated($sql) { return $sql->created; }
function mod_dochanged($sql) { return $sql->changed; }
function mod_hostcheck($sql) { return $sql->hostcheck; }

/*function mod_doclient($sql) 
   { 
    global $config,$client;

   $sqlnews="select * from `1_clients` WHERE id='".$sql->client."'";
   $result = mysql_query($sqlnews); 
   @$sql1 = mysql_fetch_object ($result);

   if (@$client=='') return '<a href="./index.php?r=client_edit&client='.$sql1->id.'" title="'.$sql1->phone1.'">'.$sql1->fio.'</a>'; 

   }
*/
function mod_doclientshort($sql) 
   { 
    global $config,$client;

   $sqlnews="select * from `1_clients` WHERE id='".$sql->client."'";
   $result = mysql_query($sqlnews); 
   @$sql1 = mysql_fetch_object ($result);

   $name=$sql1->fio;

    $explodeName = explode(" ", $sql1->fio);
    for ($i=0; $i<count($explodeName); $i++) {
	    if ($i==0) $name = $explodeName[$i];
        if ($i==1) $name.= ' '.$explodeName[$i];
	   }

   
   return $name; 

   }


function mod_doclientmini($cl) 
   { 
    global $config,$client;

   $sqlnews="select * from `1_clients` WHERE id='".$cl."'";
   $result = mysql_query($sqlnews); 
   @$sql1 = mysql_fetch_object ($result);

   return $sql1->fio; 
   }



function mod_doeditclient($sql) 
   { 
    global $config;

   $sqlnews="select * from `1_clients` WHERE id='".$sql->client."'";
   $result = mysql_query($sqlnews); 
   @$sql1 = mysql_fetch_object ($result);

   return '<a href="./index.php?r=client_edit&client='.$sql1->id.'" title="'.$sql1->phone1.'">'.$sql1->fio.'</a>'; 

   }


function mod_date1($sql) 
   { 
    return showdate($sql->date2,$sql); 
	}
function mod_checkcolor($sql) 
   { 
   if ($sql->checked=="0000-00-00 00:00:00") return "black";
    else return "8b8b8b";
   }
   
function mod_inputdone($sql) 
   { 
   if ($sql->checked=="0000-00-00 00:00:00") return '<input idd="'.$sql->doid.'" name="Done" type="submit" value="Выполнить">';
    else return '<input idd="'.$sql->doid.'" name="notDone" type="submit" value="Снять выполнение">';
   }
   
function mod_checkstrike($sql) 
   { 
   if ($sql->checked<>"0000-00-00 00:00:00") return "text-decoration:line-through";
    else return "";
   }


function mod_check($sql) 
  { 
  if ($sql->checked<>"0000-00-00 00:00:00") $did="checked";
   else $did="";
  return '<input name="checkbox" type="checkbox" value="checkbox" '.$did.'>'; 
  }

function cheltime($time)
{
//Прибавить 6 часов разницы во времени (часовые пояса)
 return $time+2*60*60;
}

//Показ даты в списке дел в скобочках сколько дней или часов осталось до дела
function showdate($mydate, $sql) 
{
   $long="";

$dd=(int)( ((strtotime($mydate))-cheltime(time()) )/60/60*10)/10; 

   if ($dd>0) $class='shortdate';
   else $class='shortdatepast';


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

  if ($sql->checked <> '0000-00-00 00:00:00' ) { $class='shortdatedid'; $long=''; }


return '<span class="'.$class.$long.'" title="'.$mydate.'">'.$days.'</span>';
}

function mod_edit_client($sql) { return $sql->id; }

////Автонумератор
function mod_nn($sql) { global $i1; return ++$i1; }
function mod_nn2($sql) { global $i2; return ++$i2; }




//////////////////////////////////////////////////////////////////////////////

function ShowClientList($sqlnews)
{
global $fpk_user, $fpk_brand;
$sqlnews="SELECT * from 1_clients WHERE ".$in." brand='".$fpk_brand."' AND manager='".$fpk_user."' ORDER BY id DESC";
$news=displayNewsAll("fpk-clients-empty.php",$sqlnews);
return $news;
}


function ShowDo($fpk_user,$client,$query,$date)
{
global $client,$fpk_brand;
if ($client==0) { $client='%'; $in1=' AND date2 LIKE "'.$date.'%"';}
if ($client==0) { $client='%'; $in=' AND checked="0000-00-00 00:00:00"';}
else $in="";

if ($query<>"") $in=" AND text LIKE '%".$query."%' ";


//////Выводим весь список клиентов данного менеджера
$sqlnews="SELECT * from 1_do WHERE brand='".$fpk_brand."'".$in.$in1." AND manager LIKE '".$fpk_user."' AND client LIKE '".$client."' ORDER BY date2";
//echo $sqlnews."<hr>";
$news=displayNewsAll("fpk-do.php",$sqlnews);
return $news;
}

//////Выводим падающий список всех менеджеров, вверху тот кто хозяин данного дела $do
function mod_ShowUserlist()
{
   global $config,$r,$fpk_user,$do,$fpk_brand;
   $sqlnews="SELECT * FROM 1_users WHERE brand='".$fpk_brand."' ORDER by job DESC";
   $result = mysql_query($sqlnews); 
   $TXT='';
   while (@$sql = mysql_fetch_object ($result))
     {
      $TXT.='<option>'.$sql->fio.'</option>';
     } 
   return $TXT;
}

function mod_ShowCreditUserlist()
{
   global $config,$r,$fpk_user,$do,$fpk_brand;
   $sqlnews="SELECT * FROM 1_users WHERE brand='".$fpk_brand."' AND job='Кредитный эксперт'";
   $result = mysql_query($sqlnews); 
   $TXT='';
   while (@$sql = mysql_fetch_object ($result))
     {
      $TXT.='<option>Кредит - '.$sql->fio.'</option>';
     } 
   return $TXT;
}

//////Выводим падающий список всех менеджеров, вверху тот кто Поручил данное дело $do
function mod_ShowUserlisthost()
{
   global $config,$r,$fpk_user,$do;
   $sqlnews1="SELECT * FROM 1_do WHERE id='".$do."'";
   $result1 = mysql_query($sqlnews1); 
   @$sql1 = mysql_fetch_object ($result1);
   $sqlnews="SELECT * FROM wakka_users";
   $result = mysql_query($sqlnews); 
   $TXT='<option>'.$sql1->host.'</option>';
   while (@$sql = mysql_fetch_object ($result))
     {
      if ($sql->name<>$sql1->host) $TXT.='<option>'.$sql->name.'</option>';
     } 
   return $TXT;
}


function mod_icontype($sql)
{
   if ($sql->checked == '0000-00-00 00:00:00') $opacity=0.2;
   else $opacity=1;
   return '<img src="img/'.strtolower($sql->type).'.png" width="20px" height="20px" hspace="5" align="absmiddle" style="opacity:'.$opacity.'">';
}

function mod_icontypemini($sql)
{
   if ($sql->checked == '0000-00-00 00:00:00') $opacity=0.2;
   else $opacity=1;
   return '<img src="img/'.strtolower($sql->type).'.png" width="14px" height="14px" hspace="5" align="absmiddle" style="opacity:'.$opacity.'">';
}


function mod_typeid($sql3)
{
   return $sql3->type;
}

function mod_iconsclient($sql3)
{
   $sqlnews="SELECT * FROM 1_dotype ORDER by typeorder DESC";
   $result = mysql_query($sqlnews); 
   $TXT='';
   while (@$sql = mysql_fetch_object ($result))
     {
   $sqlnews="SELECT count(*) cnt FROM 1_do WHERE type='".$sql->type."' AND checked<>'0000-00-00 00:00:00' AND client=".$sql3->id;
   $result2 = mysql_query($sqlnews); 
   @$sql4 = mysql_fetch_object ($result2);
	if ($sql4->cnt > 0) $opacity=0.5;
	else $opacity='0.1';
      if ($sql->type<>$sql1->type) 
	        $TXT.='<img class="dotype" height=20px width=20px title="'.$sql->type.'" src="./img/'.$sql->type.'.png" hspace="10" vspace="0" align="right" style="opacity:'.$opacity.'">';
     } 
   return $TXT;

}


function mod_ShowDoTypeList($sql3)
{
   global $config,$r,$fpk_user,$do;
   $sqlnews1="SELECT type FROM 1_do WHERE id='".$sql3->doid."'";
   $result1 = mysql_query($sqlnews1); 
   @$sql1 = mysql_fetch_object ($result1);
   
   $sqlnews="SELECT * FROM 1_dotype ORDER by typeorder";
   $result = mysql_query($sqlnews); 
   $TXT='<option>'.$sql1->type.'</option>';
   while (@$sql = mysql_fetch_object ($result))
     {
      if ($sql->type<>$sql1->type) $TXT.='<option>'.$sql->type.'</option>';
     } 
   return $TXT;
}

function showdodate()
{
   global $config,$r,$fpk_user,$do,$fpk_brand;
   $sqlnews="SELECT * FROM 1_do WHERE checked='0000-00-00 00:00:00' AND brand='$fpk_brand' AND manager='$fpk_user' ORDER BY date2";
   $result = mysql_query($sqlnews);
   $TXT='';
   $dat='';
   $t1='';
   while (@$sql = mysql_fetch_object ($result))
     {
      if ($dat<>gmdate("Ymd",(strtotime($sql->date2))) )
          {
           $TXT.=$t1.gmdate("Ymd",(strtotime($sql->date2))).': {klass: "highlight", tooltip: "<font color=#999999>'.gmdate("H:i",cheltime(strtotime($sql->date2))).'</font> '.$sql->text.' ('.mod_doclientmini($sql->client).') ';
           $dat=gmdate("Ymd",(strtotime($sql->date2)));
           $t1='"}, ';
          }
       else 
          {
           $TXT.=' <hr><font color=#999999>'.gmdate("H:i",cheltime(strtotime($sql->date2))).'</font> '.$sql->text.' ('.mod_doclientmini($sql->client).') ';
          }
     } 
   $TXT .= '" } ';

 //echo $TXT;
//$txt='
//              20101007: { klass: "highlight", tooltip: "16:00 Купить все для суши (Курган В.Н)" },
//              20101008: { klass: "highlight2", tooltip: "18:30 Задать вопрос по кредиту (Завьялов П.)<hr>19:30 Выдача 308 (Михайлов А.)" },
//              20101010: { klass: "highlight", tooltip: "12:30 Позвонить по поводу денег (Петров Алексей)<hr>16:30 Тестдрайв (Курган В.Н.)" }
//     ';
return $TXT;
}

//Конвертируем набор дат в SQL фильтр из такого формата: "2010-10-04 -> 2010-10-09,2010-10-12 -> 2010-10-14,2010-10-19,2010-10-21 -> 2010-10-22,2010-10-28"
function DateToSQL($Date)
{

    $Date= str_replace(" -&gt; "," -> ",$Date);
    $explodeDate = explode(",", $Date);
    $datesql = "FALSE "; 
    for ($i=0; $i<count($explodeDate); $i++) {
	if (strlen($explodeDate[$i])>12) 
       {
	   $explodeDate2 = explode(' -> ',$explodeDate[$i]);
	   $datesql .= "OR date2 BETWEEN '$explodeDate2[0]' AND '$explodeDate2[1]' ";
	   }
	else $datesql .= "OR date2 LIKE '$explodeDate[$i]%' ";
	}
	return $datesql;
}

function SearchFieldSQL($SearchField,$Search)
{
    //По каким полям искать
    $searchsql = "AND ( FALSE ";
    for ($i=0; $i<count($SearchField); $i++) 
	   {
	   $searchsql .= " OR ".$SearchField[$i]." LIKE '$Search'";
	   }
    $searchsql .= " ) ";
	
	
	return $searchsql;
}


//Одна из главных функций отображения дела по многочисленным фильтрам
function ShowMeDo (
	$Date = "%", // Даты для фильтра
	$Manager = "%", // Имя менеджера
	$Clientid = "%", // Номер клиента
	$Did = 0, // 1-скрывать ли выполненные дела (0=все дела, 1=скрывать выполненные, 2=только выполненные, 3=просрочены)
	$Template = "fpk-do.php", // Шаблон
	$What = "Show", // Что делать - Show, Edit, Add, Delete
	$Host = "%", // Кто поручил дело
	$Search = "%", // Что ищем
    $SearchField = array ("1_clients.fio","1_clients.phone1","1_clients.phone2","1_clients.phone3","1_clients.phone4","1_do.comment","1_do.text","1_clients.comment","1_clients.adress","1_clients.birthday"), //По каким полям искать  
	$Brand = "Peugeot", // Какой бренд
	$Type = "Звонок", // Тип действия
	$Hide = 1, // 1=показывать скрытые дела
	$Order = "Order by DATE2" //Сортировка
	)
	{
	global $fpk_brand;
	
if(isset($GLOBALS['_GET']['do']))
    {
    $doid=$GLOBALS['_GET']['do'];
	$doid="AND 1_do.id=$doid";
	}
	else $doid='';
if ($What == 'Show') //Если нужно ОТОБРАЗИТЬ дела
 {
    $datesql = DateToSQL($Date); //Конвертируем набор дат в SQL фильтр

	switch ($Did) //Скрывать ли дела
	  { //(0=все дела, 1=скрывать выполненные, 2=только выполненные)
		case 0: $checked = ""; break;
	    case 1: $checked = " AND checked = '0000-00-00 00:00:00' "; break;
		case 2: $checked = " AND checked != '0000-00-00 00:00:00' "; break;
		case 3: { $checked = " AND checked = '0000-00-00 00:00:00' "; $datesql = "1_do.date2 < NOW()"; break; }
	  }
       	
    //Вставляем в SQL поле для поиска, набор полей берем в SearchField
	if ($Search!="%") $searchsql = SearchFieldSQL($SearchField,$Search);
	else $searchsql="";

	$sql="SELECT *, 1_do.id doid, 1_do.comment docomment FROM  `1_do` 
	      JOIN 1_clients ON 1_clients.id = 1_do.client 
		  WHERE $datesql AND 1_clients.brand = '$fpk_brand' AND 1_clients.manager LIKE '$Manager' AND 1_do.client LIKE '$Clientid'
		  $checked $searchsql $doid $Order
			 ";
//	echo $sql;		 
    $news=displayNewsAll($Template,$sql);
	return $news;
	}
  }
	
	
function User ($email, $pass)
{
global $fpk_user,$fpk_user_short,$fpk_brand,$fpk_id;
   $sqlnews1="SELECT * FROM 1_users WHERE email='".$email."' AND md5password='$pass'";
   $result1 = mysql_query($sqlnews1); 
   @$sql1 = mysql_fetch_object ($result1);
   $fpk_user = $sql1->fio;
   
    $explodeName = explode(" ", $fpk_user);
    $name = $explodeName[0].' '.$explodeName[1][0].'.'.$explodeName[2][0].'.';
   $fpk_user_short = $name;
   
   $fpk_brand=$sql1->brand;
   $fpk_id = $sql1->id;
   
if ($fpk_user=='') return false;
return true;
}

?>