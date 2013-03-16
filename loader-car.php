<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<?
 include "db.php";
 @ $db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
 if (!$db) { echo "Ошибка подключения к SQL :("; exit();}



//@$fpk_user=$HTTP_COOKIE_VARS['wakka_name'];

?>
<table width="500" height="100%" border="1" bordercolor="#CCCCCC" cellspacing="0" bgcolor="#FFFFFF">
<tr>
  <td width="150" valign="top">
<? 

echo str_replace($q,"<font color=red>".$q."</font>",ShowClientList($q)); 

?></td>
<td width="150" valign="top">
<? echo str_replace($q,"<font color=red>".$q."</font>",ShowDo($fpk_user,NULL,$q,NULL)); 

?>
</td>
</tr>
</table> 
 