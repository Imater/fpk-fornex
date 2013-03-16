<?
//print_r($HTTP_POST_VARS);

if (@$HTTP_POST_VARS['Submit']=='Удалить') 
  {
  DeleteClient($client);
  echo '<h1>Информация по клиенту '.$HTTP_POST_VARS['fio'].' удалена</h1>';
  exit;
  }


if (@$HTTP_POST_VARS['Submit']=='Сохранить') { UpdateClients(); $status='Информация сохранена в ';}
else if (@$f=='add') { $status='Добавление информации о клиенте началось в '; $client=AddClient(); }


?>

<style type="text/css">
<!--
.стиль2 {font-size: 16px}
.стиль3 {
	font-size: 9px;
	color: #666666;
}
.style1 {font-size: 18px}
-->
</style>


<table width="100%" height="100%" cellspacing="15">
<tr>
<td valign="top">
<?

showclientlist(NULL);

if (@$status<>'') echo '<center><font color="#CCCCFF">'.@$status.' '.gmdate("H:i:s",time()+21600).'</font></center>';

?>
  <span class="style1">
  <?
if (@$HTTP_POST_VARS['Submit']=='Удалить') 
  {
  DeleteClient($client);
  echo '<h1>Информация по клиенту <b>'.$HTTP_POST_VARS['fio'].'</b> удалена</h1>';
  exit;
  }



//////Выводим карточку клиента для редактирования
$sqlnews="SELECT * from 1_clients WHERE brand='".brand($fpk_user)."' AND manager='".$fpk_user."' AND id='".$client."'";
//echo $sqlnews."<hr>";
$news=displayNewsAll("fpk-client_edit.php",$sqlnews);

echo '<form name="client_edit" method="post" action="?r=client_edit&client='.$client.'">';

echo $news;

echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Submit" tabindex="7" value="Сохранить">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="Отменить">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="Удалить"> </form>';





?>
<a href="?r=clients&client=<? echo $client; ?>">Перейти в список клиентов и дел</a>
  </span></td>
</tr>
</table>
