


<div class="top_groupby">
</div>

<div class="accordion2">
</div>

<! Вывод только фамилий клиентов !>
<script id="clients-tmpl-mini" type="text/x-jquery-tmpl">
<div class="paneto" id="${ID}" groupby="${GROUPBY}">
<h3 id="${ID}" class="notloaded">
        <div id="i1" class="${NEXTDO.classdo} roundleft" hint="Дата и время дела: ${NEXTDO.date}">${NEXTDO.days}</div>
        <div class="roundleft" id="i2" hint="Сколько прошло дней с даты договора. Попробуйте меню ВИД.">${D1}</div>
        <div class="roundleft" id="i3" hint="Сколько прошло дней с даты первого контакта. Попробуйте меню ВИД.">${D2}</div>
        <div class="roundleft" id="i4" hint="Вероятность выдачи в этом месяце. Влияет на прогноз выдач за месяц."><img src="img/progres-${ICON2}.gif" name="${ID}" width="49px" height="9px" hspace="10" style="margin-top:5px;margin-left:6px;" class="icon2" id="${ID}" hint="Вероятность выдачи в этом месяце. Влияет на прогноз выдач за месяц. Попробуйте меню ВИД.">&nbsp;</div>
        <div class="progressbar" style="float:left;padding-top:5px;" id="i5"><img src="img/progres-${ICON}.gif" name="${ID}" width="49px" height="9px" hspace="10" class="icon" id="${ID}"></div>

<span class="text" hint="ФИО клиента">${TYPETIME}${FIOSHORT}&nbsp;</span><span class="iconselect">

       <div class="roundmodel" hint="Тип продукции. Закрашивается слева направо по мере прихода на склад." carid="${VIN}" title= "${STATUS}" style="background:${STATUSCOLOR}">${MODELSHORT}<font color=lightgray>${STATUSSHORT}</font></div>

       
<div class="iconsdo">
        {{each ICONS}}
        <img class="dotype" height=20px width=20px hint="Кликните чтобы добавить дело: ${$value.name}"  title="${$value.name}" src="./img/${$value.type}.png" hspace="6" vspace="0" align="right" style="opacity:${$value.opacity}"> 
        {{/each}}
        
</div>
<span class="outtype">${ADRESS}</span>        
<span class="files"><img src="img/file.png" style="opacity:${FILESOPACITY}">${FILES}</span>        
        <span class='rcost'>${RCOST}</span>

</h3>
</script>


<! Вывод подробностей при клике в ФИО по JSON !>
<script id="clients-tmpl" type="text/x-jquery-tmpl">



<div class="paneto" id="${ID}">
<h3 id="${ID}">
        <div id="i1" class="${NEXTDO.classdo} roundleft" hint="Дата и время дела: ${NEXTDO.date}">${NEXTDO.days}</div>
        <div class="roundleft" id="i2" hint="Сколько прошло дней с даты договора. Попробуйте меню ВИД.">${D1}</div>
        <div class="roundleft" id="i3" hint="Сколько прошло дней с даты первого контакта. Попробуйте меню ВИД.">${D2}</div>
        <div class="roundleft" id="i4" hint="Вероятность выдачи в этом месяце. Влияет на прогноз выдач за месяц."><img src="img/progres-${ICON2}.gif" name="${ID}" width="49px" height="9px" hspace="10" style="margin-top:5px;margin-left:6px;" class="icon2" id="${ID}" hint="Вероятность выдачи в этом месяце. Влияет на прогноз выдач за месяц. Попробуйте меню ВИД.">&nbsp;</div>
        <div class="progressbar" style="float:left;padding-top:5px;" id="i5"><img src="img/progres-${ICON}.gif" name="${ID}" width="49px" height="9px" hspace="10" class="icon" id="${ID}"></div>

<span class="text" hint="ФИО клиента">${TYPETIME}${FIOSHORT}&nbsp;</span><span class="iconselect">

       <div class="roundmodel" hint="Тип продукции. Закрашивается слева направо по мере прихода на склад." carid="${VIN}" title= "${STATUS}" style="background:${STATUSCOLOR}">${MODELSHORT}<font color=lightgray>${STATUSSHORT}</font></div>
       
<div class="iconsdo">
        {{each ICONS}}
        <img class="dotype" height=20px width=20px hint="Кликните чтобы добавить дело: ${$value.name}" title="${$value.name}" src="./img/${$value.type}.png" hspace="6" vspace="0" align="right" style="opacity:${$value.opacity}"> 
        {{/each}}
</div>
<span class="outtype">${ADRESS}</span>        
<span class="files"><img src="img/file.png" style="opacity:${FILESOPACITY}">${FILES}</span>        
        <span class='rcost'>${RCOST}</span>

</h3>



<div id="${ID}" class="pane">
<div class="accordion" id="${ID}">
<div class="clientformmini" id="${ID}" style="background:#e9e7e7 url(./img/do-${READONLY}.png) no-repeat right;" hint="Краткая информация о клиенте. Кликните чтобы редактировать.">
${FIO}<div class="progressbar" style="float:right;padding-top:5px;font-size:10px;color:#b8b8b8">Желание клиента:<img src="img/progres-${ICON}.gif" name="${ID}" width="49px" height="9px" hspace="10" class="icon ic" id2="${ID}"></div><br>
${PHONE1}<u>${PHONE11}</u> ${PHONE2}<u>${PHONE22}</u> <div class="progressbar" style="float:right;padding-top:5px;font-size:10px;color:#b8b8b8">Вероятность выдачи в этом месяце:<img src="img/progres-${ICON2}.gif" name="${ID}" width="49px" height="9px" hspace="10" class="icon2 ic2" id2="${ID}"></div>${PHONE3}<u>${PHONE33}</u> ${PHONE4}<u>${PHONE44}</u>&nbsp; ${ADRESS} <b>${EMAIL}</b><br>
<font color="gray">${VIN} ${COST}</font><br>
${COMMENT} [оплата: <b>${CREDITMANAGER}</b>]
<br>
откуда узнали: ${COMMERCIAL}<br>
Менеджер:${SHOWMANAGER}<span style="color:lightgray;float:right;padding-right:10px;margin-top:-20px;font-size:20px;opacity:${FILESOPACITY}">файлов: ${FILES} шт</span>
</div>
<div class="clientform" id="${ID}"  style="clientform">
<br>
<span style="padding-left:40px;">

<span class="cl1">ФИО:</span><input hint="ФИО клиента, пример 'Петров Иван Сергеевич'. Если набрать БОЛЬШИМИ БУКВАМИ, уменьшится само." name="FIO" type="text" id="FIO" value="${FIO}" size="50" placeholder="Петров Иван Сергеевич">
</span>

<span class="cl4">
        <select name="selectmanagerclient" hint="Выбор менеджера ответственного за данного клиента. Можно сменить в любое время." size="1"  style="width:200px" id="selectmanagerclient">
          <option selected>${MANAGER}</option>
		  <? echo mod_ShowUserlist2(" job LIKE '%неджер%'"); 
		  echo '<option>-----------</option>';
		  echo mod_ShowUserlist2(" job NOT LIKE '%неджер%' AND job NOT LIKE '%увол%'"); ?>
        </select>
        <span class="style4">- менеджер</span>

</span>
<div style="height:25px"></div>

<ul class="tabsmini" style="left:10px;">

	<li id2="client_tab1" class="current">
	<a href="#">Информация</a>
	</li>

	<li id2="client_tab3">
	<a href="#">Договор</a>
	</li>

	<li id2="client_tab2">
	<a href="#">Файлы</a>
	</li>

</ul>

<div id2="client_tab1" class="client_tab">
<br>
<span class="cl2">
<span class="cl1">Телефоны:</span>

<input hint="Поля для ввода номера телефона, пример: 89090888883" id="phone" name="PHONE1" type="text" value="${PHONE1}" size="20" placeholder="89121234567">
        <input hint="Имя владельца" id="phone1" name="PHONE11" type="text" value="${PHONE11}" size="10" placeholder="Сергей"><br>

        <input hint="Второе поле для телефона, если телефон уже есть в базе, откроется поиск." id="phone" name="PHONE2" type="text" value="${PHONE2}" size="20" placeholder="89121234567">
        <input hint="Имя владельца" id="phone1" name="PHONE22" type="text" value="${PHONE22}" size="10" placeholder="Сергей"><br>
        
        
        <input hint="Третье поле для телефона. Номера вводите с 8. Или 7 значные." id="phone" name="PHONE3" type="text" value="${PHONE3}" size="20" placeholder="89121234567">
        <input hint="Имя владельца" id="phone1" name="PHONE33" type="text" value="${PHONE33}" size="10" placeholder="рабочий"><br>
        
        
        <input hint="Четвертое поле для телефона. Не используйте разделители в номерах телефонов." id="phone" name="PHONE4" type="text" value="${PHONE4}" size="20" placeholder="89121234567">
        <input hint="Имя владельца" id="phone1" name="PHONE44" type="text" value="${PHONE44}" size="10" placeholder="домашний"><div style="height:20px"></div>
        

		<span class="cl1">Эл.почта:</span>
        <input hint="Электронная почта" id="phone1" name="EMAIL" type="text" value="${EMAIL}" size="35" placeholder="info@gmail.com">
        <div style="height:40px"></div>

		<span class="cl1">Инфо:</span>
<textarea hint="Комментарий по клиенту. Первые символы до пробела считаются типом продукции, если тип не выбран из падающего списка." name="COMMENT" cols="60" rows="6">${COMMENT}</textarea>      



</span>

<span class="cl3">
        <select hint="Выбор источника рекламы, благодаря которому клиент узнал о нас." name="selectcommercial"  style="width:200px" size="1" id="selectcommercial">
          <option selected>${COMMERCIAL}</option>
          <option>0 - Интернет</option>
          <option>1 - По рекомендации</option>
          <option>2 - Телевидение</option>
          <option>3 - Наружная реклама</option>
          <option>4 - Радио</option>
          <option>5 - Выставка</option>
          <option>6 - Газеты</option>
          <option>7 - Знакомые</option>
          <option>8 - BTL (презентации, акции)</option>
          <option>9 - Журналы</option>
          <option>a - Пользовался нашими услугами раньше</option>
          <option>Неизвестно</option>
        </select>
        <span class="style4">- откуда про нас узнали</span>
		<br>       
        <select hint="Выбор формы оплаты или конкретного финансового менеджера." name="selectcredit" size="1"  style="width:200px" id="selectcredit">
          <option selected>${CREDITMANAGER}</option>
		  <? echo mod_SHOWCREDITUSERLIST(); ?>
          <option>Предоплата</option>
          <option>Наличный расчет 100%</option>
          <option>Отсрочка платежа</option>
          <option>Оплата по факту поставки</option>
          <option>50% предоплата, 50% по отгрузке</option>
          <option>50% предоплата, 50% отсрочка</option>
          <option>Взаимозачёт</option>
          <option>Неизвестно</option>
        </select>
        <span class="style4">- вид оплаты</span>
        <div style="height:10px"></div>
        <input hint="Номер договора, накладной или заказа. Используется для поиска." name="VIN"  style="width:200px" type="text" value="${VIN}" size="30" placeholder="62847773"> <span class="style4">- 'Номер заказа или дог-ра'</span>
        <div style="height:10px"></div>
        
        
        
        <select name="selectmodel" hint="Выбор типа продукции. Если нет нужной, обратитесь к руководителю, он добавит." size="1"  style="width:200px" id="selectmodel">
          <option selected modelid="${MODELID}">${MODEL}</option>
		  <? echo mod_SHOWMODELSLIST(); ?>
        </select>
        <span class="style4">- тип продукции</span>
		<br>
        <select hint="Местонахождение продукции. Влияет на закрашивание информера типа слева направо." name="selectstatus" size="1" style="width:200px" id="selectstatus">
          <option selected>${STATUS}</option>
          <option>+ Наличие</option>
          <option>1 - Транзит от поставщика</option>
          <option>2 - У поставщика</option>
          <option>3 - Транзит к поставщику</option>
          <option>4 - Производство</option>
          <option>5 - Виртуальный</option>
          <option>? - Неизвестно</option>
        </select>
        <span class="style4">- где продукция</span>


        <div style="height:10px"></div>

        <input ${READONLY} hint="Продажная цена со скидками, например: 640000." name="PRICE" type="text" value="${COST}" size="10"><span class="style4"><b>руб</b> - продажная цена</span><br>
       				

</span>




</div>





<div id2="client_tab2" class="client_tab">
	<br>
	<div id="finder" client_id=${ID} style="margin:15px;margin-top:-3px;">
	</div>
</div>

<div id2="client_tab3" class="client_tab">
<br>
<span class="cl2">
<span class="cl1">Паспорт:</span>
        <input ${READONLY} hint="Серия паспорта" name="PAS1" type="text" value="${PAS1}" size="4" placeholder="74 56">
        <input ${READONLY} hint="Номер паспорта" name="PAS2" type="text" value="${PAS2}" size="6" placeholder="666888"><br>
        <input ${READONLY} hint="выдан Уфимским РУВД №556774 12.05.1978" name="PAS3" type="text" value="${PAS3}" size="55" placeholder="выдан Уфимским РУВД №556774">
        <span style="font-size:9px;color:gray">&nbsp;&nbsp;— выдан Уфимским РУВД №556774</span><br>
        <input ${READONLY} hint="Дата выдачи паспорта" id2="DATE" name="PAS4" type="text" value="${PAS4}" size="14" placeholder="12-03-2001">
        <span style="font-size:9px;color:gray">&nbsp;&nbsp;— дата выдачи паспорта</span>
        <div style="height:20px"></div>
        <span class="cl1">Адрес:</span>
        <input ${READONLY} hint="г.Челябинск, ул.Куйбышева д.37, кв.24" name="CLIENT_ADRESS" type="text" value="${CLIENT_ADRESS}" size="46" placeholder="г.Челябинск, ул.Куйбышева д.37, кв.24"><br>
        <span class="cl1">ДР:</span>
        <input ${READONLY} hint="05-12-2012" id2="DATE" name="CLIENTBIRTHDAY" type="text" value="${CLIENTBIRTHDAY}" size="14" placeholder="05-12-1978">
        
        <div style="height:20px"></div>

		<span class="cl1">Предоплата:</span>
		<input ${READONLY} hint="Предоплата: 80000." name="PREPAY" type="text" value="${PREPAY}" size="10" placeholder="80000"><span class="style4"><b>руб</b></span><br>
		<span class="cl1">Дата дог.:</span>
		<input ${READONLY} hint="2012-05-20" id2="DATE" name="DATE_CONTRACT" type="text" value="${DATE_CONTRACT}" size="14" placeholder="2012-06-13">
        <div style="height:20px"></div>
        
        
<div style="" id="${ID}">
        <input hint="Сохранение информации о клиенте." name="clientsave2" type="button" value="Сформировать договор поставки" style="width:400px;">
</div>        
</span>
<span class="cl3">
<br>
<br>
<br>
<br>
	<div style="display:none">
        <input type="checkbox" name="carpets" ${CARPETS}> Коврики<br>
        <input type="checkbox" name="mudguard" ${MUDGUARD}> Брызговики<br>
        <input type="checkbox" name="tech_1" ${TECH_1}> Пакет №1<br>
        <input type="checkbox" name="tech_2" ${TECH_2}> Пакет №2<br>
        <input type="checkbox" name="tires" ${TIRES}> Шины
   </div>
</span>		

</div>

<div id2="client_tab4" class="client_tab">
Данные по выдаче
</div>

<div style="margin-left:63px;margin-top:-10px;margin-bottom:15px;" id="${ID}">
        <input hint="Сохранение информации о клиенте." name="clientsave" type="button" value="Сохранить" style="width:200px;">
		<input name="clientclose" hint="Закрыть форму редактирования клиента без сохранения." style="margin-left:10px" type="button" value="Закрыть">        
        <input ${READONLY} hint="Удаление клиента и дел связанных с ним. Будте осторожны!" name="clientdelete" type="button" value="Удалить" style="float:right;margin-right:63px">
        
</div>


</div>

   {{each ALLDO}}
     {{tmpl($value) "#do-tmpl"}}
   {{/each}}
    
<div style="height:8px;"></div>

</div>






</div>



</div>



</script>







<script id="do-tmpl" type="text/x-jquery-tmpl">

<h4 id="${DOID}" style="background:#d3d3d3 url(./img/do-${DOREADONLY}.png) no-repeat right;"> 

<span class="${DATE1.classdo}" hint="Дата и время дела: ${DATE1.date}">${DATE1.days}</span>

 &nbsp; <span class="mystrike" style="${CHECKSTRIKE}"><span class="text"><span class="mystrike" style="${CHECKSTRIKE}">
 
 
<img src="img/${ICONTYPE.typepng}.png" hint="Иконка типа дела" width="20px" height="20px" hspace="5" align="absmiddle" style="opacity:${ICONTYPE.opacity}"> 
 
 
 </span> ${TEXT} <font color=gray hint="Кому это дело поручено">${SHOWSLAVE}</font> <font color=gray hint="Кто поручил это дело">${HOST}</font></span></span></h4>

<div class="pane2" id="${DOID}" id2="${ID}" style="pane2">


<table width="100%" border="0">

  <tr>
    <td width="110" valign="middle"></td>
    <td colspan="2" valign="top">
      <input ${DOREADONLY} name="Save" hint="Сохранить дело. Используется для назначения следующего дела." type="submit" value="Сохранить">
	  <input ${DOREADONLY} idd="${INPUTDONE.idd}" hint="Выполнить дело. Используется для сохранения и отметки что дело выполнено." name="Done" type="submit" id="notreadonly" value="${INPUTDONE.name}">
      <input ${DOREADONLY} name="Delete" type="submit" hint="Удаление дела. Будте осторожны!" value="Удалить">

	<span style="margin-left:55px;color:gray">Исполнитель:</span>
	<select ${DOREADONLY} id="SLAVE" hint="Выбор исполнителя, кому поручается данное дело. Дело попадает к нему в календарь." style="z-index:0;width:130px">
          <option selected>${SLAVE}</option>
		  <? echo mod_ShowUserlist2(" job NOT LIKE '%увол%'"); ?>
	</select>

    </td>
  </tr>

  <tr>
    <td width="110" valign="middle"><div align="right" style="color:gray">Дело:</div></td>
    <td colspan="2" valign="top"><input ${DOREADONLY} name="TEXT" hint="Наименование и содержание дела. Может быть любой длины." type="text" id="TEXT" value="${TEXT}" size="74" mytype="${TYPE}">
        
	<select ${DOREADONLY} hint="Выбор типа дела. Меняет иконку типа дела после сохранения." name="DOTYPE" id="DOTYPE"  style=" z-index:0">
	<option selected>${TYPE}</option>
	<? echo mod_SHOWDOTYPELIST(); ?>
	</select>	
		
	</td>
  </tr>
  <tr>
    <td width="110" valign="top"><div align="right" style="color:gray">Описание:</div></td>
    <td colspan="2" valign="top"><textarea ${DOREADONLY} hint="Скрытый дополнительный комментарий к делу. Использовать не желательно, так как скрыт основное время." name="DOCOMMENT" cols="70" rows="4" id="DOCOMMENT">${DOCOMMENT}</textarea></td>
  </tr>
  <tr>
    <td width="110" height="20" valign="middle"><div align="right" style="color:gray">Дата/время: </div></td>
    <td height="20">
	<input ${DOREADONLY} type="text" hint="Выбор даты и времени. Используйте клавиши на клавиатуре: вверх, вниз | вправо, влево." id="date${DOID}" name="defaultEntry" size="50"> 
    <input type="text" id="altdate${DOID}" name="AltEntry" size="30" value="${DODATE2}" style="visibility:hidden">
	</td>
    <td width="120" height="20" valign="top"></td>
  </tr>
</table>
</div>

</script>



<! Вывод левого меню !>
<script id="menu-tmpl-mini" type="text/x-jquery-tmpl">

  <li id="${id}" class="${current}"><a id="${id}" hint="${hint}" style="cursor:pointer" parent_id="${parent_id}" shortcaption="${short_caption}" class="a_leftmenu" childs="${childs}"><img src="img/${left_pic}" class="left-ico-1">${caption}
  
  <img src="img/right-arrow.png" class="right-ico-1" style="display:${right_arrow}">

  <div class="left-amount" id="vidan" hint="общая сумма" style="display:${right_amount1}">${right_amount1cnt}</div>

  <div class="left-amount-do" id="do" hint="Итого"  style="display:${right_amount2}">${right_amount1cnt}</div>
  <div class="left-amount-do2" id="do" hint="Итого" style="display:${right_amount2}">${right_amount2cnt}</div>
  
  </a></li>	

</script>

<! Вывод левого меню !>
<script id="leftdo-tmpl-mini" type="text/x-jquery-tmpl">
		  <li style="background:url(./img/${icontype}.png) no-repeat right;"><a href="#"doid="${doid}" clientid="${clientid}">${caption}<span style="color:#888"><br><span id="date_do" class="${date.classdo}-mini" style="opacity:0." hint="${date.date}">${date.days}</span>&nbsp;${fio} | ${model} ${manager} ${slave}</span></a>
		  </li>
</script>


<! Вывод автомобилей !>
<script id="cars-tmpl-mini" type="text/x-jquery-tmpl">
<div class="paneto2" id="893" groupby="${i21}">
<h3 id="893" class="notloaded"  id2="cars" style="height:19px;">
        <div id="i1" class="shortdatelong roundleft" hint="${i5}">${color}</div>
        

<span class="text" hint="${i8}"><font color=${gray}>${model}&nbsp;</font><span style="color:${colorstatus};font-size:8px;padding:0px">${i12}  ${i8}</span></span><span class="iconselect">

       <div class="roundmodel" clientid="${clients}" title= "${fio}" style="width:130px;background:${color2};opacity:${dogovor}">${clientsFIO}</div>
       
</div>

</h3>
<div class="pane" id="893">
<div class="accordion" id="${ID}">
<div class="carformmini" id="${ID}">
<table>
<tr><td align="right" style="color:gray">№ ABCnet:</td> <td>${i0}</td>  <td align="right" style="color:gray">Дата заказа:</td> <td>${i10}</td></tr> 
<tr><td align="right" style="color:gray">VIN:</td> <td><b>${i8}</b></td>  <td align="right" style="color:gray">Дата:</td> <td>${i15}</td></tr>
<tr><td align="right" style="color:gray">№ SIV:</td> <td>${i16}</td>  <td align="right" style="color:gray">Дата доставки:</td> <td>${i24}</td></tr>
<tr><td align="right" style="color:gray">Модель:</td> <td>${i2}</td>  <td align="right" style="color:gray">Дата продажи:</td> <td><font color="red">${i19}</font></td></tr>
<tr><td align="right" style="color:gray">Тип кузова:</td> <td>${i4}</td>  <td align="right" style="color:gray">FSO:</td> <td>${i20}</td></tr>
<tr><td align="right" style="color:gray">Цвет кузова:</td> <td>${i5}</td>  <td align="right" style="color:gray">№ счета:</td> <td>${i22}</td></tr>
<tr><td align="right" style="color:gray">Цвет салона:</td> <td>${i17}</td>  <td align="right" style="color:gray">Прошлый статус:</td> <td>${i11}</td></tr>
<tr><td align="right" style="color:gray">Тип мотора:</td> <td>${i6}</td>  <td align="right" style="color:gray">Текущий статус:</td> <td><b>${i12}</b></td></tr>
<tr><td align="right" style="color:gray">Трансмиссия:</td> <td>${i7}</td> <td align="right" style="color:gray">Местонахождение:</td> <td>${i21}</td> </tr>
<tr><td align="right" style="color:gray">Код модификации:</td> <td>${i9}</td> <td align="right" style="color:gray">Вид оплаты:</td> <td>${i23}</td></tr>
<tr><td align="right" style="color:gray">Опции:</td> <td>${i18}</td>  <td align="right" style="color:gray">ABCnet обновлен:</td> <td>${i40}</td></tr>
</table>
</div>
</div>
</div>
</div>
</script>



<! Вывод новостей заголовков!>
<script id="news-tmpl-mini" type="text/x-jquery-tmpl">
<div class="paneto2" id="${id1}" groupby="${groupby}">
<h3 id="${id1}" class="notloaded" id2="news">

{{html NEWSDATE}}

<span class="text" hint="${i8}"  style="opacity:${newsnew}">${titleshort}</font></span>&nbsp;<font color="lightgray" size="-1em">[${tagshort}]</font><span class="iconselect">

       <div class="roundmodel" clientid="${clientid}" hint= "${fio} - ( ${job} )" style="width:70px;background:${color2};opacity:${newsnew};">${fioshort}</div>

<div class="iconsdo">
</div>

       
</h3>
</script>


<! Вывод новостей полностью!>
<script id="news-tmpl" type="text/x-jquery-tmpl">
<div class="paneto2" id="${id1}" groupby="${groupby}">
<h3 id="${id1}"  id2="news">

{{html NEWSDATE}}

<span class="text" hint="${i8}  style="opacity:${newsnew}">${titleshort}</span>&nbsp;<font color="lightgray" size="-1em">[${tagshort}]</font><span class="iconselect">


       <div class="roundmodel" clientid="${clientid}" hint= "${fio} - ( ${job} )" style="width:70px;background:${color2};">${fioshort}</div>
       
<div class="iconsdo">
        <img class="dotypenews" type="del" height=20px width=20px hint="Кликните чтобы удалить новость" src="./img/delete.png" hspace="6" vspace="0" align="right" style="opacity:0.5;display:${canedit}">
        <img class="dotypenews" type="tonews" height=20px width=20px hint="Опубликовать в новостях" src="./img/news.png" hspace="6" vspace="0" align="right" style="opacity:0.5;display:${canedit}"> 
</div>

</h3>
<div class="pane" id="${id1}">
<div class="accordion" id="${id1}">
<div class="newsformmini" id="${id1}" canedit="${canedit}">
{{html text}}
<div style="opacity:0.2; font-size:10px;">{{html whoread2}}</div>
</div>
<div id="files" id2="${id1}">
{{html files}}
<div id='dropzone-info' style='width: 500px;background-color=#FFF' ></div>
</div>
<div class="newsform" id="${id1}">
<div id="editnews">
<table>
<tr style="font-size:11px;color:gray" height="9px">
<td align="left">Заголовок:</td><td align="left">Категория:</td><td align="left">Публиковать новость до:</td>
</tr>
<tr valign="top" height="20px">
<td width="45%"><input name="titlenews" type="text" value="${title}" style="width:100%;font-size:16px;-webkit-border-radius:5px;"> </td>
<td>
</td>
<td style="width:300px">
<input type="text" hint="Выбор даты и времени. Используйте клавиши на клавиатуре: вверх, вниз | вправо, влево." id="date${id1}" name="defaultEntry" style="width:230px;font-size:11px;-webkit-border-radius:5px;"> 
    <input type="text" id="altdate${id1}" name="AltEntry" size="30" value="${date2}" style="display:none">
</td>
</tr>
<tr>
<td>
        <select hint="Выбор темы новости (категории)." name="selecttypenews"  style="font-size:16px;-webkit-border-radius:5px;" size="1" id="selecttypenews">
          <option selected>${tag}</option>
          <? echo mod_ShowTypeNewslist(''); ?>
        </select>

</td>
</tr>
</table>
</div>
   <div class="editor" id="${id1}">{{html text}}</div>
   
</div>
</div>
</div>
</div>
</script>


<! Вывод файлов!>
<script id="files-tmpl" type="text/x-jquery-tmpl">
{{html files}}
<div id='dropzone-info' style='width: 500px;background-color=#FFF' ></div>
</script>
