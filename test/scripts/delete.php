<?php
/*
 * Created on 27 ��� 2007
 *
 * @author Стаценко Владимир
 * @site www.simplecoding.org
 */
require_once("dbdata.php");

$id = null;
$id = $_POST['itemid'];
if (($id != null) && ($id > 0)) {
	//удаляем запись в БД
	$con = connect();
	$updateQuery = sprintf("DELETE FROM listitems WHERE id=%d",
						mysql_real_escape_string($id));
	if (mysql_query($updateQuery)) {
		$results['deletedId'] = $id;
	}
	else {
		$results['error_mes'] = "Не могу обновить запись: ".mysql_error();
	}
}
if ($con != null) {
	mysql_close($con);
}
echo json_encode($results);
?>
