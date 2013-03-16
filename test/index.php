<?php
/*
 * Created on 17 ��� 2007
 *
 * @author Стаценко Владимир
 * @site www.simplecoding.org
 */
?>

<?php
require_once("scripts/dbdata.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
<title>WebListEditor</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="scripts/libs/prototype.js"></script>
<script type="text/javascript" src="scripts/libs/scriptaculous.js?load=effects,controls"></script>
<script type="text/javascript" src="scripts/tasks.js"></script>
</head>

<body>

<?php $con = connect(); ?>
<div id="content">
<?php
$res = mysql_query("SELECT * FROM listitems");
if ($res === FALSE) {
	echo "Ошибка при отправке запроса к БД:".mysql_error();
}
elseif (mysql_num_rows($res) == 0) {
	echo "<div id=\"noItems\">Записей нет</div>";
}
else {
?>
<p>Список:</p>
<ul id="list">
<?php
	$i = 0;
	while ($item = mysql_fetch_array($res, MYSQL_ASSOC)) {
		$i++;
?>
<li id="listNum_<?php echo $i - 1; ?>">
<div class='itemNum'><?php echo $i; ?></div>
<div class='itemValue' onclick='closeOtherEditors(<?php echo $i - 1; ?>)'
id="itemId_<?php echo $item['id']; ?>"><?php echo $item['item']; ?></div>
<a href="#" class="deleteLink" onclick="deleteItem(<?php echo $item['id']; ?>)">
<img src="css/images/delete.gif" alt="Удалить" title="Удалить" />
</a>
<script type="text/javascript">
editors.push(addEditor("itemId_<?php echo $item['id'];?>",
	"<?php echo $item['id'];?>"));
</script>
</li>
<?php
	}
?>
</ul>
<?php
}
?>
</div>
<?php
mysql_free_result($res);
mysql_close($con);
?>
<form action="#" id="add_item_form">
<p>
<label for="item_value"></label>
<input type="text" id="item_value" size="30" />
<input type="button" value="Добавить" onclick="addItem()" />
</p>
</form>

</body>
</html>