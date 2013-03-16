<table width="100%%" border="0">
  <tr>
    <td valign="middle"><div align="right">Клиент:</div></td>
    <td valign="top">#DOEDITCLIENT#</td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Дело:</div></td>
    <td valign="top"><input name="TEXT" type="text" id="TEXT" value="#TEXT#" size="74"></td>
  </tr>
  <tr>
    <td width="200" valign="top"><div align="right">Описание:</div></td>
    <td valign="top"><textarea name="DOCOMMENT" cols="87" rows="7" id="DOCOMMENT">#DOCOMMENT#</textarea></td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Дата окончания: </div></td>
    <td valign="top"><input name="DATE2" style="z-index:0" type="text" id="f_date2" value="#DODATE2#" size="20">
<img src="img/cal.png" id="f_btn2">

</td>
  </tr>

  <tr>
    <td width="200" valign="middle"><div align="right">Дата выполнения: </div></td>
    <td valign="top"><input name="DOCHECKED"  style="z-index:0" type="text" id="f_date3" value="#DOCHECKED#" size="20"> <img src="img/cal.png" id="f_btn3">

    #CHECK#</td>
  </tr>

  <tr bgcolor="#CCCCCC">
    <td width="200" height="2" valign="middle"></td>
    <td height="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Тип дела: </div></td>
    <td valign="top"><select name="DOTYPE" id="DOTYPE"  style=" z-index:0">
      
     #SHOWDOTYPELIST#
    
    
    
    </select>    </td>
  </tr>
  <tr>
    <td valign="middle"><div align="right">Исполнитель:</div></td>
    <td valign="top"><select name="SELECTMANAGER"  style="z-index:0" id="SELECTMANAGER">
        
     #SHOWUSERLIST#
    
      </select>
    </td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Кто поручил: </div></td>
    <td valign="top"><select name="DOHOST"  style="z-index:0" id="DOHOST">
      
     #SHOWUSERLISTHOST#
    
    </select>
      Принял работу: #HOSTCHECK#      </td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Важность:</div></td>
    <td valign="top"><select name="DOIMPORTANT"  style="z-index:0" id="DOIMPORTANT">
      <option>#IMPORTANT#</option>
      <option>0</option>
      <option>25</option>
      <option>50</option>
      <option>75</option>
      <option>100</option>
    </select>    </td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Напомнить:</div></td>
    <td valign="top"><input name="DOREMIND" type="text" id="f_date4" value="#DOREMIND#" size="20"> <img src="img/cal.png" id="f_btn4"></td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Дата начала: </div></td>
    <td valign="top">


<input id="f_date1" name="DATE1" type="text" value="#DODATE#" size="20">
<img src="img/cal.png" id="f_btn1">



</td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Создано:</div></td>
    <td valign="top">#DOCREATED#</td>
  </tr>
  <tr>
    <td width="200" valign="middle"><div align="right">Изменено:</div></td>
    <td valign="top">#DOCHANGED#</td>
  </tr>
</table>



    <script type="text/javascript">//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "f_date1", "%Y-%m-%d %H:%M:%S");
      cal.manageFields("f_btn2", "f_date2", "%Y-%m-%d %H:%M:%S");
      cal.manageFields("f_btn3", "f_date3", "%Y-%m-%d %H:%M:%S");
      cal.manageFields("f_btn4", "f_date4", "%Y-%m-%d %H:%M:%S");

    //]]></script>
