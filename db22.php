<?
require_once('db2.php');

echo gmdate("Y-m-d H:i:s",(time())).' - время по Гринвичу<br>';
echo gmdate("Y-m-d H:i:s",cheltime(time()));
?>