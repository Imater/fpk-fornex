<div class="paneto" id="#ID#" creditmanager="#CREDITMANAGER#" manager="#manager#">
<h3 id="#ID#">
<span class="progressbar"><img src="img/progres-#ICON#.gif" name="#ID#" width="49px" height="9px" hspace="10" class="icon" id="#ID#"></span>
<span class="text">#FIO# 11</span><span class="iconselect">#ICONSCLIENT#</span></h3>

<div id="#ID#" class="pane" style="">
<div class="accordion" id="#ID#">
<div class="clientformmini" id="#ID#" style="clientformmini">
#PHONE1# #PHONE2# #PHONE3# #PHONE4# #ADRESS#<br>
#COMMENT# [������: <b>#CREDITMANAGER#</b>]</div>
<div class="clientform" id="#ID#"  style="clientform">
  <table width="100%" border="0">
    <tr>
      <td valign="top"><div align="right" class="style4">���:</div></td>
      <td>
        <input name="FIO" type="text" id="FIO" value="#FIO#" size="50">

        <select name="selectmanagerclient" size="1" id="selectmanagerclient">
          <option selected>#MANAGER#</option>
		  #SHOWUSERLIST#
        </select>        <span class="style4">- ������������� ��������<span></td>
    </tr>
    <tr>
      <td valign="top"><div align="right" class="style4">��������:</div></td>
      <td>
        <input name="PHONE1" type="text" value="#PHONE1#" size="12">
        <input name="PHONE2" type="text" value="#PHONE2#" size="12">
        <input name="PHONE3" type="text" value="#PHONE3#" size="12">
        <input name="PHONE4" type="text" value="#PHONE4#" size="12">
        <select name="selectcredit" size="1" id="selectcredit">
          <option selected>#CREDITMANAGER#</option>
			#ShowCreditUserlist#
          <option>������ - ��������������</option>
          <option>�������� ������</option>
          <option>����������</option>
        </select>
        <span class="style4">- ����� ������ </td>
    </tr>
    <tr>
      <td valign="top"><div align="right" class="style4">�����:</div></td>
      <td>
        <input name="ADRESS" type="text" value="#ADRESS#" size="50">
        <input name="BIRTHDAY" type="text" value="#BIRTHDAY#" size="10">
        <span class="style4">- ���� �������� </span> </td>
    </tr>
    <tr>
      <td valign="top"><div align="right" class="style4">�����������:</div></td>
      <td>
        <textarea name="COMMENT" cols="50" rows="4">#COMMENT#</textarea>      </td>
    </tr>
    <tr>
      <td valign="top"></td>
      <td>
        <input name="clientsave" type="button" value="���������">
        <input name="clientdelete" type="button" value="�������">      </td>
    </tr>
  </table>
</div>
   #ALLDO#<br><br>
</div>
   

</div>



</div>