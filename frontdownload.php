<h2>Скачать книги бесплатно:</h2>
<style>
.obl img
{
margin-left: 50px;
border-color: black;
border-width: 1px;
border-style: double;
	-moz-box-shadow:4px 4px 10px #53535c;
	-webkit-box-shadow:4px 4px 10px #53535c;
}
.download
{
padding-left: 30px;
cursor: pointer;
}
.download a
{
	color: darkblue;
    text-decoration: none;
}
.download:hover
{
background-color: lightyellow;
}
td
{
padding: 2px;
vertical-align: bottom;
}
td b
{
vertical-align: bottom;
}
td font
{
font-size: 12px;
}
table img
{
vertical-align:bottom;
margin-top:14px;
}
</style>

	<script src="src/js/jquery.js"></script>

<script  type="text/javascript">
function jsDoFirst()
{

$('#cnt[id2=m11]').load("book/do.php?countdownload=kovcheg-1&ext=pdf");
$('#cnt[id2=m12]').load("book/do.php?countdownload=kovcheg-1&ext=epub");
$('#cnt[id2=m13]').load("book/do.php?countdownload=kovcheg-1&ext=fb2");
$('#cnt[id2=m14]').load("book/do.php?countdownload=kovcheg-1&ext=mobi");

$('#cnt[id2=m21]').load("book/do.php?countdownload=kovcheg-2&ext=pdf");
$('#cnt[id2=m22]').load("book/do.php?countdownload=kovcheg-2&ext=epub");
$('#cnt[id2=m23]').load("book/do.php?countdownload=kovcheg-2&ext=fb2");
$('#cnt[id2=m24]').load("book/do.php?countdownload=kovcheg-2&ext=mobi");

$('#cnt[id2=m31]').load("book/do.php?countdownload=kovcheg-3&ext=pdf");
$('#cnt[id2=m32]').load("book/do.php?countdownload=kovcheg-3&ext=epub");
$('#cnt[id2=m33]').load("book/do.php?countdownload=kovcheg-3&ext=fb2");
$('#cnt[id2=m34]').load("book/do.php?countdownload=kovcheg-3&ext=mobi");

}
</script>


<script type="text/javascript">
$(document).ready(jsDoFirst); 
</script>    


<?
include "book/db.php";

$db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
mysql_query("SET NAMES utf8");
mysql_select_db($config[base_name],$db);   
if (!$db) { echo "Ошибка подключения к SQL :("; exit();}
?>


				<table width="100%">
				 <tr class="obl">
				 <td>
            	 <img src="book/images/1mini.png">
                 </td>
				 <td>
            	 <img src="book/images/2mini.jpg" >
				 </td>
				 <td>
            	 <img src="book/images/3mini.png">
				 </td>
				 </tr>
				
				 <tr class="obl">
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Ковчег I
                 </td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Ковчег II
                 </td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Ковчег III
                 </td>
				 </tr>

				 <tr height="150px">
				 <td>
                <div id="pdf" id2="1" class="download">
				<a href="book/download/kovcheg-1.pdf">
                <img src="book/images/pdf.gif"> <b>PDF</b> (3,2 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m11">0</span> раз</font><br>
                </div>
                
                <div id="epub" id2="1" class="download">
				<a href="book/download/kovcheg-1.epub">
                <img src="book/images/epub.jpeg" width="16px"> <b>epub</b> (2,7 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m12">0</span> раз</font><br>
                </div>
                
                <div id="fb2" id2="1" class="download">
				<a href="book/download/kovcheg-1.fb2">
                <img src="book/images/fb2.jpeg" width="16px"> <b>fb2</b> (1,8 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m13">0</span> раз</font><br>
                </div>
                
                <div id="mobi" id2="1" class="download">
				<a href="book/download/kovcheg-1.mobi">
                <img src="book/images/kindle.jpeg" width="16px"> <b>mobi</b> (3,9 МБ)<br>
				</a>
                <font color="lightgray">скачали <span id="cnt" id2="m14">0</span> раз</font><br>
                </div>
                
                 </td>
				 <td>
                <div id="pdf" id2="2" class="download">
				<a href="book/download/kovcheg-2.pdf">
                <img src="book/images/pdf.gif"> <b>PDF</b> (3,7 МБ)<br>
				</a>
                <font color="lightgray">скачали <span id="cnt" id2="m21">0</span> раз</font><br>
                </div>

                <div id="epub" id2="2" class="download">
				<a href="book/download/kovcheg-2.epub">
                <img src="book/images/epub.jpeg" width="16px"> <b>epub</b> (2,7 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m22">0</span> раз</font><br>
                </div>

                <div id="fb2" id2="2" class="download">
				<a href="book/download/kovcheg-2.fb2">
                <img src="book/images/fb2.jpeg" width="16px"> <b>fb2</b> (1,8 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m23">0</span> раз</font><br>
                </div>

                <div id="mobi" id2="2" class="download">
				<a href="book/download/kovcheg-2.mobi">
                <img src="book/images/kindle.jpeg" width="16px"> <b>mobi</b> (3,8 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m24">0</span> раз</font><br>
                </div>

                 </td>
				 <td>
                <div id="pdf" id2="3" class="download">
				<a href="book/download/kovcheg-3.pdf">
                <img src="book/images/pdf.gif"> <b>PDF</b> (3,0 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m31">0</span> раз</font><br>
                </div>

                <div id="epub" id2="3" class="download">
				<a href="book/download/kovcheg-3.epub">
                <img src="book/images/epub.jpeg" width="16px"> <b>epub</b> (1,2 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m32">0</span> раз</font><br>
                </div>

                <div id="fb2" id2="3" class="download">
				<a href="book/download/kovcheg-3.fb2">
                <img src="book/images/fb2.jpeg" width="16px"> <b>fb2</b> (1,2 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m33">0</span> раз</font><br>
                </div>

                <div id="mobi" id2="3" class="download">
				<a href="book/download/kovcheg-3.mobi">
                <img src="book/images/kindle.jpeg" width="16px"> <b>mobi</b> (1,6 МБ)<br>
                </a>
                <font color="lightgray">скачали <span id="cnt" id2="m34">0</span> раз</font><br>
                </div>

                 </td>
				 </tr>
				 

				</table>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<font>Предложите почитать эти книги своим друзьям:</font><br>
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj,moikrug,gplus"></div>


<?
$sqlnews1="select * from 1_books_comments WHERE book=0 ORDER by date DESC";
$sql = mysql_query($sqlnews1);

while(@$row=mysql_fetch_array($sql))
{
   $comment = str_replace("\n",'</p><p>',$row['comment']);

//   echo '<div class="comm"><p><b>'.$row['name'].':</b> '.$comment.'</p></div>';
}


?>
