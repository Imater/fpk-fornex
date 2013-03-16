<?php
// —четчик по первому файлу: 

if ($book==1) {
header("location: http://wezel.ru/book/download/Social network Kovcheg-1.fb2"); //«десь указываете путь к файлу, который нужно скачать
}
// счетчик по второму файлу
else if ($book==2) {
header("location: http://www.сайт.ру/Zip/zip2.zip");
$file=fopen("book2.txt","a+");
flock($file,LOCK_EX);
$count=fread($file,100);
$count++;
ftruncate($file,0);
fwrite($file,$count);
flock($file,LOCK_UN);
fclose($file);
}
?>