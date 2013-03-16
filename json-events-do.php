<?php
header('Content-type: text/html; charset=utf-8');

include "db.php";
$db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
mysql_query("SET NAMES utf8");
mysql_select_db('h116',$db);   
$fpk_brand=$_COOKIE['brand'];
$fpk_job=$_COOKIE['fpk_job'];

if (!$db) { echo "Ошибка подключения к SQL :("; exit();}

$manager = $HTTP_GET_VARS['Manager'];
$version = $HTTP_GET_VARS['version'];

if ($manager=='Все') $manager="%";
	$year = date('Y');
	$month = date('m');
	
		
	
if ($version==3)
  {
    $manager='%';
    $sqlnews="SELECT *,1_clients.id clientid,1_clients.manager manager, 1_do.id id, 1_do.checked chk FROM `1_do` JOIN 1_clients ON 1_clients.id = 1_do.client WHERE 1_clients.brand = '".$fpk_brand."' AND 1_do.type='Ком-предложение'";
    $result = mysql_query($sqlnews); 
    $i=0;
    while (@$sql = mysql_fetch_object ($result))
       {
		$do[$i]['clientid']=$sql->clientid;
		$do[$i]['id']=$sql->id;
		$man = '';
		if ($manager=='%') $man=mod_showmanager($sql).' ';
		$do[$i]['title']=$man.$sql->text.' ('.mod_model($sql).' - '.$sql->fio.')';
		if ($sql->chk!='0000-00-00 00:00:00') $do[$i]['className']='did-vidan';
		else $do[$i]['className']='did-notvidan';

		$do[$i]['start']=$sql->date2;
		//$do[$i]['end']=strtotime($sql->date2)+30*60-1*24*60*60;
		if (stristr($sql->date2,'00:00:00')) $do[$i]['allDay']=true;
		else $do[$i]['allDay']=false;
		$i++;
		
       }

  echo json_encode($do);
  exit;
  }
	
	
///////////////////////////////////////////////////
if ($version==4)
  {
    $manager='%';
    $sqlnews="SELECT *,1_clients.icon2, 1_clients.id clientid,1_clients.manager manager, 1_do.type, 1_do.id id, 1_do.checked chk FROM `1_do` JOIN 1_clients ON 1_clients.id = 1_do.client WHERE 1_clients.brand = '".$fpk_brand."' AND ( 1_do.type='Подготовка')";
    $result = mysql_query($sqlnews); 
    $i=0;
    while (@$sql = mysql_fetch_object ($result))
       {
		$do[$i]['clientid']=$sql->clientid;
		$do[$i]['id']=$sql->id;
		$man = '';
		if ($manager=='%') $man=mod_showmanager($sql).' ';
		
		$clfio=explode(" ",$sql->fio);
		
		$do[$i]['title']='['.$clfio[0].' - '.mod_model($sql).']'.$man.' '.$sql->text.' '.$sql->vin;

		if (($sql->chk!='0000-00-00 00:00:00')) $do[$i]['className']='did-vidan';
		else 
		  {
		  $do[$i]['className']='did-notvidan';
		  if ($sql->icon2==5) $do[$i]['className']='did-notvidanred';

		  }

		$do[$i]['start']=$sql->date2;
		//$do[$i]['end']=strtotime($sql->date2)+30*60-1*24*60*60;
		if (stristr($sql->date2,'00:00:00')) $do[$i]['allDay']=true;
		else $do[$i]['allDay']=false;
		$i++;
		
       }
  echo json_encode($do);
  exit;
   
  }

if ($version==2)
  {
    $manager='%';
    $sqlnews="SELECT *,1_clients.icon2, 1_clients.id clientid,1_clients.manager manager, 1_do.type, 1_do.id id, 1_do.checked chk FROM `1_do` JOIN 1_clients ON 1_clients.id = 1_do.client WHERE 1_clients.brand = '".$fpk_brand."' AND ( 1_do.type='Выдача')";
    $result = mysql_query($sqlnews); 
    $i=0;
    while (@$sql = mysql_fetch_object ($result))
       {
		$do[$i]['clientid']=$sql->clientid;
		$do[$i]['id']=$sql->id;
		$man = '';
		if ($manager=='%') $man=mod_showmanager($sql).' ';

		$clfio=explode(" ",$sql->fio);
		
		$do[$i]['title']='['.$clfio[0].' - '.mod_model($sql).']'.$man.' '.$sql->text.' '.$sql->vin;
		if (($sql->chk!='0000-00-00 00:00:00')) $do[$i]['className']='did-vidan';
		else 
		  {
		  $do[$i]['className']='did-notvidan';
		  if ($sql->icon2==5) $do[$i]['className']='did-notvidanred';

		  }
		if ($sql->type=='Подготовка') $do[$i]['className']='did-podg';

		$do[$i]['start']=$sql->date2;
		//$do[$i]['end']=strtotime($sql->date2)+30*60-1*24*60*60;
		if (stristr($sql->date2,'00:00:00')) $do[$i]['allDay']=true;
		else $do[$i]['allDay']=false;
		$i++;
		
       }
       
       
       
///Выдачи со звездочками///
    $sqlnews="SELECT * FROM 1_clients WHERE 1_clients.brand = '".$fpk_brand."' AND 1_clients.icon2 >= 3 AND 1_clients.id NOT IN (SELECT client FROM 1_do WHERE client=1_clients.id AND (1_do.type='Выдача' OR 1_do.type='OUT')) ORDER by icon2 DESC";
    $result = mysql_query($sqlnews); 
    
    while (@$sql = mysql_fetch_object ($result))
      {
      $d=date("Y-m-d", (strtotime($sql->date2)));
		$man = '';
		if ($manager=='%') $man=mod_showmanager($sql).' ';
		$do[$i]['clientid']=$sql->id;
		//$do[$i]['id']=$sql->id;
		$clfio=explode(" ",$sql->fio);
		$do[$i]['title']='['.$clfio[0].'-'.mod_model($sql).']'.$man.' Вероятность:'.$sql->icon2.' '.$sql->vin;

		$do[$i]['start']=date('Y').'-'.date('m').'-'.date('t'); //Исправить дату на конец месяца!
		
		
		
		$do[$i]['allDay']=true;
		$i++;
	   }






  echo json_encode($do);
  exit;
  }

//////////////////////////////////////////////////////



	//$do=null;

    $sqlnews="SELECT *,1_clients.id clientid,1_clients.manager manager, 1_do.id id, 1_do.checked chk FROM `1_do` JOIN 1_clients ON 1_clients.id = 1_do.client WHERE 1_clients.brand = '".$fpk_brand."' AND 1_do.manager LIKE '".$manager."%' AND 1_do.checked='0000-00-00 00:00:00'";
    $result = mysql_query($sqlnews); 
    $i=0;
    while (@$sql = mysql_fetch_object ($result))
       {
		$do[$i]['clientid']=$sql->clientid;
		$do[$i]['id']=$sql->id;
		$man = '';
		if ($manager=='%') $man=mod_showmanager($sql).' ';
		$do[$i]['title']=$man.$sql->text.' ('.mod_model($sql).' - '.$sql->fio.')';
		
		if (gmstrtotime($sql->date2)<(cheltime(gmmktime()))) $do[$i]['className']='did';

		$do[$i]['start']=($sql->date2);
		//$do[$i]['end']=strtotime($sql->date2)+30*60-1*24*60*60;
		if (stristr($sql->date2,'00:00:00')) $do[$i]['allDay']=true;
		else $do[$i]['allDay']=false;
		$i++;
		
       }

    $sqlnews="SELECT * FROM `1_do` WHERE client = 0 AND brand = '".$fpk_brand."' AND manager LIKE '".$manager."%' AND 1_do.checked='0000-00-00 00:00:00'";
    $result = mysql_query($sqlnews); 
    while (@$sql = mysql_fetch_object ($result))
       {
		$do[$i]['clientid']=$sql->clientid;
		$do[$i]['id']=$sql->id;
		$man = '';
		if ($manager=='%') $man=mod_showmanager($sql).' ';
		$do[$i]['title']=$man.$sql->text;
		$do[$i]['className']='did2';

		$do[$i]['start']=($sql->date2);
		$do[$i]['end']=($sql->date1);
		if (stristr($sql->date2,'00:00:00')) $do[$i]['allDay']=true;
		else $do[$i]['allDay']=false;
		$i++;
		
       }

   $sqlnews1="SELECT * FROM 1_users WHERE fio='".$manager."'";
   $result1 = mysql_query($sqlnews1); 
   @$sql1 = mysql_fetch_object ($result1);
   $fpk_job=$sql1->job;


if ($fpk_job == 'Кредитный эксперт') 
   {
    $sqlnews="SELECT *,1_clients.id clientid,1_clients.manager manager, 1_do.id id, 1_do.checked chk, 1_do.type FROM `1_do` JOIN 1_clients ON 1_clients.id = 1_do.client WHERE 1_clients.brand = '".$fpk_brand."' AND 1_do.type = 'Кредит' AND 1_do.checked='0000-00-00 00:00:00'";
    $result = mysql_query($sqlnews); 
    while (@$sql = mysql_fetch_object ($result))
       {
		$do[$i]['clientid']=$sql->clientid;
		$do[$i]['id']=$sql->id;
		$man = '';
		if ($manager=='%') $man=mod_showmanager($sql).' ';
		$do[$i]['title']=$man.$sql->text.' ('.mod_model($sql).' - '.$sql->fio.')';
				
		
		if (gmstrtotime($sql->date2)<(cheltime(gmmktime()))) $do[$i]['className']='did';

		$do[$i]['start']=($sql->date2);
		//$do[$i]['end']=strtotime($sql->date2)+30*60-1*24*60*60;
		if (stristr($sql->date2,'00:00:00')) $do[$i]['allDay']=true;
		else $do[$i]['allDay']=false;
		$i++;
		
       }
     }

	echo json_encode($do);

?>
