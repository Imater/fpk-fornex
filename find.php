<script language="JavaScript" 
 src="js/Js.js">
</script> 

<script>

	var dat1 = null;

	// Вызывается по тайм-ауту или при щелчке на кнопке.
	function doLoad(force) {
		// Получаем текст запроса из <input>-поля.
		var query = '' + document.getElementById('query').value;
		// Создаем новый объект JSHttpRequest.
		var req = new Subsys_JsHttpRequest_Js();
		// Код, АВТОМАТИЧЕСКИ вызываемый при окончании загрузки.
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					// Записываем в <div> результат работы. 
					document.getElementById('result').innerHTML = 
						'';
				}
				// Отладочная информация.
			  
			  $("#debug").hide();

				document.getElementById('debug').innerHTML = 
					req.responseText;

			  $("#debug").slideDown("fast");

				document.getElementById('debug2').innerHTML = 
					'';
			}
		}


		// Разрешаем кэширование (чтобы при одинаковых запросах
		// не обращаться к серверу несколько раз).
		req.caching = true;
		// Подготваливаем объект.
		req.open('POST', 'load.php?fpk_user=<? echo $fpk_user; ?>', true);
		// Посылаем данные запроса (задаются в виде хэша).
		req.send({ q: query, test:303, $fpk_user : "<? echo $fpk_user; ?>" });
	}

////////////////////////////////

	function doLoad2() {
		// Получаем текст запроса из <input>-поля.
		// Создаем новый объект JSHttpRequest.
		var req2 = new Subsys_JsHttpRequest_Js();
		// Код, АВТОМАТИЧЕСКИ вызываемый при окончании загрузки.

		req2.onreadystatechange = function() {
			if (req2.readyState == 4) {

				if (req2.responseJS) {
					// Записываем в <div> результат работы. 
					document.getElementById('showdo').innerHTML = 
						'';
				}
				// Отладочная информация.
				document.getElementById('showdo').innerHTML = 
					'';
				document.getElementById('showdo2').innerHTML = 
					req2.responseText;

			}
		}
		// Разрешаем кэширование (чтобы при одинаковых запросах
		// не обращаться к серверу несколько раз).
		req2.caching = true;
                // Подготваливаем объект.

		req2.open('GET', 'Do.php', true);
		query = document.getElementById('datediv').innerHTML;
		// Посылаем данные запроса (задаются в виде хэша).
		req2.send({ Date: query});
	}


////////////////////////////////

	function doClose() {
   
	document.getElementById('debug').innerHTML = '';
	}


	// Поддержка загрузки данных по тайм-ауту (1 секунда после
	// последнего отпускания клавиши в текстовом поле).
	var timeout = null;
	function doLoadUp() {
	        if (document.getElementById('query').value=='') $("#debug").hide();
		if (timeout) clearTimeout(timeout);
		if (document.getElementById('query').value=='') ; else timeout = setTimeout(doLoad, 500);

	}

	function doLoadUp2() {
		if (timeout) clearTimeout(timeout);
		timeout = setTimeout(doLoad2, 0);
	}

	function doClear() {
		if (document.getElementById('query').value=='Поиск') document.getElementById('query').value = '';
		document.getElementById('query').style.color = '#000000';
	}



</script> <!-- Форма --> <form onsubmit="return false"> 
<input type="text" id="query" style="font-size:20; color: #CCCCCC" value="Поиск" onMouseDown="doClear()"  onkeyup="doLoadUp()" size="30"> 
</form>
