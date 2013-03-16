<?php
/*
 * Created on 18.12.2007
 *
 * @author Стаценко Владимир
 * @site www.simplecoding.org
 */
require_once("dbdata.php");

$value = null;
$value = $_POST['value'];
$results = array();
if ($value != null && $value != "") {
	$value = htmlspecialchars($value);
	//добавляем запись в БД
	$con = connect();
	$addQuery = sprintf("INSERT INTO listitems(item) VALUES('%s')",
						mysql_real_escape_string($value));
	if (mysql_query($addQuery)) {
		$results['id'] = mysql_insert_id();
		$results['value'] = $value;
	}
	else {
		$results['error_mes'] = "Не могу добавить запись: ".mysql_error();
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
