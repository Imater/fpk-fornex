<style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 16px}
-->
</style>
<p align="center" class="style1">&nbsp;</p>
<p align="center" class="style1">Добро пожаловать, <? echo username($fpk_user); ?>.</p>
<p align="center" class="style1"></p>


<?
if ($fpk_user=='') echo '<p align="center" class="style1"><a href="/wiki/index.phpLogin?action=logout&goback=Settings">Зарегистрируйтесь пожалуйста. </a></p>';
else echo '<p align="center" class="style2"><a href="/wiki/index.phpLogin?action=logout&goback=Settings">Сменить пользователя. </a></p>';
?>


<a href="/wiki/index.phpLogin?action=logout&goback=Settings"></a>
