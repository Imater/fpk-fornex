<?
//print_r($HTTP_POST_VARS);

if (@$HTTP_POST_VARS['Submit']=='�������') 
  {
  DeleteClient($client);
  echo '<h1>���������� �� ������� '.$HTTP_POST_VARS['fio'].' �������</h1>';
  exit;
  }


if (@$HTTP_POST_VARS['Submit']=='���������') { UpdateClients(); $status='���������� ��������� � ';}
else if (@$f=='add') { $status='���������� ���������� � ������� �������� � '; $client=AddClient(); }


?>

<style type="text/css">
<!--
.�����2 {font-size: 16px}
.�����3 {
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
if (@$HTTP_POST_VARS['Submit']=='�������') 
  {
  DeleteClient($client);
  echo '<h1>���������� �� ������� <b>'.$HTTP_POST_VARS['fio'].'</b> �������</h1>';
  exit;
  }



//////������� �������� ������� ��� ��������������
$sqlnews="SELECT * from 1_clients WHERE brand='".brand($fpk_user)."' AND manager='".$fpk_user."' AND id='".$client."'";
//echo $sqlnews."<hr>";
$news=displayNewsAll("fpk-client_edit.php",$sqlnews);

echo '<form name="client_edit" method="post" action="?r=client_edit&client='.$client.'">';

echo $news;

echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Submit" tabindex="7" value="���������">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="��������">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="�������"> </form>';





?>
<a href="?r=clients&client=<? echo $client; ?>">������� � ������ �������� � ���</a>
  </span></td>
</tr>
</table>
