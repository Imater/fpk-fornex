//глобальный массив для хранения редакторов
var editors = [];

//эта функция создает редактор для заданного элемента
function addEditor(item, id) {
	return new Ajax.InPlaceEditor(item,
		"scripts/updateitem.php",
		{
			formId: "listForm",
			okText: "Обновить",
			cancelText: "Отмена",
			highlightcolor: "#ffffff",
			size: "30",
			savingText: "Сохраняю...",
			callback: function(form, value) {
				return "value=" + value + "&id=" + id;
			}
		});
}

//эта функция добавляет элемент в список
function addItem() {
	//читаем введенное в форму значение
	var v = $('item_value').value;
	//формируем строку с параметрами запроса
	var pars = $H({value:v}).toQueryString();
	//выполняем запрос
	new Ajax.Request(
		"scripts/additem.php",
		{method:"post", parameters:pars, onSuccess:parseAddItemResponse}
	);
}

//эта функция вызывается если запрос на добавление нового
//элемента в список был выполнен
function parseAddItemResponse(transport) {
	var data = eval('(' + transport.responseText + ')');
	//проверяем были ли ошибки
	if (data.error_mes == null) {
		//удаляем сообщение об ошибке (если оно осталось после
		//предыдущего вызова)
		var errMes = $('err_mes');
		if (errMes != null) {
			Element.remove(errMes);
		}
		//удаляем строку "нет записей" (если она есть)
		var noItems = $('noItems');
		if (noItems != null) {
			Element.remove(noItems);
		}
		//вставляем полученный результат в конец списка
		var list = $('list');
		if (list == null) {
			var content = $('content');
			var newItem = new Insertion.Bottom(content, "<ul id=\"list\"></ul>");
			list = $('list');
		}
		//вставляем новый элемент в конец списка
		new Insertion.Bottom(list,
			"<li id='listNum_" + (editors.length) + "'><div class='itemNum'>" +
			(editors.length + 1) + "</div>" +
			"<div class='itemValue' " +
			"onclick='closeOtherEditors(" + editors.length +
			")' id='itemId_" + data.id + "'>" +
			data.value + "</div>" +
			"<a href='#' class='deleteLink' onclick='deleteItem(" +
			data.id + ")'><img src='css/images/delete.gif'" +
			"alt='Удалить' title='Удалить' /></a></li>");
		//создаем редактор для нового элемента и добавляем его в массив
		editors.push(addEditor("itemId_" + data.id, data.id));
		//подсвечиваем вставленный элемент
		var items = $$('#list li');
		new Effect.Highlight(items.last(),
			{startcolor:"#FDFFB9", endcolor:"#FFFFFF", duration:2.0});
	}
	else {
		//выводим сообщение об ошибке
		var form = $('add_item_form');
		new Insertion.After(form, "<div id=\"err_mes\">" +
			data.error_mes + "</div>");
	}
}

//эта функция удаляет элемент списка
function deleteItem(id) {
	var pars = $H({itemid:id}).toQueryString();
	new Ajax.Request(
		"scripts/delete.php",
		{method:"post", parameters:pars,
		onSuccess:function(transport) {
			var data = eval('(' + transport.responseText + ')');
			//удаляем элемент из списка
			var listElem = $('itemId_' + data.deletedId).parentNode.getAttribute('id');
			Element.remove(listElem);
			var listNum = listElem.substring(8);
			//обновляем номера у всех остальных записей
			var nodes = $$('#list li');
			nodes.each(
				function(node, index) {
					if (index >= listNum) {
						node.setAttribute('id', 'listNum_' + index);
						var innerNodes = $A(node.getElementsByTagName('div'));
						innerNodes[0].innerHTML = index + 1;
						innerNodes[1].setAttribute("onclick", "closeOtherEditors(" + index + ")");
					}
				}
			);
			//удаляем редактор из массива
			editors.splice(listNum,1);
		}}
	);
}

function closeOtherEditors(curEditor) {
	editors.each(
		function(editor, index) {
			if (index != curEditor) {
				editor.leaveEditMode();
			}
		}
	);
}
