<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Регистрация в ФПК</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <link href="files/css/vrStyle.css" rel="stylesheet" type="text/css" />
	
	<script src="./src/js/jquery.js"></script>
    <script src="files/js/jquery.easing.min.1.3.js" type="text/javascript"></script>
    <script src="files/js/configScript.js" type="text/javascript"></script>
    <script src="./src/js/cookie.js"></script>

</head>
<body>
<?
 include "db.php";

 @ $db = mysql_connect ($config[mysql_host], $config[mysql_user], $config[mysql_password]);
 mysql_query("SET NAMES utf8");
 mysql_select_db('h116',$db);   

 if (!$db) { echo "Ошибка подключения к SQL :("; exit();}

?>

    <div id="vrWrapper">
        <div id="wr" class="wr" style="margin-left: -382px"> <!--382-->
            <div id="indicator"></div>
            <div class='loginBlock' id="signup" style="visibility: visible">
                <label for="email">Email:</label> <input id="email" type="text" class='textinput' />

                <label for="fio">Фамилия Имя Отчество:</label> <input id="fio" type="text" class='textinput' />
                <label for="birthday">День рождения (1980-11-31):</label> <input id="birthday" type="text" class='textinput' />
                <label for="job">Должность:</label>
                <select id="selectjob" name="selectjob">
                  <option>Генеральный директор</option>
                  <option>Директор</option>
                  <option>Руководитель ОП</option>
                  <option>Старший менеджер</option>
                  <option selected="selected">Менеджер</option>
                  <option>Кредитный эксперт</option>
                  <option>Логист</option>
                  <option>Бухгалтер</option>
                  <option>Маркетолог</option>
                  <option>Администратор</option>
                  <option>Другое</option>
                </select>
                <label for="email">Брэнд:</label>
                <select id="selectbrand" name="selectbrand">
                <?
		             echo mod_ShowBrandOption(1); 
                ?>
                </select>
                <label for="password">Пароль:</label> <input id="password" type="text" class='textinput' />
                <label for="passwordAgain">Пароль еще раз:</label> <input id="passwordAgain" type="text" class='textinput' />
                <div id="error0" class="error displaynone"></div>
                <div class='buttonDiv'>
                    <input id="registerButton" type="button" value="Зарегистрироваться" onclick="SignUp()" />
				</div>
                <div class='additional'>
                    <a href="index.html">Войти</a>
                </div>            
            </div>
            <div class='loginBlock' id="signin">
                <label for="email">Email:</label> <input id="loginEmail" type="text" class='textinput' />
                <label for="password">Пароль:</label> <input id="loginPass" type="password" class='textinput' />
                <div id="error1" class="error displaynone">
                </div>
                <div class='buttonDiv'>
                    <input id="loginButton" type="button" value="Войти" onclick="SignIn()" />
                </div>
                <div class='additional'>
                    <a href="signup.html">Зарегистрироваться</a>
                </div>
            </div>
            <div class='loginBlock' id="remindPass" style="visibility: hidden">
                <div class="description">
                    Чтобы получить пароль, введите для начала хотя бы email.
                </div>
                <label for="email">Email:</label> <input id="remindEmail" type="text" class='textinput' />
                <div id="error2" class="error displaynone"></div>
                <div id="message0" class="message displaynone"></div>
                <div class='buttonDiv'>
                    <input id="remindButton" type="button" value="Выслать пароль" onclick="RemindPassword()" />
				</div>
                <div class='additional'>
                    <a href="index.html">Войти</a> 
                    <a href="signup.html">Зарегистрироваться</a>
				</div>
            </div>
        </div>
</div>
</body>
</html>
