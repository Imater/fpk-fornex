<h2>Отзывы читателей:</h2>
<?
include "book/db.php";

$db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
mysql_query("SET NAMES utf8");
mysql_select_db($config[base_name],$db);   
if (!$db) { echo "Ошибка подключения к SQL :("; exit();}


$sqlnews1="select * from 1_books_comments WHERE book=0 ORDER by date DESC";
$sql = mysql_query($sqlnews1);

while(@$row=mysql_fetch_array($sql))
{
   $comment = str_replace("\n",'</p><p>',$row['comment']);

   echo '<div class="comm"><p><b>'.$row['name'].':</b> '.$comment.'</p></div>';
}


?>
<br>
<br>
<br>
Присылайте отзывы на eugene.leonar@gmail.com