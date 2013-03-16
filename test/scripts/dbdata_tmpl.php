<?php
/*
 * Created on 18.12.2007
 *
 * @author Стаценко Владимир
 * @site www.simplecoding.org
 *
 * Этот файл необходимо скопировать в эту же папку с именем dbdata.php
 * После этого указать параметры подключения к базе данных
 */
function connect() {
	$db_host = "your_db_host";
	$db_name = "your_db_name";
	$db_user = "user_name";
	$db_pass = "user_password";

	$con = mysql_connect($db_host, $db_user, $db_pass);
	if ($con === FALSE) {
		echo "<h2>Не могу подключиться к серверу MySQL</h2>";
		die();
	}
	if (!mysql_select_db($db_name)) {
		echo "<h2>Не могу подключиться к указанной базе данных</h2>";
		die();
	}
	return $con;
}
?>
