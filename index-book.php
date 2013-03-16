<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Социальная сеть Ковчег - фантастическая трилогия. Автор Вецель Евгений.</title>
<meta name="keywords" content="ковчег, вецель, книга, повесть">
<meta name="description" content="Фантастическая трилогия от Вецель Евгения – Социальная сеть Ковчег">

<link href="frontcss.css" rel="stylesheet" type="text/css" />
<style>
body
{
background-image:url('book/images/kovcheg.png');
background-repeat:no-repeat;
background-position:right bottom;
margin-right:200px;
}
</style>
</head>
<body>
<div id="full"> <a href="/"><img src="book/logo.png" alt="Книга – Социальная сеть Ковчег. Автор Вецель Евгений." width="226" height="85" border="0" style="margin-left:25px;margin-top:20px;" /></a> </div>
<div id="full">
  <div id="left">
    <p><a href="?p=about" class="menu">о книге</a> <br />
      <a href="?p=autor" class="menu">от автора</a><br />
      <a href="?p=club" class="menu">вступить в клуб</a><br />
	  <a href="?p=download" class="menu">скачать книги</a> <br />
    <a href="?p=comment" class="menu">отзывы</a> </p>
    <p><a href="book/" class="menu">читать онлайн</a> </p>
  </div>
  <div id="right">
    <? 
	$p = $HTTP_GET_VARS['p'];
    if(($p=='about') or ($p=='')) include "frontabout.php"; 
    if($p=='autor') include "frontautor.php"; 
    if($p=='club') include "frontclub.php"; 
    if($p=='comment') include "frontcomment.php"; 
    if($p=='download') include "frontdownload.php"; 
    ?>
   </div></div>  </div>
</div>
<div id="bot"><img src="images/spacer.gif" width="760" height="1" />
  <div id="right">
    <p style="margin:155px 0 0 20px;">&copy; <a href="http://vk.com/id38346778">Вецель Евгений</a><br /><br />&nbsp;&nbsp;&nbsp;
</p>
  </div>
</div>
<!-- Yandex.Metrika informer -->
<a href="http://metrika.yandex.ru/stat/?id=13851142&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/13851142/1_0_FFFFFFFF_FFFFFFFF_0_uniques"
style="width:80px; height:15px; border:0; bottom:20px; left:20px;opacity:0" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:13851142,type:0,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter13851142 = new Ya.Metrika({id:13851142, enableAll: true, webvisor:true});
        } catch(e) {}
    });
    
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/13851142" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter --></body>
</html>