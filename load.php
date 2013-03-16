<?php
//
// ВНИМАНИЕ! До подключения библиотеки в браузер не должно быть выведено
// ни одного символа. В противном случае функция header(), используемая
// библиотекой, не сработает (см. документацию), и возникнет ошибка.
//

// Стартуем сессию.
session_start();
// Подключаем библиотеку поддержки.
require_once "js/config.php";
require_once "js/Php.php";
// Создаем главный объект библиотеки.
// Указываем кодировку страницы (обязательно!).
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("utf8");
// Получаем запрос.
$q = $_REQUEST['q'];
$fpk_user = $_REQUEST['fpk_user'];
//@$date = $_REQUEST['date'];
//echo '<b>'.$date.'</b>';
// Формируем результат прямо в виде PHP-массива!
$_RESULT = array(
  "q"     => $q,
  "md5"   => md5($q),
  'hello' => isset($_SESSION['hello'])? $_SESSION['hello'] : null
); 
// Демонстрация отладочных сообщений.
if (strpos($q, 'error') !== false) {
  callUndefinedFunction();
}
//echo "<b>Loader used:</b> ".$JsHttpRequest->LOADER;
if ($q<>'') include 'http://localhost'."/fpk/do.php?Search=".urlencode("%".$q."%");



//if ($date<>'') include 'http://172.16.13.27'."/fpk/loader-do.php?date=".$date."&fpk_user=".$fpk_user."&q=".str_replace(" ","%20",$q);
?>