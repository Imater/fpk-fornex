<script language="JavaScript" 
 src="js/Js.js">
</script> 

<script>

	var dat1 = null;

	// ���������� �� ����-���� ��� ��� ������ �� ������.
	function doLoad(force) {
		// �������� ����� ������� �� <input>-����.
		var query = '' + document.getElementById('query').value;
		// ������� ����� ������ JSHttpRequest.
		var req = new Subsys_JsHttpRequest_Js();
		// ���, ������������� ���������� ��� ��������� ��������.
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					// ���������� � <div> ��������� ������. 
					document.getElementById('result').innerHTML = 
						'';
				}
				// ���������� ����������.
			  
			  $("#debug").hide();

				document.getElementById('debug').innerHTML = 
					req.responseText;

			  $("#debug").slideDown("fast");

				document.getElementById('debug2').innerHTML = 
					'';
			}
		}


		// ��������� ����������� (����� ��� ���������� ��������
		// �� ���������� � ������� ��������� ���).
		req.caching = true;
		// �������������� ������.
		req.open('POST', 'load.php?fpk_user=<? echo $fpk_user; ?>', true);
		// �������� ������ ������� (�������� � ���� ����).
		req.send({ q: query, test:303, $fpk_user : "<? echo $fpk_user; ?>" });
	}

////////////////////////////////

	function doLoad2() {
		// �������� ����� ������� �� <input>-����.
		// ������� ����� ������ JSHttpRequest.
		var req2 = new Subsys_JsHttpRequest_Js();
		// ���, ������������� ���������� ��� ��������� ��������.

		req2.onreadystatechange = function() {
			if (req2.readyState == 4) {

				if (req2.responseJS) {
					// ���������� � <div> ��������� ������. 
					document.getElementById('showdo').innerHTML = 
						'';
				}
				// ���������� ����������.
				document.getElementById('showdo').innerHTML = 
					'';
				document.getElementById('showdo2').innerHTML = 
					req2.responseText;

			}
		}
		// ��������� ����������� (����� ��� ���������� ��������
		// �� ���������� � ������� ��������� ���).
		req2.caching = true;
                // �������������� ������.

		req2.open('GET', 'Do.php', true);
		query = document.getElementById('datediv').innerHTML;
		// �������� ������ ������� (�������� � ���� ����).
		req2.send({ Date: query});
	}


////////////////////////////////

	function doClose() {
   
	document.getElementById('debug').innerHTML = '';
	}


	// ��������� �������� ������ �� ����-���� (1 ������� �����
	// ���������� ���������� ������� � ��������� ����).
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
		if (document.getElementById('query').value=='�����') document.getElementById('query').value = '';
		document.getElementById('query').style.color = '#000000';
	}



</script> <!-- ����� --> <form onsubmit="return false"> 
<input type="text" id="query" style="font-size:20; color: #CCCCCC" value="�����" onMouseDown="doClear()"  onkeyup="doLoadUp()" size="30"> 
</form>
