<?php
//
// ��������! �� ����������� ���������� � ������� �� ������ ���� ��������
// �� ������ �������. � ��������� ������ ������� header(), ������������
// �����������, �� ��������� (��. ������������), � ��������� ������.
//

// �������� ������.
session_start();
// ���������� ���������� ���������.
require_once "js/config.php";
require_once "js/Php.php";
// ������� ������� ������ ����������.
// ��������� ��������� �������� (�����������!).
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("utf8");
// �������� ������.
$q = $_REQUEST['q'];
$fpk_user = $_REQUEST['fpk_user'];
//@$date = $_REQUEST['date'];
//echo '<b>'.$date.'</b>';
// ��������� ��������� ����� � ���� PHP-�������!
$_RESULT = array(
  "q"     => $q,
  "md5"   => md5($q),
  'hello' => isset($_SESSION['hello'])? $_SESSION['hello'] : null
); 
// ������������ ���������� ���������.
if (strpos($q, 'error') !== false) {
  callUndefinedFunction();
}
//echo "<b>Loader used:</b> ".$JsHttpRequest->LOADER;
if ($q<>'') include 'http://localhost'."/fpk/do.php?Search=".urlencode("%".$q."%");



//if ($date<>'') include 'http://172.16.13.27'."/fpk/loader-do.php?date=".$date."&fpk_user=".$fpk_user."&q=".str_replace(" ","%20",$q);
?>