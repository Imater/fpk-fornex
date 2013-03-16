<?



$sqlnews="SELECT * from 1_do WHERE brand='".brand($fpk_user)."' AND manager LIKE '%' AND id='".$do."'";
//echo $sqlnews."<hr>";
$news=displayNewsAll("fpk-do-edit.php",$sqlnews);



echo '<form name="client_edit" method="post" action="?r=do&client='.$client.'&do='.$do.'">';

echo $news;

echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="Submit" name="SubmitDo" tabindex="7" value="Сохранить">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Submit" name="SubmitDo" value="Отменить">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Submit" name="SubmitDo" value="Удалить"> </form>';


?>