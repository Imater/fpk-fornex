    <style type="text/css">
      .highlight { font-weight:bold !important; }
      .highlight2 { font-weight:bold !important; }
    #showdo {
	font-size: 11px;
}
#showdo2 {
	font-size: 11px;
}
</style>




        <div id="datediv"  style="visibility: hidden"><? echo gmdate("Y-m-d",cheltime(time())); ?></div>
		
		
		<div id="online" style="online"></div>
<div id="fpkusername" style="position:relative; float:left; left:25; font-size:15;width:100px"><? echo $fpk_user_short; ?></div>
<div id="exit" style="position:relative; float:left; left:25; font-size:15"><a href="login.html"><font color="#999999"> - выход</font></a></div>
		<div id="bubu" style="visibility:hidden; height:0"></div>
		<div id="whoonline" style="whoonline; position:relative; margin-top:40px ">
		<br>
</div>
		
		<div id="datepicker" style="font-size:11; margin-top:28; margin-bottom:15"></div>


		
		
<ul class="tabsmini">
	<li name="do"><a id="now" href="#">Текущие</a></li>
	<li name="do"><a id="did" href="#">Выполнены</a></li>
	<li name="do"><a id="expire" href="#">Просрочены</a></li>
</ul>		
	<div id="showdo" style="margin-top:10"></div>

