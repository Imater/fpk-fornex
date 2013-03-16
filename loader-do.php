<?
 include "db.php";
 @ $db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
 if (!$db) { echo "Ошибка подключения к SQL :("; exit();}
?>


<table width="100%" height="100%" border="1" bordercolor="#CCCCCC" cellspacing="0" bgcolor="#FFFFFF">
<tr>
  <td width="100%" valign="top">

<? echo ShowDo($fpk_user,NULL,"",$date); ?>

  </td>
</tr>
</table> 
 