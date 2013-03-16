<?
echo $_SERVER['HTTP_USER_AGENT'];
$ss=get_browser(null,true);
echo '<hr>br='.$ss;
print_r($ss);


echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

$browser = get_browser(null, true);
print_r($browser);
?>