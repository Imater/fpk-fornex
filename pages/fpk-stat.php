

<script type="text/javascript">
$(document).ready(jsDoFirst); 
</script>





<link href="/css/css.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {font-size: 10px}
-->
</style>


<div id="filterclient">
<table width="100%" border="0">
  <tr>
    <td width="70" align="center" valign="top"><img id="addclient" src="img/addclient.png" alt="�������� �������" hspace="5" align="absmiddle" style="opacity:0.8; cursor:pointer"></td>
    <td width="250" align="center" valign="top">	<div class="expandall"><u>���������� ���</u></div><div class="colapseall"><u>�������� ���</u></div></td>
    <td align="center" valign="top"><span class="style3">�������:
        <select name="selectmanager" size="1" id="selectmanager">
          <option selected><? echo iconv('UTF-8','windows-1251',$_COOKIE['mymanager']); ?></option>
          <option>�������� �������</option>
          <option>������� ��������</option>
          <option>��������� ������</option>
          <option>������ ������</option>
          <option>�������� ������</option>
          <option>������ �������</option>
          <option>���������� �������</option>
          <option>�������� ������</option>
          <option>������ �������</option>
          <option>������� �������</option>
          <option>��������� ��������</option>
          <option>���</option>
        </select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������:
<select name="selectmodel" id="selectmodel">
  <option>107</option>
  <option>207</option>
  <option>308</option>
  <option>3008</option>
  <option>4007</option>
  <option>BOXER</option>
  <option>PARTNER</option>
  <option selected>���</option>
</select>
    </span></td>
    <td width="230" align="center" valign="top"><span class="style3">�����������:
        <input name="textfilter" type="text" id="textfilter">
    </span></td>
  </tr>
</table>
</div>

<!-- the tabs -->
<ul class="tabs">
	<li><a id="statistic" href="#"><img src="img/statistic.png" hspace="5" align="absmiddle" style="opacity:0.2">����������</a></li>
	<li><a id="radar" href="#"><img src="img/radar.png" hspace="5" align="absmiddle" style="opacity:0.2">�����</a></li>
</ul>


<div class="accordion2">
</div>