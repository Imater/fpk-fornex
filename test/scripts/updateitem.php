<?php
/*
 * Created on 19.12.2007
 *
 * @author Стаценко Владимир
 * @site www.simplecoding.org
 */
require_once("dbdata.php");

$v = null;
$id = null;
$v = $_POST['value'];
$id = $_POST['id'];
if (($v != null) && ($v != "") && ($id != null) && ($id != "") ) {
	$v = htmlspecialchars($v);
	//обновляем запись в БД
	$con = connect();
	$updateQuery = sprintf("UPDATE listitems SET item='%s' WHERE id=%d",
						mysql_real_escape_string($v),
						mysql_real_escape_string($id));
	if (mysql_query($updateQuery)) {
		echo $v;
		return;
	}
	else {
		$results['error_mes'] = "Не могу обновить запись: ".mysql_error();
	}
}
else {
	$results['error_mes'] = 'Не задано значение записи';
}
if ($con != null) {
	mysql_close($con);
}
echo json_encode($results);
?>
