<?php
include_once 'class.get.image.php';
echo 'Hello!';
$image = new GetImage;

$image->source = 'http://contents.img.rugion.ru/_i/news/c/regions/74/auto/2011/04/nk/11_ural2.jpg';
echo $image->source;
$image->save_to = 'images/'; 

$info = GetImageSize('http://contents.img.rugion.ru/_i/news/c/regions/74/auto/2011/04/nk/11_ural2.jpg');
print_r($info);


//$get = $image->download('gd'); 

if($get)
{
echo 'Картинка сохранена.';
}
?>