<h4 id="#DOID#"><span class="mystrike" style="#CHECKSTRIKE#"> #DATE1# &nbsp; <span class="text"><span class="mystrike" style="#CHECKSTRIKE#">#ICONTYPE#</span> #TEXT#</span></span></h4>

<div class="pane2" id="#DOID#" id2="#ID#" style="pane2">
      <input name="Save" type="submit" value="Сохранить">
      #INPUTDONE#      
      <input name="Delete" type="submit" value="Удалить">

<table width="100%" border="0">
  <tr>
    <td width="110" valign="middle"><div align="right">Дело:</div></td>
    <td colspan="2" valign="top"><input name="TEXT" type="text" id="TEXT" value="#TEXT#" size="74">
	<select name="DOTYPE" id="DOTYPE"  style=" z-index:0">#SHOWDOTYPELIST#</select>	</td>
  </tr>
  <tr>
    <td width="110" valign="top"><div align="right">Описание:</div></td>
    <td colspan="2" valign="top"><textarea name="DOCOMMENT" cols="87" rows="4" id="DOCOMMENT">#DOCOMMENT#</textarea></td>
  </tr>
  <tr>
    <td width="110" height="20" valign="middle"><div align="right">Дата/время: </div></td>
    <td height="20">
	<input type="text" id="date#DOID#" name="defaultEntry" size="50"> 
    <input type="text" id="altdate#DOID#" name="AltEntry" size="30" value="#DODATE2#" readonly style="visibility:hidden">
	
	</td>
    <td width="120" height="20" valign="top"></td>
  </tr>
</table>
</div>