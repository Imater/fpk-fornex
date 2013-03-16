//css("border", "2px dotted blue")
// url_ = document.location.search; n_sub=url_.indexOf('&client=')+8; url=url_.substring(n_sub); $(".pane[id="+url+"]").show();
var message_on=null;
var myalert= new Array();
var can_view=true;
var timeline_data=null;
var stopscroll = 0;
var page = 0;
var trtr=0;
var re_group = false;
var refrFiles=0;
var fontsize=10;
var searchtimeout='';
var reftFilesI=0;
var alertmesage1=null;
var alertmesage2=null;
var onfoc = null;
var onf = null;
var st = null;
var iamblur=0;
var mycol_grid="le_table_dg";
var nchat=0;
var tttt=0;
var myt=0;
var tr=0;
var mousemove=0;
var tl;
var si=0;
var si2=0;
var typn;
var wastab=0;
var main_did=0;
var menu_id=0;
var menu_current=0;
var adddo=0;
var ttr5=0;	
var user = $.cookie('fpk_id');

function jsShowCars()
{
  	$('*').undelegate("h6", "click").delegate("h6", "click", function(event) 
  	       {
  	       $(this).next(".m_about").slideToggle('fast');
  	       
  	       id = $(this).attr('myid');
  	       
  	       $(this).next(".m_about").find("#m_options").load("do.php?cars_right_opts="+id);
  	       
  	       return false;
  	       });

  	$('#m_cars_left').undelegate("li", "click").delegate("li", "click", function(event) 
  	       {
  	       $('#m_cars_left li').removeClass('li_selected');
  	       $(this).addClass('li_selected');
  	       jsShowCarsRight($(this).attr('class_id'));
  	       return false;
  	       });

	$("#m_left_output").load("do.php?cars_left=1");
	jsShowCarsRight(-1);
	
	$("#m_cars").show();
}

function jsShowCarsRight(id)
{
	$("#m_right_output").load("do.php?cars_right="+id,function(){
	   jsh5('group_by');
	   });
}


function jsh5( field )
{
	var old=null;

			$('#m_cars h6').each( function()
					{
					c_manager=$(this).attr(field);
					if (c_manager!=old) 
					   {
					    vvvv = $('<h2 id="h22">' + c_manager + '</h2>').insertBefore($(this));
					   }
					
					old = $(this).attr(field);
					});
	
}



function jsNewsKeysReg()
{
  	$('*').undelegate("img[class=dotypenews]", "click").delegate("img[class=dotypenews]", "click", function(event) 
  	       {
				event.stopPropagation();					
				doid = $(this).parents('div').parents('div').attr('id');
		if($(this).attr('type')=='del')
			if (confirm("Вы действительно хотите удалить новость №"+ doid +"?")) 
	      				{
				  		  var dataString = 'DeleteNews='+ doid;
		  				  $.ajax({type: "GET",url: "do.php", data: dataString});
	      				jsTitle('Новость удалена.');
	      				jsShowNews(1);
						jsMenu(menu_id);
	      				}  

		if($(this).attr('type')=='tonote')
			if (confirm("Вы действительно хотите переместить новость №"+ doid +" в 'Мои заметки'?")) 
	      				{
				  		  var dataString = 'NewsToNote='+ doid;
		  				  $.ajax({type: "GET",url: "do.php", data: dataString});
	      				jsTitle('Новость перемещена в Мои заметки.');
	      				jsShowNews(1);
						jsMenu(menu_id);
	      				
	      				}  

		if($(this).attr('type')=='tonews')
			if (confirm("Вы действительно хотите опубликовать новость №"+ doid +"?")) 
	      				{
				  		  var dataString = 'NoteToNews='+ doid;
		  				  $.ajax({type: "GET",url: "do.php", data: dataString});
	      				jsTitle('Новость опубликована.');
	      				jsShowNews(1);
						jsMenu(menu_id);
	      				
	      				}  

	      		return true;
	});


    //При клике в автомобили (h3) сворачиваем или разворачиваем содержимое
  	$('*').undelegate(".paneto2 h3[id2=cars]", "click").delegate(".paneto2 h3[id2=cars]", "click", function(event) 
        {
		event.stopPropagation();
		$(this).parent('.paneto2').next(".pane").slideToggle("fast"); 
		return false;
		});


    //При клике в новость (h3) сворачиваем или разворачиваем содержимое
  	$('*').undelegate(".paneto2 h3[id2=news]", "click").delegate(".paneto2 h3[id2=news]", "click", function(event) 
        {
		event.stopPropagation();				
		
        if ($(this).hasClass('notloaded')) 
           {
        	jsLoadNews($(this).attr('id'));
        	$(this).removeClass('notloaded');
           }

		$('* .pane[id!='+$(this).attr('id')+']').hide();

		$(this).next(".pane").slideToggle("fast"); 
		$(this).toggleClass("active"); 
		
		hei = $(this).next(".pane").height();
		
//		if ( hei>50 ) { $(this).next('.pane').remove(); $(this).remove(); if (!$("#notreaded h3").attr('id')) $("#notreaded").hide(); }
		
		//$(this).siblings("h3").removeClass("active");
		
		return false;
		});


	$("* #addcars").unbind('click').click(function()
		{ 
		jsShowCars();
		});



	$("* #addnews").unbind('click').click(function()
		{ 
		 manager = encodeURIComponent($('#selectmanager').html());
		  		var dataString = 'AddNews=1';
		  		$txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function()
						{ 
						jsShowNews(1);
						setTimeout( function()
						  {
						  jsLoadNews($txt.responseText);
						  jsMenu(menu_id);
						  }, 1500 );
						} });
		});


  	 $('*').undelegate("#files .delimg", "click").delegate("#files .delimg", "click", function(event) 
			{ 
			event.stopPropagation();
			doid = $(this).attr('href');
			id2 = $(this).attr('id2');

			if (confirm("Вы действительно хотите удалить файл?")) 
	      				{
				  		  var dataString = 'DeleteFile='+ doid;
				  		  console.log(dataString);
		  				  $.ajax({type: "GET",url: "do.php", data: dataString});
	      				jsTitle('Файл удален.');
						setTimeout( function() { jsRefreshFiles(id2) }, 600 );
	      				}  
			
			return false;
			});
			
			

  	 $('*').undelegate("#files .image", "mouseup").delegate("#files .image", "mouseup", function(event) 
						   	    { 
						   	    event.stopPropagation();
        	$('#front').remove();
        	$('#frontclose').remove();
        	im = $(this);
        	$('<div id="front" style="width:auto;cursor:pointer;"></div>').appendTo('.accordion2');
        	$('<div id="frontclose">X</div>').appendTo('.accordion2');

        	$('#front').click(function()
        	   { 
        	   src = $(this).children('img').attr('src'); 
        	   parentid = im.parents('#files').attr('id2');
        	   im = im.parent('td').next('td').children('img');
        	   src2 = im.attr('srcbig');
        	   if (!src2) { im = $('#files[id2='+parentid+'] .image:first'); src2 = im.attr('srcbig'); }
        	   $('#front').html('<img src="'+src2+'" width="800">');
        	   
        	   
        	   //alert(src + ' : ' + src2);
        	   });

        	$('#front').html('<img src="'+$(this).attr('srcbig')+'" width="800">');
        	return false;
								});
		//Сохраняю новость
  	 $('*').undelegate("* li.save", "mousedown").delegate("* li.save", "mousedown", function(event) 
						   	    { 
						   	    event.stopPropagation();
								id=$(this).parents('.newsform').attr('id');
								text = $('.editor[id='+id+']').elrte('val');

								sr2=$('.newsform[id='+id+'] input').serialize();   
								selecttypenews =  model = $('.newsform[id='+id+'] #selecttypenews option:selected').attr('value');

								sr=encodeURIComponent(text);   
								dataString="postnews="+sr+"&id="+id+"&"+sr2+"&selecttypenews="+selecttypenews;
							    $txt = $.ajax({type: "POST",url: "do.php", data: dataString, success: function() 
								   {
								   jsTitle('Новость сохранена');
								   jsLoadNews(id);
								   }});
								$('.newsformmini[id='+id+']').html(text);
						   	    $(".newsformmini[id="+id+"]").slideDown('slow');
						   	    $(".newsform[id="+id+"]").slideUp('slow');
						   	    $('.ac_results').remove();
						   	    return false;
						   	    });
	//Открываю новость для редактирования
  	 $('*').undelegate(".newsformmini", "dblclick").delegate(".newsformmini", "dblclick", function(event) 
						   {
						   	    event.stopPropagation();
						   	    if ($(this).attr('canedit') == 'none' ) { jsTitle('У вас нет прав редактировать эту новость. Обратитесь к руководителю.'); return false; }
						   	    
								doid = $(this).attr('id');
								jsOpenNewsEditor(doid);
								return false;
							});


}

function jsRefreshFiles(myid)
{
  
   $(".paneto2[id="+myid+"]:last #files").each(function()
		{
		pann=$(this);
		
		lnk = "do.php?ShowNews=1&id="+myid;

 $.getJSON( lnk ,function(data)
	{ 
			pann.html('');
			$('#files-tmpl').tmpl(data).appendTo(pann);
            $(".delimg").fadeIn(8000);
			
	});
							
		});

}


function jsOpenNewsEditor(doid)
{

						                    $(".newsform[id="+doid+"]").slideDown('slow');
						                    $(".newsformmini[id="+doid+"]").slideUp('slow');
						                    $(".delimg").fadeIn(8000);

											function format(mail) {
												return mail.name + ' ('+mail.cnt+')';
											}
											jsDropZone(doid);
/*
											$('#selecttypenews').autocomplete('do.php?ShowTypeNews=1', {
												multiple: false,
												dataType: "json",
												parse: function(data) {
													return $.map(data, function(row) {
														return {
															data: row,
															value: row.name,
															result: row.name
														}
													});
												},
												formatItem: function(item) {
													return format(item);
												}
											});
*/											
											
											
						                    
						   		var opts = {
						   			cssClass : 'el-rte',
						   		    lang     : 'ru',
						   			height   : 380,
						   			allowSource   : true,
						   			absoluteURLs   : false,
						   			toolbar  : 'complete',
						   			cssfiles : ['css/elrte-inner.css']
						   		}
						   		//alert(doid);
						   		$('.editor[id='+doid+']').elrte(opts);
								jsPrepareDate();



}


function jsDropZone(myid)
{
				$.fn.dropzone.uploadStarted = function(fileIndex, file){
					var infoDiv = $("<div></div>");
					infoDiv.attr("id", "dropzone-info" + fileIndex);
					infoDiv.html("upload started: " + file.fileName);
					
					var progressDiv = $("<div></div>");
					progressDiv.css({
						'background-color': 'orange',
						'height': '20px',
						'width': '0%'
					});
					progressDiv.attr("id", "dropzone-speed" + fileIndex);

					var fileDiv = $("<div></div>");
					fileDiv.addClass("dropzone-info");
					fileDiv.css({
						'border' : 'thin solid black',
						'margin' : '5px'
					});
					fileDiv.append(infoDiv);				
					fileDiv.append(progressDiv);				
					
					$("#dropzone-info").after(fileDiv);
				};
				$.fn.dropzone.uploadFinished = function(fileIndex, file, duration){
		        /////После загрузки файлов/////
		        setTimeout( function() { jsRefreshFiles(myid); }, 1000 );
		        setTimeout( function() { jsRefreshFiles(myid); }, 5000 );
		        setTimeout( function() { jsRefreshFiles(myid); }, 15000 );
				
				lnk="do.php?csv2="+file.fileName;
	 			$('#dropzone').load(lnk, function () 
	 			   {
	 			   jsTitle('Данные обработаны');
	 			   });

				
				
					$("#dropzone-info" + fileIndex).html("Загрузка завершена: " + file.fileName + " ("+getReadableFileSizeString(file.fileSize)+") in " + (getReadableDurationString(duration)));
					$("#dropzone-speed" + fileIndex).css({
						'width': '100%',
						'background-color': 'green' 
					});
				};
				$.fn.dropzone.fileUploadProgressUpdated = function(fileIndex, file, newProgress){
					$("#dropzone-speed" + fileIndex).css("width", newProgress + "%");
				};
				$.fn.dropzone.fileUploadSpeedUpdated = function(fileIndex, file, KBperSecond){
					var dive = $("#dropzone-speed" + fileIndex);

					dive.html( getReadableSpeedString(KBperSecond) );
				};
				$.fn.dropzone.newFilesDropped = function(){
					$(".dropzone-info").remove();
				};

				$("#files").dropzone({
					url : "do.php?csv-load-files="+myid,
					printLogs : true,
					uploadRateRefreshTime : 100,
					numConcurrentUploads : 2
				});

}

function jsLoadNews(id)
{
   $(".paneto2[id="+id+"]:last").each(function()
		{
		pan=$(this);
		
		lnk = "do.php?ShowNews=1&id="+id;
		console.log('loadnews:'+lnk);
 //setTimeout(doLoadUp2,70);	

 $.getJSON( lnk ,function(data)
	{ 
			pan.html('');
			$('#news-tmpl').tmpl(data).appendTo(pan);
			jsRoundNews();
			$('.newsform').hide();
		//jsh2('groupby');
	});
							
		});


}

//Окно настроек пользователя
function jsShowSettings()
{
 $(".accordion2").load("do.php?FirstSettings="+user);
					jsCollapse();
					jsh2('groupby');
}


function jsShowNews(id)
{
				$(".accordion2").html("");

 groupby = $('.top_groupby input:checked').attr('value');
 
 //alert(groupby);

 				lnk = "do.php?ShowNews="+id+"&groupby="+groupby;
 				console.info(lnk);
 				$.getJSON( lnk ,function(data)
					{
					$.each(data, function(i,data)
						{  
						//console.log(i);
						$('#news-tmpl-mini').tmpl(data).appendTo(".accordion2");
						});
					jsCollapse();
					jsh2('groupby');
					$('.accordion2').slideDown('fast');

					});


}


function jsShowGTD(id)
{
  $(".accordion2").load('do.php?ShowGTD=1');
}


function jsMakeDraggable()
{
$('h3').draggable({delay: "700", helper: "clone", opacity:"0.6"});

setTimeout( function()
  {
   $('h2').droppable({ hoverClass: 'droptome', drop: 
      function(dragobject,drag)
         {
         h3 = drag.draggable.attr('id');
         gr = $(this).html();
         
		 lnk = "do.php?h3="+h3+"&groupby=" + encodeURIComponent(gr);
		 console.log(lnk);
		 
		 $.getJSON( lnk ,function(data) 
		    {
			var current = $.cookie('menu-current');
		    jsSQLClients(current);
		    jsTitle('Статус изменен. Обновитесь'); 
		    } );
	         
         } });
  },1500);

}

function jsLeftDo()
{
 manager = encodeURIComponent($('#selectmanager').html()); 
 alldate = $('#datediv').html();

 type = $("* .left-bottom-top option:selected").attr('type');

 lnk = "do.php?leftdo="+type+"&manager="+manager+"&current="+menu_current+"&ALLDate="+ alldate;

 $.getJSON( lnk ,function(data)
	{
		    $('* .left-bottom-top option[type=today]').html('Сегодня (0 дел)');
		    $('* .left-bottom-top option[type=did]').html('Сделаны (0 дел)');
		    $('* .left-bottom-top option[type=past]').html('Просрочены (0 дел)');
		    $('* .left-bottom-top option[type=slave]').html('Поручено мной (0 дел)');
	$('.left_do li').remove();	
	j=0;
	if (!data) return false;

	$.each(data, function(i,data)
  		  {  
		  $('#leftdo-tmpl-mini').tmpl(data).appendTo(".left_do");
		  if (j==0)
		    {
		    if (data[0].cnt_past>0) $('* .left-bottom-top option[type=today]').html('Сегодня ('+data[0].cnt_today+'+'+data[0].cnt_past+' просроч.)');
		    else
		      $('* .left-bottom-top option[type=today]').html('Сегодня ('+data[0].cnt_today+' дел)');
		    $('* .left-bottom-top option[type=did]').html('Сделаны ('+data[0].cnt_did+' дел)');
		    $('* .left-bottom-top option[type=past]').html('Просрочены ('+data[0].cnt_past+' дел)');
		    $('* .left-bottom-top option[type=slave]').html('Поручено мной ('+data[0].cnt_slave+' дел)');
		    }
		  j=1;
		  });
    $('* .left_do li').css('font-size',fontsize+'px');
    if (type=='today')
    	{
    	height=0;
    	$('* .left_do li').each(function ()
     		 {
      		  name = $(this).find('#date_do').attr('class');
			  if (name=='shortdatepast-mini') height=height+$(this).height()+2;
			  last = $(this).height();
			  });
	    $(".left-bottom").scrollTop(height-last-10);
	    }
    //$('* .tabs li[id='+menu_current+']').addClass('current');
	});
}

function jsMenu(menu_parent)
{
 $.cookie('menu',menu_parent,{ expires: 30 });
 manager = encodeURIComponent($('#selectmanager').html()); 
 alldate = $('#datediv').html();
 
 lnk = "do.php?menu="+menu_parent+'&manager='+manager+'&current='+menu_current+'&ALLDate='+ alldate;

 if (menu_parent==0)
    {
    $('.home_back').hide();
    $('.home_menu').hide();
    }
   else
    {
//  $('.home_back').show();
    $('.home_menu').show();
    }
    


 $.getJSON( lnk ,function(data)
	{
	$('.tabs ul, .tabs li').remove();	

	$.each(data, function(i,data)
  		  {  
		  $('#menu-tmpl-mini').tmpl(data).appendTo(".tabs");
		  });
    //$('* .tabs li[id='+menu_current+']').addClass('current');
    radio=$('.tabs li[class=current] a').attr('id');
    
 height=$('#left-col').height()-$('#indented').height()-420;
 $('.left-bottom').css('height',height);
    
    
    
    
	var current = $.cookie('menu-current');
	$('* li a').removeClass('current');
	$('* li[id='+current+']').addClass('current');
	
    //jsSQLClients(current);

	});
	
}

function jsScroll()
{
		$('.tabs-right').height($('.tabs-left').height()+20);
		onResize();
		$('.tabs-left').animate({"margin-left": "0"}, 2000, function()
														{ 
														//$('.tabs-left').css("margin-left","253"); 
														});		
		$('.tabs-right').animate({"margin-left": "-253"}, 2000, function()
														{ 
														//$('.tabs-right').css("margin-left","0"); 
														});		
}

function last_msg_funtion()
{
 var myTimeOut = null;
 //считываю данные из фильтров
 manager = encodeURIComponent($('#selectmanager').html()); 
 model = $('#selectmodel option:selected').attr('value');
 filter =  encodeURIComponent($('#textfilter').attr('value'));
 if (!radio) radio=$('* li[class=current] a').attr('id');
 alldate = $('#datediv').html();
 groupby = $('.top_groupby input:checked').attr('value');
 order_after_group = $('.top_groupby input:checked').attr('field2');

 
 page = page + 1;

	    
 lnk = "do.php?ShowSQL="+radio+"&ALLDate="+alldate+"&manager="+manager+"&groupby="+groupby+"&order_after_group="+order_after_group+"&order2="+order2+"&filter="+filter+"&page="+page;
// console.log('main2:='+lnk);
 $.getJSON( lnk ,function(data)
	{ 
	 if(data!='')
	   {
	    $('h3:last').css("-webkit-border-bottom-left-radius","0px 0px").css("-webkit-border-bottom-right-radius","0px 0px");

		$.each(data, function(i,data)
			{  
			$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
			});
		jsCollapse();
		//$('* #h22').remove();
		jsh1('groupby');
		
	    
       }
      else { stopscroll = 1;  }
	    trtr=0;
	    $('* #loading').remove();
	});


}

function PlaySound(soundObj) {
//  var sound = document.getElementById(soundObj);
//  setTimeout( function () { sound.Play(); }, 100 );
}


function jsClearAlerts() {
			for (var key in myalert)
			  	   {
			  	   var val = myalert [key];
			  	   val.cancel();
			  	   }
}


function strip_tags( str ){ // Strip HTML and PHP tags from a string
    return str.replace(/<\/?[^>]+>/gi, '');
    }


function jsAlert(options, mytime, myuser, title, content) {
if (($('#on_off_on').attr('checked'))=='checked')
if ($.cookie('fpk_mobile')!=1)
 if (window.webkitNotifications.checkPermission() == 0) // 0 is PERMISSION_ALLOWED
  if (options == 'simple') {
  
  	console.log (myalert[myuser]);
  	
  	content=content.replace("<br>"," ");
  	
    if (myalert[myuser]) myalert[myuser].cancel();

    myalert[myuser] = webkitNotifications.createNotification(
        'img/chat1.png', title, strip_tags(content).replace("&nbsp;"," "));

	PlaySound("sound1");
	
    myalert[myuser].show();

	myalert[myuser].onclick = function()
	  {
      window.focus();
      myalert[myuser].cancel();
      }
	
    if (mytime>0) setTimeout(function(){ myalert[myuser].cancel(); },mytime);
        
  } else if (options == 'html') {
    return webkitNotifications.createHTMLNotification('http://ya.ru');
  }
}


function jsMenuFirst(menu_parent)
{
//	document.title='| Новое сообщение!';
//	setInterval(function()
//	  {
//	  $title=document.title;
	  
//	  if ($title=='| Новое сообщение!') document.title='/';
//	  if ($title=='/') document.title='— Новое сообщение!';
//	  if ($title=='— Новое сообщение!') document.title="\\";
//	  if ($title=="\\") document.title='| Новое сообщение!';
//	  },500);


$('#textfilter').autocomplete('do.php?textfilter=1', {
    multiple: false,
    dataType: "json",
    parse: function(data) {
    	return $.map(data, function(row) {
    		return {
    			data: row,
    			value: row.name,
    			result: row.name
    		}
    	});
    },
    formatItem: function(item) {
    	return format(item);
    }
});


$('*').undelegate("#turn_on_alerts", "click").delegate("#turn_on_alerts", "click", function(event) 
  {
  event.stopPropagation();										    
  $('#notreaded').slideUp('fast');
if ($.cookie('fpk_mobile')!=1)
  if (window.webkitNotifications.checkPermission() == 0) { // 0 is PERMISSION_ALLOWED
    // function defined in step 2

  jsAlert('simple',10000,0,'Всплывающее уведомление','Данное уведомление всплывает, даже если ФПК свернуто. Уведомление закроется само через 10 секунд.');


  } else {
if ($.cookie('fpk_mobile')!=1)
    {
    window.webkitNotifications.requestPermission();
    }
  }
  return false;
});


$('*').undelegate("#turn_on_alerts2", "click").delegate("#turn_on_alerts2", "click", function(event) 
  {
  event.stopPropagation();										    
if ($.cookie('fpk_mobile')!=1)
  if (window.webkitNotifications.checkPermission() == 0) { // 0 is PERMISSION_ALLOWED
    // function defined in step 2

  jsAlert('simple',10000,0,'Всплывающее уведомление','Данное уведомление всплывает, даже если ФПК свернуто. Уведомление закроется само через 10 секунд.');
  
  gv = window.extensions.getViews({type:"notification"});
  
  //gv = chrome;
  
  console.log(gv);

  } else {
if ($.cookie('fpk_mobile')!=1)
    window.webkitNotifications.requestPermission();
  }
  return false;
});


		$('#right-col').scroll(function(event){
		    event.stopPropagation();										    

	    $('* #loading').remove();

		    dd = $('.accordion2').height() - $('#right-col').height() + 38;
			if  ((stopscroll == 0) && (trtr == 0) && ( $('#right-col').scrollTop() > dd - 500 )) {
			   trtr=1;
			   
			   //$('<img id="loading" src="./images/loadingAnimation.gif">').appendTo('.accordion2');
			   
			   last_msg_funtion();
			   return false;
			}
			
		});



	//Подготовка календаря
	$.datepicker.setDefaults($.datepicker.regional['ru']);
    $('.daterange').hide();
	$('#datepicker').datepicker({ inline: true, onSelect: function(dateText, inst) 
		   { 
		    radio=$('* li[class=current] a').attr('id');

		   $('#datediv').html(dateText);
		   //doLoadUp2();
		   jsSQLClients(radio);
		   jsLeftDo();
		    //if(radio!='cup') jsShowClientsJson();
		   if ($('* li[class=current] a').attr('id')=='statistic')  tim1 = setTimeout(jsShowClientsJson, 0);
		   if ($('* li[class=current] a').attr('id')=='radar')  
				{ 
				tim1 = setTimeout(jsShowClientsJson, 0);  
				setTimeout( function() { $('.daterange').slideDown("fast"); $('.accordion2').slideDown("fast"); }, 0);
				}
					   }
				});
				
				$( "#datepicker" ).datepicker( "option", $.datepicker.regional[ 'ru' ] );				



	jsNewsKeysReg();

	 $('*').delegate("*[hint]","mouseover", function ()
	   {
	   hint = $(this).attr('hint');
	   if (hint) jsTitle(hint);
	   });

	 $('*').delegate("*[hint]","mouseout", function ()
	   {
	   setTimeout(jsTitle(''),0);
	   });

	 $('.opendo_icon').click(function(event)
	    {
 		event.stopPropagation();										    
		jsSQLClients(27);
	    return false;
	    });

  	 $('*').undelegate("#fast_do", "keyup").delegate("#fast_do", "keyup", function(event) 
		{
 		 event.stopPropagation();										    
		 if (event.keyCode=='13') 
		    {
			 var title = $("* #fast_do").val();
			 if (title) 
				{ 
				manager = encodeURIComponent($('#selectmanager').html()); 
				lnk="do.php?createdo="+encodeURIComponent(title)+"&after=15&manager="+manager;
				//console.log(lnk);
	 			$('#bubu').load(lnk, function ()
	 		    	{
	 		    	jsTitle('Создано дело "'+title+'" через 15 минут');
	 		    	jsLeftDo();
	 		    	});
	 		    }
	 		 }
	 	return false;
		});

  	 $("* #select_type_do").change(function(event) 
		{
			jsLeftDo();
			return false;
		});

  	 $('*').undelegate("* .paneto .roundmodel", "click").delegate("* .paneto .roundmodel", "click", function(event) 
		{
			event.stopPropagation();										
		    carid=$(this).attr('carid');
		    doid=$(this).attr('doid');
        	$('#front').remove();
        	$('#frontclose').remove();
        	$('<div id="front"></div>').appendTo('.accordion2');
        	$('<div id="frontclose">X</div>').appendTo('.accordion2');
        	$('#front').draggable();



 lnk = "do.php?ShowSQLcars="+radio+"&ALLDate="+alldate+"&manager="+manager+"&groupby="+groupby+"&order2="+order2+"&filter="+filter+"&vin="+carid;
 console.log(lnk);
 $.getJSON( lnk ,function(data)
	{
		$.each(data, function(i,data)
			{  
			console.log(i);
			$('#cars-tmpl-mini').tmpl(data).appendTo("* #front");
			});
			
	});



			return false;
		});

  	 $('*').undelegate(".top_groupby input", "click").delegate(".top_groupby input", "click", function(event) 
		{
			event.stopPropagation();										    
			var current = $.cookie('menu-current');
			re_group = true;
		    jsSQLClients(current);
		});

     //Клик в информер о брони автомобилей (вывод клиентов)
  	 $('*').undelegate("* .paneto2 .roundmodel", "click").delegate("* .paneto2 .roundmodel", "click", function(event) 
		{
			event.stopPropagation();										    
		    clientid=$(this).attr('clientid');
		    doid=$(this).attr('doid');
        	$('#front').remove();
        	$('#frontclose').remove();
        	$('<div id="front"></div>').appendTo('.accordion2');
        	$('<div id="frontclose">X</div>').appendTo('.accordion2');
//        	$('<div class="paneto" id='+clientid+'></div>').appendTo('#front');
        	$('#front').draggable();
        	
				//Вывод клиентов которые забронировали этот автомобиль
				 lnk = "do.php?ShowSQL=-5&ALLDate="+alldate+"&manager="+manager+"&groupby="+groupby+"&order_after_group="+order_after_group+"&order2="+order2+"&filter="+clientid+"&page=0";
				 page = 0;
				 console.log('main:='+lnk);
				 $.getJSON( lnk ,function(data)
					{
						$.each(data, function(i,data)
							{  
							//console.log(i);
							$('#clients-tmpl-mini').tmpl(data).appendTo("#front");
							});
						jsCollapse();
						jsh1('groupby');
					});


			
			return false;
		});


  	 $('*').undelegate("* .left_do a", "click").delegate("* .left_do a", "click", function(event) 
		{
			event.stopPropagation();										    
		    clientid=$(this).attr('clientid');
		    doid=$(this).attr('doid');
        	$('#front').remove();
        	$('#frontclose').remove();
        	$('<div id="front"></div>').appendTo('.accordion2');
        	$('<div id="frontclose">X</div>').appendTo('.accordion2');
        	$('<div class="paneto" id='+clientid+'></div>').appendTo('#front');
        	$('#front').draggable();
			jsRefreshClientJson(clientid,doid);
			return false;
		});

  	 jsLeftDo();
	 font = $.cookie('fontsize');
	 if (font>0) fontsize=font;
  	 $('*').undelegate(".font-plus", "click").delegate(".font-plus", "click", function(event) 
		{
		if ((fontsize<=40) && (fontsize>=3)) fontsize=Number(fontsize)+1;
		$.cookie('fontsize',fontsize,{ expires: 30 });
		$('* .left_do li').css('font-size',fontsize+'px');
		event.stopPropagation();										    
		return false;
		});

  	 $('*').undelegate(".font-minus", "click").delegate(".font-minus", "click", function(event) 
		{
		if ((fontsize<=41) && (fontsize>=5)) fontsize=Number(fontsize)-1;
		$.cookie('fontsize',fontsize,{ expires: 30 });
		$('* .left_do li').css('font-size',fontsize+'px');
		event.stopPropagation();										    
		return false;
		});


  	 $('*').undelegate(".home_menu, #top-left-menu", "click").delegate(".home_menu, #top-left-menu", "click", function(event) 
		{
		jsMenu(0);
		menu_id=0;
		//jsScroll();
		$('.home_title').html('ФПК');
		event.stopPropagation();										    
		});
		
  	 $('*').undelegate(".home_back", "click").delegate(".home_back", "click", function(event) 
		{
		parent_id = $(this).attr('id');
		jsMenu(parent_id);
		event.stopPropagation();										    
		});



	
	 	//Клик в пункт меню
  	$('*').undelegate(".tabs li", "click").delegate(".tabs li", "click", function(event) 
		{
			event.stopPropagation();										    

		    re_group = false;
			trtr = 0;
			stopscroll = 0;
			
			$(".tabs li").removeClass('current');
			$(this).addClass('current');
		    radio=$('* li[class=current] a').attr('id');
		    
		     $.cookie('menu-current',radio,{ expires: 30 });

		    
		    childs=$('* li[class=current] a').attr('childs');
			if (childs>0) 
			   { 
			   jsMenu(radio); 
			   shortcaption = $('* li[class=current] a').attr('shortcaption');
			   $('.home_title').html(shortcaption);
			   return false; 
			   }
			$('.roundfooter').css('background','#516f8f').removeClass('active');
			$("#textfilter").val('');
			
		    menu_current=radio;
		    menu_id=$(this).children('a').attr('parent_id');

			jsSQLClients(radio);
			
			$('.accordion2').show();			
			//setTimeout(doLoadUp2(),0);
	    });

    //Клик в круглую стрелку в левом меню    
  	 $('*').undelegate(".right-ico-1", "click").delegate(".right-ico-1", "click", function(event) 
		{
		event.stopPropagation();										    
		id = $(this).parent('a').attr('id');
		shortcaption = $(this).parent('a').attr('shortcaption');
		$('.home_title').html(shortcaption);
		menu_id=id;
		jsMenu(id);
		return false;
		});

	 $('.home_title').html('ФПК');
	 jsSms();
     jsReiting();


  	 $('*').undelegate("#abcnet", "click").delegate("#abcnet", "click", function(event) 
		{
		event.stopPropagation();	
		$('.accordion2').show().html('');
		$("<div style='width:85%;margin-top:64px;' ><div id='dropzone' style='align:center;padding:15px;background: #e9e7e7 url(../img/arrow-square.gif) no-repeat right -51px; width: 100%; height: 400px;-webkit-border-radius:10px;' ><center><font size=16px color=lightgray>Переместите файл  TXT из ABC-net<br>в данный контейнер<font></center></div> <div id='dropzone-info' style='width: 500px;background-color=#FFF' ></div></div>").appendTo('.accordion2');


				$.fn.dropzone.uploadStarted = function(fileIndex, file){
					var infoDiv = $("<div></div>");
					infoDiv.attr("id", "dropzone-info" + fileIndex);
					infoDiv.html("upload started: " + file.fileName);
					
					var progressDiv = $("<div></div>");
					progressDiv.css({
						'background-color': 'orange',
						'height': '20px',
						'width': '0%'
					});
					progressDiv.attr("id", "dropzone-speed" + fileIndex);

					var fileDiv = $("<div></div>");
					fileDiv.addClass("dropzone-info");
					fileDiv.css({
						'border' : 'thin solid black',
						'margin' : '5px'
					});
					fileDiv.append(infoDiv);				
					fileDiv.append(progressDiv);				
					
					$("#dropzone-info").after(fileDiv);
				};
				$.fn.dropzone.uploadFinished = function(fileIndex, file, duration){
				
				
				
				lnk="do.php?csv="+file.fileName;
	 			$('#dropzone').load(lnk, function () 
	 			   {
	 			   jsTitle('Данные обработаны');
	 			   });

				
				
					$("#dropzone-info" + fileIndex).html("Загрузка завершена: " + file.fileName + " ("+getReadableFileSizeString(file.fileSize)+") in " + (getReadableDurationString(duration)));
					$("#dropzone-speed" + fileIndex).css({
						'width': '100%',
						'background-color': 'green' 
					});
				};
				$.fn.dropzone.fileUploadProgressUpdated = function(fileIndex, file, newProgress){
					$("#dropzone-speed" + fileIndex).css("width", newProgress + "%");
				};
				$.fn.dropzone.fileUploadSpeedUpdated = function(fileIndex, file, KBperSecond){
					var dive = $("#dropzone-speed" + fileIndex);

					dive.html( getReadableSpeedString(KBperSecond) );
				};
				$.fn.dropzone.newFilesDropped = function(){
					$(".dropzone-info").remove();
				};
				$("#dropzone").dropzone({
					url : "do.php?csv-load=1",
					printLogs : true,
					uploadRateRefreshTime : 500,
					numConcurrentUploads : 2
				});



		return false;
		});


				










	 
}

function jsSQLClients(radio)
{
page = 0;
stopscroll = 0;
 var myTimeOut = null;
 //считываю данные из фильтров
 manager = encodeURIComponent($('#selectmanager').html()); 
 model = $('#selectmodel option:selected').attr('value');
 filter =  encodeURIComponent($('#textfilter').attr('value'));
 if (!radio) radio=$('* li[class=current] a').attr('id');
 alldate = $('#datediv').html();
 
  $('* #loading').remove();


 groupby='manager';
 order2='icon2';

/////////Панель новостей//////////
$('#notreaded').hide();
if ((user!=170) && (user!=64) && (radio!=31))
 setTimeout(function()
  {

 				lnk = "do.php?ShowNews=3";
 				$('#notreaded').html('Непрочитанные Вами новости:');
 				$.getJSON( lnk ,function(data)
					{
				    if (!data) return false;
					$.each(data, function(i,data)
						{  
						//console.log(i);
						$('#news-tmpl-mini').tmpl(data).appendTo("#notreaded");
						});

			$('#notreaded h3:first').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
            $('#notreaded h3:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
            $('<br><span id="make-all-read" style="padding:10px;cursor:pointer;text-decoration:underline">отметить все как прочитанные</span>').click(function()
              {  
		  		$('#bubu').load("do.php?make-all-news-read", function ()
					{
					 $('#notreaded').slideUp('fast');
					}); 
              }).appendTo('#notreaded');
					$('#notreaded').slideDown('fast');

					});



  },1000);

/////////////////
if ($.cookie('fpk_mobile')!=1)
 if (webkitNotifications.checkPermission() != 0)
   {
   setTimeout(function()
      {
 	  $('#notreaded').html("Необходимо включить уведомления:&nbsp;<input id='turn_on_alerts' hint='Включить в Google Chrome возможность всплывающих сообщений, даже если окно свернуто.' name='show_alert' type='button' value='Включить всплывающие уведомления Google Chrome' style=''><br><font color=gray size='1px'>После нажатия кнопки, нажмите <b>'Разрешить'</b></font>");
	   				$('#notreaded').slideDown('fast');
	   }, 5000);
   
   }




 lnk = "do.php?menu_groupby="+radio;
// console.log('group='+lnk);
 $.ajaxSetup({async: false}); //отключаем асинхронность, чтобы данные были готовы вовремя для таймлайн

 if (!re_group)
   {
   $.getJSON( lnk ,function(data)
	{
	if( data.groupby[0].name!='' )
	   {
		$('.top_groupby').html('групировать по полю: '); 
		var re_group = false;
		$.each(data.groupby, function (i,data) 
		   {
			$('<input type="radio" name="group1" value="'+data.field+'" field2="'+data.field2+'"'+data.checked+'><span>'+data.name+'</span>').appendTo('.top_groupby');
	   	   });
	   }
	  else
	   {
		$('.top_groupby').html(''); 
		var re_group = false;
	   }
	   
	 });
  }
////////////////
 groupby = $('.top_groupby input:checked').attr('value');
 order_after_group = $('.top_groupby input:checked').attr('field2');
 

 $.ajaxSetup({async: true}); //отключаем асинхронность, чтобы данные были готовы вовремя для таймлайн
	


 if ( radio==22 ) { jsShowCUP(); setTimeout( jsSmsCup(), 5000 ); return true; }
 if ( radio==23 ) { jsShowStat(); return true; }
 if ( radio==24 ) { jsShowStatMonth(); return true; }
 if ( radio==25 ) { jsShowTimeline(); return true; }
 if ( radio==26 ) { jsShowDay(); return true; }
 if ( radio==27 ) { jsShowDo(1); return true; } 
 if ( radio==17 ) { jsShowDo(2); return true; }
 if ( radio==18 ) { jsShowDo(3); return true; }
 if ( radio==30 ) { jsShowDo(4); return true; }
 if ( radio==28 ) { jsShowUsers(); return true; }
 if ( radio==29 ) { jsShowModels(); return true; }
 if ( radio==14 ) { jsSQLcars(radio); return true; }
 if ( radio==15 ) { jsSQLcars(radio); return true; }
 if ( radio==16 ) { jsSQLcars(radio); return true; }
 if ( radio==31 ) { jsShowNews(1); return true; }

 if ( radio==35 ) { jsShowStatManager(); return true; }
 if ( radio==36 ) { jsShowAdmin(); return true; }

 if ( radio==32 ) { jsShowReiting(manager); return true; }
 if ( radio==33 ) { jsShowNews(4); return true; }
 if ( radio==34 ) { jsShowSettings(); return true; } //Мои настройки


//Загружаю разом Всех клиентов - одна из главных функций
 $('.accordion2').html('');
 lnk = "do.php?ShowSQL="+radio+"&ALLDate="+alldate+"&manager="+manager+"&groupby="+groupby+"&order_after_group="+order_after_group+"&order2="+order2+"&filter="+filter+"&page=0";
 page = 0;
// console.log('main:='+lnk);
 $.getJSON( lnk ,function(data)
	{
		$.each(data, function(i,data)
			{  
			//console.log(i);
			$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
			});
		jsCollapse();
		jsh1('groupby');
	});

}

function jsShowReiting(manager)
{
 groupby = $('.top_groupby input:checked').attr('value');

 $('.accordion2').html('<h2>Итоговая сумма = <font color="lightgray" id="itogsum">0 т.р.</font></h2>');
 lnk = "do.php?ShowReiting="+manager+"&gr="+groupby;
// alert(lnk);
 page = 0;
 console.log('mainReiting:='+lnk);
 $.getJSON( lnk ,function(data)
	{
		$.each(data, function(i,data)
			{  
			//console.log(i);
			$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
			});
		jsCollapse();
		jsh1('groupby');
		//$('.paneto').hide();
		
		setTimeout( function() { $('#itogsum').html( $('.sumcost').attr('itogo') + ' т.р.' ); }, 1000 );
	});
	
}


function jsSQLcars(radio)
{
 var myTimeOut = null;
 //считываю данные из фильтров
 manager = encodeURIComponent($('#selectmanager').html()); 
 model = $('#selectmodel option:selected').attr('value');
 filter =  encodeURIComponent($('#textfilter').attr('value'));
 if (!radio) radio=$('* li[class=current] a').attr('id');
 alldate = $('#datediv').html();

 groupby='manager';
 order2='icon2';

//Загружаю разом Все автомобили
 $('.accordion2').html('');
 lnk = "do.php?ShowSQLcars="+radio+"&ALLDate="+alldate+"&manager="+manager+"&groupby="+groupby+"&order2="+order2+"&filter="+filter;
 console.log(lnk);
 $.getJSON( lnk ,function(data)
	{
		$.each(data, function(i,data)
			{  
			$('#cars-tmpl-mini').tmpl(data).appendTo(".accordion2");
			});
		jsCollapse();
		jshCars('groupby');
	});

}
function jshCars( field )
{
	var old=null;
	//$('h3:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
	clearTimeout(tr);
    radio=$('* li[class=current] a').attr('id');
 if (radio!='do')
	tr = setTimeout(function(){
			$('.paneto2').each( function()
					{
					c_manager=$(this).attr(field);
					if (c_manager!=old) 
					   {
					    vvvv = $('<h2 id="h22">' + c_manager + '</h2>').insertBefore($(this));
					   }
					
					old = $(this).attr(field);
					});
			//Закругляем углы в списке автомобилей


			$('h3:first').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
			$('h2').next('.paneto2').find('h3').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
            $('h2').prev('.pane').prev('.paneto2').find('h3').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
            $('h3:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");


            },300);
	
}


//Групировка Новостей
function jsh2( field )
{
	var old=null;
	//$('h3:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
	clearTimeout(tr);
    radio=$('* li[class=current] a').attr('id');
 if (radio!='do')
	tr = setTimeout(function(){
			$('.paneto2').each( function()
					{
					c_manager=$(this).attr(field);
					if (c_manager!=old) 
					   {
					    vvvv = $('<h2 id="h22">' + c_manager + '</h2>').insertBefore($(this));
					   }
					
					old = $(this).attr(field);
					});
			//Закругляем углы
            jsRoundNews();
            },300);
	
}


//Групировка
function jsh1( field )
{
	var old=null;
	//$('h3:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
	clearTimeout(tr);
    radio=$('* li[class=current] a').attr('id');
 if (radio!='do')
	tr = setTimeout(function(){
			$('.paneto').each( function()
					{
					c_manager=$(this).attr(field);
					if (c_manager!=old)
					   {
					    v = $(this).prevAll('#h22').attr('man') == c_manager;
					    if (!v) $('<h2 id="h22" man="'+c_manager+'">' + c_manager + '</h2>').insertBefore($(this));
					   }
					
					old = $(this).attr(field);
					});
			//Закругляем углы
            jsRound();
            },300);
	
}




function jsCollapse() //Загружаем клиентов и сворачиваем внутренности
 {
 radio=$('* li[class=current] a').attr('id');
 jsShowClientsPrepare();
 //Всё сворачиваем
 $(".pane").hide();	$(".pane2").hide(); $(".clientform").hide(); $(".clientformmini").show(); $(".newsform").hide();
 if (radio!=32) $(".rcost").hide();
 
 $("* #i1,#i2,#i3,#i4,#i5").hide();
 $("* #"+$.cookie('showi')).show();
// if (radio==12) jsh1('creditmanager');
// else
// if ( ($('#selectmanager').html()=='Все') && (radio!='statistic')  && (radio!='cup')  && (radio!='statistic2')) jsh1('manager');
// else {
// 	    if ((radio!="statistic2") && (radio!="cup")) 
// 	       {
// 	        $('#myh2').remove();
// 	        $('<h2 id="myh2">'+$('#selectmanager').html()+'</h2>').prependTo('.accordion2');
// 	       }
//		jsRound();
//      }
 jsPrepareDate(); //Подготовка полей для изменения времени и даты
 jsMakeDraggable();
 $('.accordion2').slideDown(600);

 
 }

function jsShowModels()
{
         $('.accordion2').html('<div style="margin-top:15px;margin-right:15px;margin-bottom:30px; height:80%;width:100%;font-size:120%;"><table id="le_table"></table><div id="le_tablePager" style="font-size:80%"></div><font color="white">* Сокр.Название - короткое название группы товара не более 7 букв (пример: "Electrod")<br>* 1-показывать - означает, отображать в "падающем списке" при выборе типа<br>* Вы не cможете удалить тип товара, если он используется в клиентах</font></div>');
        var lastSel;
	    var ls=jQuery("#le_table").jqGrid({
            url:'getmodel.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['id', 'Тип продукции', 'Сокр.Название', 'Средняя цена', '(1-показывать,0-скрыть)', 'Клиентов на этот тип'],
            colModel :[
                {name:'id', index:'id', width:30}
                ,{name:'model', index:'model', width:170, align:'left', editable:true, edittype:"text",search:true}
                ,{name:'short', index:'short', width:100, editable:true, edittype:"text"}
                ,{name:'cost', index:'cost', width:94, align:'right', editable:true, edittype:"text"}
                ,{name:'show', index:'show', width:160, align:'center', editable:true, edittype:"text"}
                ,{name:'clientscnt', index:'show', width:160, align:'center', editable:false, edittype:"text"}
                ],
            pager: jQuery('#le_tablePager'),
            rowNum:100,
            rowList:[5,10,30,100],
            height:"500px",
            sortname: 'model',
            sortorder: "asc",
            viewrecords: true,
            imgpath: 'jqgrid_edit/themes/basic/images',
            caption: 'Тип продукции',
            editurl: 'do.php?savemodel=1'
        }).navGrid('#le_tablePager',{}, //options
		{height:280,width:450,reloadAfterSubmit:true}, // edit options
		{height:280,width:450,reloadAfterSubmit:true}, // add options
		{reloadAfterSubmit:true}, // del options
		{}); 

}

function jsShowUsers()
{
         $('.accordion2').html('<div style="margin-top:15px;margin-right:15px;margin-bottom:30px; height:80%;width:100%;font-size:120%;"><table id="le_table" style="overflow-x: auto;"></table><div id="le_tablePager" style="font-size:80%"></div><font color="white">* Права доступа зависят от должности, можете изменить нажав на иконку карандаш в левом нижнем углу<br>* При увольнении ставьте должность: Уволен<br>* Вы не cможете удалить менеджера, если он завел клиентов</font></div>');
        var lastSel;
	   
	    var ls=jQuery("#le_table").jqGrid({
            url:'getdata.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['id', 'ФИО', 'Должность', 'Клиентов', 'Email', 'День рождения', 'Последний визит'],
            colModel :[
                {name:'id', index:'id', width:50}
                ,{name:'fio', index:'fio', width:260, align:'left', editable:true, edittype:"text",search:true}
                ,{name:'job', index:'job', width:190, editable:true, edittype:"select",editoptions:
                     {value:"Директор:Директор;Руководитель отдела продаж (директор):Руководитель отдела продаж (директор);Старший менеджер:Старший менеджер;Менеджер:Менеджер;Кредитный эксперт:Кредитный эксперт;Логист:Логист;Бухгалтер:Бухгалтер;Маркетолог:Маркетолог;Администратор:Администратор;Другое:Другое;Уволен:Уволен"}}
                ,{name:'clients', index:'clients', width:85, align:'left', editable:false, edittype:"text"}
                ,{name:'email', index:'email', width:280, align:'left', editable:true, edittype:"text"}
                ,{name:'birthday', index:'birthday', width:130, align:'left', editable:true, edittype:"text"}
                ,{name:'lastvizit', index:'lastvizit', width:150, align:'left', editable:false, edittype:"text"}
                ],
            pager: jQuery('#le_tablePager'),
            rowNum:100,
            rowList:[5,10,30,100],
            height:"500px",
            width:"500px",
            sortname: 'job',
            sortorder: "asc",
            
            viewrecords: true,
            imgpath: 'jqgrid_edit/themes/basic/images',
            caption: 'Данные пользователей ФПК',
            editurl: 'do.php?saveuser2=1'
        }).navGrid('#le_tablePager',{}, //options
		{height:280,width:600,reloadAfterSubmit:true}, // edit options
		{height:280,width:600,reloadAfterSubmit:true}, // add options
		{reloadAfterSubmit:true}, // del options
		{}); 

		$('#add_le_table, #search_le_table').remove();
}


function jsShowStatMonth()
{
	    		
                $('.accordion2').html('<div style="margin-top:15px;margin-right:15px;margin-bottom:30px; height:80%;width:100%;font-size:120%"><table id="le_table"></table><div id="le_tablePager" style="font-size:80%"></div></div>');
                
                $('#le_table').jqGrid({
                  url:'p1e1.php',
                  datatype: 'xml',
                  mtype: 'GET',
                  colNames:['Год','Месяц','<img src="img\\1vidacha.png" width="15px">', '<img src="img\\1dogovor.png" width="15px">','<img src="img\\1test-drive.png" width="15px">','<img src="img\\1vizit.png" width="15px">','<img src="img\\1zvonok.png" width="15px">'],
                  colModel :[
                    {name:'year', index:'year', width:15},
                    {name:'month', index:'date', width:30},
                    {name:'vd', index:'vd', width:7, align:"left", summaryType:'sum'},
                    {name:'dg', index:'dg', width:7, align:"left", summaryType:'sum'},
                    {name:'tst', index:'tst', width:7, align:"left", summaryType:'sum'},
                    {name:'vz', index:'vz', width:7, align:"left", summaryType:'sum'},
                    {name:'zv', index:'zv', width:7, align:"left", summaryType:'sum'}],

    grouping: true,
   	groupingView : {
   		groupField : ['year'],
   		groupColumnShow : [true],
   		groupText : ['<b>{0}</b>'],
   		groupCollapse : false,
		groupOrder: ['asc'],
		groupSummary : [true],
		showSummaryOnHide: true,
		groupDataSorted : true
   	},
   	viewrecords: true,
    footerrow: true,
    userDataOnFooter: true,
                  autowidth:true,
                  height:"100%",
                  hiddengrid:false,
                  //multiselect:true,
                  caption:"Статистика продаж",
                  pager: $('#le_tablePager'),
                  rowNum:365,
                  //shrinkToFit:true,
                  rowList:[10,20,30,100,365],
                  sortname: 'month',
                  sortorder: 'asc'
                });
}

function jsShowDay()
{
 	$('.accordion2').hide().html('');
	var    types=Array ("zv","vz","tst","dg","vd","out");
    var typename=Array ("Звонки","Визиты","Ком-предложения","Договора","Выдачи","OUT");
	for (i=0;i<types.length;i++)
	    {
	     //console.info(i+' : '+lnk);
		 lnk = "do.php?ShowSQL=888&json=1&manager="+manager+"&Model="+
		        model+"&Filter="+filter+"&Radio="+radio+"&ALLDate="+alldate+"&brand="+$('#brand').html()+"&type="+types[i];

		 $.ajaxSetup({async: false}); //отключаем асинхронность, чтобы данные были готовы вовремя для таймлайн
		 $.getJSON( lnk ,function(data)
				{
    			    $("<h2>"+typename[i]+":</h2>").appendTo(".accordion2");
					$.each(data, function(i,data)
						{  
						$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
						});
					jsCollapse();
				});
			 }
	$.ajaxSetup({ async: true });
	jsRound();
	$('.accordion2').slideDown('fast');
 	return true; 
}

function jsShowAdmin()
{
   $('.accordion2').load('do.php?cupAdmin=1&date='+$('#datediv').html(), function() 
       { 
		//if ($.cookie('fpk_mobile')==1) $('.roundfooter2[id=vd2]').remove();
		//setTimeout( jsShowPlotCUP(), 50);
        $('.pane-stat').hide();
        
    $('a[id=deltype]').unbind("click").click(function() 
            {
			event.stopPropagation();														
    	    id2 = $(this).attr('id2');

			if (confirm("Вы действительно хотите удалить событие №"+ id2 +"?")) 
	      				{
				  		  var dataString = 'DeleteAdmin='+ id2;
		  				  $.ajax({type: "GET",url: "do.php", data: dataString});
						  $(this).hide();
	      				}  


			});

    $('.roundfooter2').unbind("click").click(function() 
            {
			event.stopPropagation();														
    	    manager = $(this).parent('h5').attr('id');
			alldate = $('#datediv').html();
    	    id = $(this).attr('id');
    	    
//			alert(manager+' '+id);
		//добавить клиента администратором
			console.info(manager,id);
	var my_type_do;
	if(id=='zv') my_type_do = 2;
	if(id=='vz') my_type_do = 3;
	if(id=='tst') my_type_do = 6;
	
	setTimeout(function()
		{
		 admin = encodeURIComponent($('#selectmanager').html());

		  		var dataString = 'AddClient='+my_type_do+'&Admin='+admin+'&Manager='+manager;
		  		$txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function()
						{ 
						$txt2 = $.ajax({type: "GET",url: "do.php?UpdateIcons="+$txt.responseText });
						clientid = $txt.responseText;
						front_panel(clientid,-3);
						setTimeout(function(){ $('.clientformmini').click(); },500);
						setTimeout(function(){ $('.clientform input[name=FIO]').focus(); },600);
						//$('<div class="paneto" id="'+$txt.responseText+'"></div>').appendTo($(".accordion2"));
						//jsRefreshClientJson($txt.responseText,$(".paneto:last").attr('id'));


						} });
		},2000);



			$txt2 = $.ajax({type: "GET",url: "do.php?AddAdmin="+id+"&manager="+encodeURIComponent(manager)+"&mydate="+$('#datediv').html(),success:function(){
			
				jsShowAdmin();				
				}});
			});
			
           $(".accordion2 h5").unbind('click').click(function()
		        {
				
        		if ($(this).hasClass('notloaded')) 
          		 {
        			jsLoadStatistic($(this).attr('id'));
        			$(this).removeClass('notloaded');
           		 }
				$(this).next(".pane-stat").slideToggle("fast"); $(this).toggleClass("active"); $(this).siblings("h5").removeClass("active");

				});
				
				
				
			$('h5:first').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
            $('h5:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
        
        
        
	   });
}

function jsShowCUP()
{
   $('.accordion2').load('do.php?cup=1&date='+$('#datediv').html(), function() 
       { 
					jsInputClick();
       	
		//if ($.cookie('fpk_mobile')==1) $('.roundfooter2[id=vd2]').remove();
		setTimeout( jsShowPlotCUP(), 1000);
        $('.pane-stat').hide();
		$('#detstat').click(function()
		    {
	   		jsShowStat();
	   		});	

    $('.roundfooter2').unbind("click").click(function() 
            {
			event.stopPropagation();														
    	    brand = $(this).parent('h5').attr('id');
    	    brandtitle = $(this).parent('h5').attr('brandtitle');
    	    brandlogo = $(this).parent('h5').attr('logo');
			alldate = $('#datediv').html();
    	    id = $(this).attr('id');
    	    
    	    var old_brand = $.cookie('brand');
    	    
			$.cookie('brand',brand,{ expires: 30 });
			var but = $(this);
			
			$('.roundfooter2').css('background','#516F8F');
			
               if(!but.hasClass('active'))
                  {
					but.addClass('active');
					but.css('background','green');
					jsTitle('Данные за день: '+alldate);
				  }
				else 
				  {
				  but.removeClass('active');
				  alldate = alldate[0]+alldate[1]+alldate[2]+alldate[3]+alldate[4]+alldate[5]+alldate[6];
				  jsTitle('Данные за месяц: '+alldate);
				  but.css('background','#00db04');
				  }
			
			
				if(can_view)
	    	       {
			       $('#brand').html(brand);
			       $('#brandtitle').html(brandtitle);
			       $('#brand-ico').html('<img height="17px" src="'+brandlogo+'" style="padding-top:2px;">');
 				   }
		    	$('#selectmanager').html('Все');
		    	manager = 'Все'; 
                //jsAmount();
				$('#userlist').load('do.php?ShowManager=1');
	            $('.paneto, #h22').remove();
 				lnk = "do.php?ShowSQL=-1&json=1&Manager="+manager+"&Model="+model+"&Filter="+filter+"&Radio=statistic2&ALLDate="+alldate+"&radarrange=&type="+id+"&brand="+brand;
 				console.info('Roundfooter='+lnk);
 				$.getJSON( lnk ,function(data)
					{
	                jsSms();
					$.each(data, function(i,data)
						{  
						//console.log(i);
						$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
						});
					jsCollapse();
					jsh1('groupby');
					jsRound();
				if(!can_view)
				      {
				      if (brand!=old_brand) 
				        {
				 	    $.cookie('brand',old_brand,{ expires: 30 });
				 	    $('* h3').attr('cantopen','true');
				 	    }
				 	  }
					});
			  return false;
			});



           $(".accordion2 h5").unbind('click').click(function()
		        {
        		if ($(this).hasClass('notloaded')) 
          		 {
        			jsLoadStatistic($(this).attr('id'));
        			$(this).removeClass('notloaded');
        			//////////////////
           		 }
				$(this).next(".pane-stat").slideToggle("fast"); $(this).toggleClass("active"); $(this).siblings("h5").removeClass("active");
		
				});
				
				
				
			$('h5:first').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
            $('h5:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
       });

   return true;

}

function jsLoadStatistic2(h3_brand)
{
    alldate = $('#datediv').html();    
//    h3_brand="Тарасова Татьяна Викторовна";
    mytype = $('.pane-stat[id="'+h3_brand+'"] ul.tabsmini a[class=current]').attr('id2');    
    my_check=$('input[brand="mmm'+h3_brand+'"]').attr('checked');

  	gr = $('.pane-stat[id="'+h3_brand+'"] input[name=group1]:checked').attr('value');
    
	if (!my_check) 
	      { $mmm=1; } 
	else { $mmm=31; }
	 
	 
	if ($('.pane-stat3[id='+h3_brand+']').html()=='') 
	 $('.pane-stat3[id='+h3_brand+']').load("stat.php?brand="+h3_brand+"&d1=01.01.2012&d2=31.01.2012&m="+$mmm+"&type=1&alldate="+alldate+"&group="+gr);
	 
	 $("body").css("cursor", "wait");
	 $('.pane-stat3[id='+h3_brand+']').load("stat.php?brand="+h3_brand+"&d1=01.01.2012&d2=31.01.2012&m="+$mmm+"&type="+mytype+"&alldate="+alldate+"&group="+gr,function(){ $("body").css("cursor", "auto"); });

}


function jsLoadStatistic(h3_brand)
{
    
    jsLoadStatistic2(h3_brand);


$('.pane-stat[id='+h3_brand+'] input[name=group1]').click(function()
  {
  	   $('.pane-stat[id='+h3_brand+'] input[name=group1]').attr('checked',null);
  	   $(this).attr('checked','checked');
 	   jsLoadStatistic2(h3_brand);
  });



$('.pane-stat[id='+h3_brand+'] input[class=byday]').click(function()
  {
 	        jsLoadStatistic2(h3_brand);
  });

$("ul.tabsmini a").unbind('click').click(function()
            {
			$("ul.tabsmini a[brand="+h3_brand+"]").removeClass('current');
			$(this).addClass('current');
 	        jsLoadStatistic2(h3_brand);
            });

}


////Статистика подробная
function jsShowStatManager()
{
		var d1=$.cookie('d1');
		var d2=$.cookie('d2');

		if(!d1) d1='2011-01-01';
		if(!d2) d2='2012-01-01';

         $('.accordion2').html('<h6 style="color:white">Детальная статистика от <input id="d1" value="'+d1+'"> до <input id="d2" value="'+d2+'"></h6><div style="width:941px;heigth:auto;"><table id="le_table"></table><div id="le_tablePager" style="font-size:50%"></div></div><div id="placeholder" style="width:941px;height:400px;"></div>');
        var lastSel;
	   
	    var ls=jQuery("#le_table").jqGrid({
            url:'do.php?ShowStatManager=1&d1='+d1+'&d2='+d2+'&field=manager',
            datatype: 'json',
            mtype: 'POST',
            colNames:['id', 'Менеджер', 'Выдачи', 'Договора', 'Ком.пр.', 'Визиты', 'Звонки', 'Менеджер', 'Out', 'Расторжения', 'Длина выдачи', '% кредитов', 'Ср.цена'],
            colModel :[
                {name:'id', index:'id', width:30}
                ,{name:'line', index:'line', width:163, align:'left', editable:false, edittype:"text",search:true}
                ,{name:'vd', index:'vd', width:130,  align:'center', editable:false, edittype:"text"}
                ,{name:'dg', index:'dg', width:130,  align:'center', editable:false, edittype:"text"}
                ,{name:'tst', index:'tst', width:130, align:'center', editable:false, edittype:"text"}
                ,{name:'vz', index:'vz', width:130, align:'center', editable:false, edittype:"text"}
                ,{name:'zv', index:'zv', width:80, align:'center', editable:false, edittype:"text"}
                ,{name:'zv2', index:'zv2', width:80, align:'center', editable:false, edittype:"text"}
                ,{name:'out', index:'out', width:130, align:'center', editable:false, edittype:"text"}
                ,{name:'out2', index:'out2', width:130, align:'center', editable:false, edittype:"text"}
                ,{name:'days', index:'days', width:80, align:'center', editable:false, edittype:"text"}
                ,{name:'credits', index:'credits', width:80, align:'center', editable:false, edittype:"text"}
                ,{name:'cost', index:'cost', width:105, align:'center', editable:false, edittype:"text"}
                ],
            pager: jQuery('#le_tablePager'),
            rowNum:100,
            rowList:[5,10,30,100],
            height:"350px",
            width:"941px",
            autowidth:true,
            shrinkToFit:false,
            sortname: 'dg',
            sortorder: "asc",
            multiselect: true,
            viewrecords: true,
            imgpath: 'jqgrid_edit/themes/basic/images',
            caption: 'Статистика'
        }); 
        
		$( "#d1, #d2" ).datepicker({
			changeMonth: true,
			changeYear: true,
			onSelect: function(dateText, inst) 
			   {
			   var d1=$('#d1').val();
	   		   var d2=$('#d2').val();
			   $.cookie('d1',d1,{ expires: 30 });
			   $.cookie('d2',d2,{ expires: 30 });
	   		   setTimeout( ls.trigger("reloadGrid"), 100 ); 		

			   }

		});
        
        

  	 $('*').undelegate("#showclients", "click").delegate("#showclients", "click", function(event) 
  	     {
 		 event.stopPropagation();										
 		 $('.paneto, h2').remove();				

 		 lnk = "do.php?ClientEmpty=24&json=1&id="+$(this).attr('title');
 				//console.info(lnk);
 				$.getJSON( lnk ,function(data)
					{
					$.each(data, function(i,data)
						{  
						//console.log(i);
						$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
						});
					jsCollapse();
					});
   		});

//////////////////////////

//jsShowPlot('le_table_dg');
 
 $('th').click( function()
    {
	if ($(this).attr('id')!='le_table_cb') { jsShowPlot( $(this).attr('id') ); mycol_grid=$(this).attr('id'); }
    //alert();
    });
 
 $('*').undelegate(".cbox", "click").delegate(".cbox", "click", function(event) 
	{
//	event.stopPropagation();										    

	clearTimeout(tttt);
	tttt = setTimeout(function()
	    {
		var s;
		s = $("* #le_table").jqGrid('getGridParam','selarrrow');
		jsShowPlot( mycol_grid );
		},1500);
	});
//////////////////////////
}




////Статистика подробная
function jsShowStat()
{
		var d1=$.cookie('d1');
		var d2=$.cookie('d2');

		if(!d1) d1='2011-01-01';
		if(!d2) d2='2012-01-01';

         $('.accordion2').html('<h6 style="color:white">Детальная статистика от <input id="d1" value="'+d1+'"> до <input id="d2" value="'+d2+'"></h6><div style="width:941px;heigth:auto;"><table id="le_table"></table><div id="le_tablePager" style="font-size:50%"></div></div><div id="placeholder" style="width:941px;height:400px;"></div>');
        var lastSel;
	   
	    var ls=jQuery("#le_table").jqGrid({
            url:'do.php?ShowStat=1&d1='+d1+'&d2='+d2+'&field='+$('.top_groupby input:checked').attr('value'),
            datatype: 'json',
            mtype: 'POST',
            colNames:['id', 'Менеджер', 'Выдачи', 'Договора', 'Ком.пр.', 'Визиты', 'Звонки', 'Менеджер', 'Out', 'Расторжения', 'Длина выдачи', '% кредитов', 'Ср.цена'],
            colModel :[
                {name:'id', index:'id', width:30}
                ,{name:'line', index:'line', width:163, align:'left', editable:false, edittype:"text",search:true}
                ,{name:'vd', index:'vd', width:130,  align:'center', editable:false, edittype:"text"}
                ,{name:'dg', index:'dg', width:130,  align:'center', editable:false, edittype:"text"}
                ,{name:'tst', index:'tst', width:130, align:'center', editable:false, edittype:"text"}
                ,{name:'vz', index:'vz', width:130, align:'center', editable:false, edittype:"text"}
                ,{name:'zv', index:'zv', width:80, align:'center', editable:false, edittype:"text"}
                ,{name:'zv2', index:'zv2', width:80, align:'center', editable:false, edittype:"text"}
                ,{name:'out', index:'out', width:130, align:'center', editable:false, edittype:"text"}
                ,{name:'out2', index:'out2', width:130, align:'center', editable:false, edittype:"text"}
                ,{name:'days', index:'days', width:80, align:'center', editable:false, edittype:"text"}
                ,{name:'credits', index:'credits', width:80, align:'center', editable:false, edittype:"text"}
                ,{name:'cost', index:'cost', width:105, align:'center', editable:false, edittype:"text"}
                ],
            pager: jQuery('#le_tablePager'),
            rowNum:100,
            rowList:[5,10,30,100],
            height:"350px",
            width:"941px",
            autowidth:true,
            shrinkToFit:false,
            sortname: 'dg',
            sortorder: "asc",
            multiselect: true,
            viewrecords: true,
            imgpath: 'jqgrid_edit/themes/basic/images',
            caption: 'Статистика'
        }); 
        
		$( "#d1, #d2" ).datepicker({
			changeMonth: true,
			changeYear: true,
			onSelect: function(dateText, inst) 
			   {
			   var d1=$('#d1').val();
	   		   var d2=$('#d2').val();
			   $.cookie('d1',d1,{ expires: 30 });
			   $.cookie('d2',d2,{ expires: 30 });
	   		   setTimeout( ls.trigger("reloadGrid"), 100 ); 		

			   }

		});
        
        

  	 $('*').undelegate("#showclients", "click").delegate("#showclients", "click", function(event) 
  	     {
 		 event.stopPropagation();										
 		 $('.paneto, h2').remove();				

 		 lnk = "do.php?ClientEmpty=24&json=1&id="+$(this).attr('title');
 				//console.info(lnk);
 				$.getJSON( lnk ,function(data)
					{
					$.each(data, function(i,data)
						{  
						//console.log(i);
						$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
						});
					jsCollapse();
					});
   		});

//////////////////////////

jsShowPlot('le_table_dg');
 
 $('th').click( function()
    {
	if ($(this).attr('id')!='le_table_cb') { jsShowPlot( $(this).attr('id') ); mycol_grid=$(this).attr('id'); }
    //alert();
    });
 
 $('*').undelegate(".cbox", "click").delegate(".cbox", "click", function(event) 
	{
//	event.stopPropagation();										    

	clearTimeout(tttt);
	tttt = setTimeout(function()
	    {
		var s;
		s = $("* #le_table").jqGrid('getGridParam','selarrrow');
		jsShowPlot( mycol_grid );
		},1500);
	});
//////////////////////////
}


function jsShowPlotCUP()
{
  alldate = $('#datediv').html();
   $.getJSON( "do.php?ShowStatPlotCUP=dg&date="+alldate ,function(data)
	{
    var d = [];
   
	d.push(data);

    // first correct the timestamps - they are recorded as the daily
    // midnights in UTC+0100, but Flot always displays dates in UTC
    // so we have to add one hour to hit the midnights in the plot
    for (var i = 0; i < d.length-1; ++i)
      d[i][0] += 60 * 60 * 1000;
    // helper for returning the weekends in a period
    function weekendAreas(axes) {
        var markings = [];
        var d = new Date(axes.xaxis.min);
        // go to the first Saturday
        d.setDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7))
        d.setUTCSeconds(0);
        d.setUTCMinutes(0);
        d.setUTCHours(0);
        var i = d.getTime();
        do {
            // when we don't set yaxis, the rectangle automatically
            // extends to infinity upwards and downwards
            markings.push({ xaxis: { from: i-1 * 24 * 60 * 60 * 1000, to: i } });
            i += 60 * 60 * 1000;
        } while (i < axes.xaxis.max);

        return markings;
    }
    
    var options = {
        xaxis: { mode: "time" , monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"]},
        selection: { mode: "x" },
        grid: { markings: weekendAreas },
        points: {show:false},
        legend: {position: "sw", backgroundOpacity:0.4 }
    };
   // console.log(d);
    radio=$('* li[class=current] a').attr('id');
    if (radio == 22)
       {
        //$('#placeholder2, .paneto').remove();
//        alert($('#placeholder2').attr('id'));
        if (!$('#placeholder2').attr('id')) $('<div id="placeholder2" style="width:944px;height:200px;">').appendTo('.accordion2');
        var plot = $.plot($("#placeholder2"), data , options);
       }
     else   clearInterval(si2);


    });
  
}



function jsShowPlot(type)
{
   s = $("* #le_table").jqGrid('getGridParam','selarrrow');
   
   groupby = $('.top_groupby input:checked').attr('value');

   
   //alert(s);

   $.getJSON( "do.php?ShowStatPlot="+type+"&mans="+s+"&gr="+groupby ,function(data)
	{
    var d = [];
   
	d.push(data[0]);

    // first correct the timestamps - they are recorded as the daily
    // midnights in UTC+0100, but Flot always displays dates in UTC
    // so we have to add one hour to hit the midnights in the plot
    for (var i = 0; i < d.length-1; ++i)
      d[i][0] += 60 * 60 * 1000;
    // helper for returning the weekends in a period
    function weekendAreas(axes) {
        var markings = [];
        var d = new Date(axes.xaxis.min);
        // go to the first Saturday
        d.setDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7))
        d.setUTCSeconds(0);
        d.setUTCMinutes(0);
        d.setUTCHours(0);
        var i = d.getTime();
        do {
            // when we don't set yaxis, the rectangle automatically
            // extends to infinity upwards and downwards
            markings.push({ xaxis: { from: i-7 * 24 * 60 * 60 * 1000, to: i } });
            i += 30 * 24 * 60 * 60 * 1000;
        } while (i < axes.xaxis.max);

        return markings;
    }
    
    var options = {
        xaxis: { mode: "time" , monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"]},
        selection: { mode: "x" },
        grid: { markings: weekendAreas },
        points: {show:false},
        legend: {position: "nw"}
    };
    
    var plot = $.plot($("#placeholder"), data , options);
    
    var overview = $.plot($("#overview"), data, {
        series: {
            lines: { show: true, lineWidth: 1 },
            
            shadowSize: 0
        },
        legend: {show:false},
        xaxis: { ticks: [], mode: "time"},
        
        yaxis: { ticks: [], min: 0, autoscaleMargin: 0.1 },
        selection: { mode: "x" }
    });

    // now connect the two
    
    $("#placeholder").bind("plotselected", function (event, ranges) {
        // do the zooming
        plot = $.plot($("#placeholder"), data,
                      $.extend(true, {}, options, {
                          xaxis: { min: ranges.xaxis.from, max: ranges.xaxis.to }
                      }));

        // don't fire event on the overview to prevent eternal loop
        overview.setSelection(ranges, true);
    });
    
    $("#overview").bind("plotselected", function (event, ranges) {
        plot.setSelection(ranges);
    });
 });

}

function jsShowTimeline()
{
$('.accordion2').html('');
$('<div id="my-timeline" style="overflow-x:hidden; overflow-y:scroll; height:97%; margin-top:15px; border: 1px solid #aaa; font-size:9px"></div>').appendTo('.accordion2');

	var eventSource1 = new Timeline.DefaultEventSource();		
     //$('.accordion2').hide().html('');
	 $('#my-timeline').show();
	var bandInfos = [
       Timeline.createBandInfo({
         width:          "17%", 
         intervalUnit:   Timeline.DateTime.MONTH, 
         eventSource:    eventSource1,
         intervalPixels: 200,
		 overview : true
     	}),
     Timeline.createBandInfo({
         width:          "83%", 
         intervalUnit:   Timeline.DateTime.DAY, 
         eventSource:    eventSource1,
         intervalPixels: 33
     })
   ];
   bandInfos[1].syncWith = 0;
   bandInfos[1].highlight = true;


	tl = Timeline.create(document.getElementById("my-timeline"), bandInfos);
   	tl.loadJSON("do.php?Timeline=1&Manager="+ manager, function(json, url) {
   	    eventSource1.loadJSON(json, url);
   		});
   
	Timeline.OriginalEventPainter.prototype._showBubble = function(x, y, evt) {
        	$('#front').remove();
        	$('#frontclose').remove();
        	$('<div id="front"></div>').appendTo('.accordion2');
        	$('<div id="frontclose">X</div>').appendTo('.accordion2');
        	$('#front').draggable();
        	$('<div class="paneto" id='+evt.getDescription()+'></div>').appendTo('#front');
			jsRefreshClientJson(evt.getDescription(),0);
	}   
    eventSource1.loadJSON(timeline_data, '.'); // The data was stored into the 
    tl.layout(); // display the Timeline


	 $('.accordion2').slideDown('fast');
	 manager="NullManager";
}

function jsShowDo(version)
{
var vers=version;
   $('.accordion2').show().html("<div id='calendar' style='background:#FFF;margin-top:20px;margin-bottom:10px;padding:10px;-webkit-border-radius:9px;-webkit-box-shadow: #000 0px 5px 30px;color:#000;font-size:10px;margin-bottom:20px;'></div><div id='loading' style='display:none'>Загрузка...</div>");
		var date = new Date();
		var h = date.getHours();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
   
   
		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,basicWeek,basicDay'
			},
		
			editable: true,
			firstDay: 1,
			//height:700,
			defaultView:'agendaWeek',
			timeFormat: 'H(:mm) ',
			//height:'auto',
			axisFormat:'H(:mm):00',
			selectable:true,
			slotMinutes:15,
			defaultEventMinutes:30,
			firstHour:h,
			minTime:8,
			maxTime:23,
			'agendaDay':'H(:mm) ',
			agenda: 'H:mm{ - H:mm} ',
			
			events: "json-events-do.php?Manager="+manager+"&version="+vers,
			windowResize: function(view) {
			//alert($('#calendar').height());
        //$('#calendar').fullCalendar('option', 'height', $('#left-col').height()-60);
    },
			eventDrop: function(event, delta, minutedelta, allday) {
			  //console.log(event.id + ' was moved '+ delta +' days '+ minutedelta + ' minutes');
			  
			  if (allday) 
			     {
			     lnk="do.php?movedo="+event.id+"&days="+delta+"&minutes="+minutedelta+"&allday=1";
			     }
			     else
			     {
			     lnk="do.php?movedo="+event.id+"&days="+delta+"&minutes="+minutedelta+"&allday=0";
			     }
			   
	 		$('#bubu').load(lnk, function ()
	 		    {
	 		    jsTitle($('#bubu').html());
	 		    //jsTitle('Дело №'+event.id+' перенесли на '+ delta +' дней '+ minutedelta + ' минут');
	 		    jsLeftDo();
	 		    });

			  
			},
			eventClick: function(calEvent, jsEvent, view) {
			if(!calEvent.clientid) { if (confirm("Вы действительно хотите удалить дело №"+ calEvent.id +"?")) 
	      				{
				  		  var dataString = 'Delete='+ calEvent.id;
		  				  $.ajax({type: "GET",url: "do.php", data: dataString});
	  					calendar.fullCalendar('removeEvents', calEvent.id);

	      				jsTitle('Дело удалено.');
	      				jsLeftDo();
	      				}  
	      		return true;
	      		}
			
		        //alert('Event: ' + calEvent.clientid);
        		//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        		//alert('View: ' + view.name);

        		// change the border color just for fun
        		//$(this).css('border-color', 'red');
        	$('#front').remove();
        	$('#frontclose').remove();
        	$('<div id="front"></div>').appendTo('.accordion2');
        	$('<div id="frontclose">X</div>').appendTo('.accordion2');
        	$('#front').draggable();
        	$('<div class="paneto" id='+calEvent.clientid+'></div>').appendTo('#front');
			jsRefreshClientJson(calEvent.clientid,calEvent.id);

            },
			loading: function(bool) {
        //$('#calendar').fullCalendar('option', 'height', $('#left-col').height()-90);
				if (bool) $('#loading').hide();
				else $('#loading').hide();
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Название события:');
				if (title) { 
				manager = encodeURIComponent($('#selectmanager').html()); 
				lnk="do.php?createdo="+encodeURIComponent(title)+"&start="+encodeURIComponent(start.toUTCString())+"&end="+encodeURIComponent(end.toUTCString())+"&allday="+allDay+"&manager="+manager;
				//console.log(lnk);
	 			$('#bubu').load(lnk, function ()
	 		    	{
	 		    	jsTitle('Создано дело "'+title+'" на дату '+ start);
	 		    	jsLeftDo();
					calendar.fullCalendar('renderEvent',
						{
							id: $('#bubu').html(),
							title: title,
							start: start,
							end: end,
							className: 'did2',
							allDay: allDay
						},
						true // make the event "stick"
					);
	 		    	});


				}
				calendar.fullCalendar('unselect');
			}
			
			
		});
		
   
	   return true;
}			

function jsSmsCup()
{
 alldate = $('#datediv').html();
 lnk = "do.php?newscup=888&date="+alldate;
   $.getJSON( lnk ,function(data)
	{
	var texttocup='';
    var refreshPlot=0;
	$.each(data, function(i,data)
		{
		if(i=='%') i='ALL';
		rt = $('h5[id2=brand'+i+']');
		
        if (rt.children('.roundfooter2[id="dg"]').html() != data.amount[0] && (rt.children('.roundfooter2[id="dg"]').html()!='')) { rt.children('.roundfooter2[id="dg"]').css("background","#da5700"); n=1; refreshPlot=1; }
		rt.children('.roundfooter2[id="dg"]').html(data.amount[0]);

if (rt.children('.roundfooter2[id="vd"]').html() != data.amount[1] && (rt.children('.roundfooter2[id="vd"]').html()!='')) { rt.children('.roundfooter2[id="vd"]').css("background","#da5700"); n=1; refreshPlot=2; }
		rt.children('.roundfooter2[id="vd"]').html(data.amount[1]);

if (rt.children('.roundfooter2[id="out2"]').html() != data.amount[5] && (rt.children('.roundfooter2[id="out2"]').html()!='')) { rt.children('.roundfooter2[id="out2"]').css("background","#da5700"); n=1; refreshPlot=3; }
		rt.children('.roundfooter2[id="out2"]').html(data.amount[5]);


if (rt.children('.roundfooter2[id="zv"]').html() != data.amount[2] && (rt.children('.roundfooter2[id="zv"]').html()!='')) { rt.children('.roundfooter2[id="zv"]').css("background","#712115"); n=1;}
		rt.children('.roundfooter2[id="zv"]').html(data.amount[2]);

if (rt.children('.roundfooter2[id="vz"]').html() != data.amount[3] && (rt.children('.roundfooter2[id="vz"]').html()!='')) { rt.children('.roundfooter2[id="vz"]').css("background","#712115"); n=1;}
		rt.children('.roundfooter2[id="vz"]').html(data.amount[3]);

if (rt.children('.roundfooter2[id="tst"]').html() != data.amount[4] && (rt.children('.roundfooter2[id="tst"]').html()!='')) { rt.children('.roundfooter2[id="tst"]').css("background","#712115"); n=1;}		
		rt.children('.roundfooter2[id="tst"]').html(data.amount[4]);
		});

  if (refreshPlot!=0) //Если есть обновления, обновляем график и показываем сообщение
        { 
        setTimeout( jsShowPlotCUP(), 200); 
      
      alldate = $('#datediv').html();
      
temp_date = new Date();
day = temp_date.getDate();
month = temp_date.getMonth() + 1;
year = temp_date.getYear();
if (day < 10) {
day = "0" + day;
}
if (month <10) {
month = "0" + month;
}
      
	  mytoday = "2012-" + month + "-" + day;
	  
	  if (alldate == mytoday)
	    $("h5 .roundfooter2").each(function()
		  {
		  if ($(this).css('background')=='rgb(218, 87, 0)') 
		     {
		     if ($(this).attr('id')=='dg') 
		       { texttocup = 'Договора: '+$(this).html();
		       if ($(this).parent('h5').attr('id') != '%') jsAlert('simple',0,$(this).parent('h5').attr('id'),$(this).parent('h5').attr('brandtitle')+':',texttocup);

		       }
		     
		     }
		  });

        }


  if (n==1)
   window.onmousemove = function ()
      {
      setTimeout( function () { $('.roundfooter2, .roundfooter').css('background','#516f8f');
      
      setTimeout( function() { jsClearAlerts(); }, 1000 );
      
      
       }, 1000 );
      $('body').onmousemove = function () {};
      }



	});
	
  
  
  clearInterval(si2);
  si2=setInterval(jsSmsCup,10*60*1000);		

}


function jsSms()
{
 alldate = $('#datediv').html();

   $.getJSON( "do.php?news=888&date="+alldate ,function(data)
	{
   $("#rr1").html(data.amount[0]);	
   n=0;
   if ($("#r1").html() != data.amount[1] && ($("#r1").html()!='')) { $("#r1").css("background","#da5700"); n=1;}
   $("#r1").html(data.amount[1]);
   if ($("#r2").html() != data.amount[2] && ($("#r2").html()!='')) { $("#r2").css("background","#da5700"); n=1; }
   $("#r2").html(data.amount[2]);
   if ($("#r3").html() != data.amount[3] && ($("#r3").html()!='')) { $("#r3").css("background","#da5700"); n=1; }
   $("#r3").html(data.amount[3]);
   if ($("#r4").html() != data.amount[4] && ($("#r4").html()!='')) { $("#r4").css("background","#da5700"); n=1;}
   $("#r4").html(data.amount[4]);	
   if ($("#r5").html() != data.amount[5] && ($("#r5").html()!='')) { $("#r5").css("background","#da5700"); n=1;}
   $("#r5").html(data.amount[5]);	

   if ($("#r8").html() != data.amount[8] && ($("#r8").html()!='')) { $("#r8").css("background","#da5700"); n=1;}
   $("#r8").html(data.amount[8]);	

   $("#r6").html(data.amount[6]);
   
   $("#r6").attr('title',data.amount[7]);

  if (n==1)
   window.onmousemove = function ()
      {
      setTimeout( function () { $('.roundfooter').css('background','#516f8f') }, 1000 );
      window.onmousemove = function () {};
      }

	});
	
  
  
  clearInterval(si);
  si=setInterval(jsSms,5*60*1000);		

}

function jsAmount()
{
 return true;
 manager = encodeURIComponent($('#selectmanager').html()); 
 model = $('#selectmodel option:selected').attr('value');
 radio=$('* li[class=current] a').attr('id');
 alldate = $('#datediv').html();
 filter='';
 jsSms();
   $(".left-amount").each(function()
		{
		var radio;
		radio=$(this).attr("id");
		//console.log(radio);
		
		 lnk = "do.php?ClientEmpty=24&json=2&Manager="+manager+"&Model="+model+"&Filter="+filter+"&Radio="+radio+"&ALLDate="+alldate+"&radarrange=";
        //console.info('Amount = '+lnk);
		$(".left-amount[id="+radio+"]").load(lnk);
		});
		
}

function jsTitle(title)
{
setTimeout( function()
             {
			  if ( $('.title').html() != ('<b>'+title+'</b>') ) $('.title').css("opacity",'0').html('<b>'+title+'</b>').animate({"opacity": '0.7'}, 1000, function()
								{ 
								});
			 }, 200);

}

function jsReiting()
{
 alldate = $('#datediv').html();
 manager = encodeURIComponent($('#selectmanager').html()); 

lnk = "do.php?reiting=1&date="+alldate+"&days=7&manager="+ manager;

$('.reiting1').load(lnk);
lnk = "do.php?reiting=2&date="+alldate+"&days=7&manager="+ manager;
$('.reiting2').load(lnk);

lnk = "do.php?reiting=3&date="+alldate+"&days=7&manager="+ manager;
$('#reiting3').load(lnk,function()
    {
    
	lnk = "do.php?reiting=3&date="+alldate+"&days=30&manager="+ manager;
	$('#bubu2').load(lnk, function()
	    {
		$($('#bubu2').html()).appendTo('#reiting3');
		
		lnk = "do.php?reiting=3&date="+alldate+"&days=888&manager="+ manager;
		$('#bubu2').load(lnk, function()
	    	{
			$($('#bubu2').html()).appendTo('#reiting3');
   			});
		
   		});
    
    
    
    });

}

function front_panel(clientid,doid)
{
			if (!clientid) return false;
        	$('#front').remove();
        	$('#frontclose').remove();
        	$('<div id="front"></div>').appendTo('.accordion2');
        	$('<div id="frontclose">X</div>').appendTo('.accordion2');
        	$('<div class="paneto" id='+clientid+'></div>').appendTo('#front');
        	$('#front').draggable();
			jsRefreshClientJson(clientid,doid);

}

function jsDoFirst() //Исполняется только один раз
 {
//	jsShowCars();
	
    //$('li').removeClass('current');
    
    //if ((user==11) || (user==18) || (user==64)) $('#cup').addClass('current');
    //else $('#lidogovors').addClass('current'); 

    //$('input[title!=""]').hint();
    
    
	$('*').undelegate("#m_close_cars", "click").delegate("#m_close_cars", "click", function()
        	   { 
        	   $("#m_cars").hide();
        	   return false;
        	   });
    
    
	$('*').undelegate("#frontclose", "click").delegate("#frontclose", "click", function()
        	   { 
        	   $('* #front').slideUp(400,function(){ $(this).remove(); });
        	   $('* #frontclose').remove();
        	   });

    
	$('*').undelegate("#clear_history", "click").delegate("#clear_history", "click", function()
	      {
		  var chat_id=$(this);
	      chat_id.parents('#chattext').html('<center>окно очищено</center>');
	      return false;
	      });
    
	$('*').undelegate(".chat-bubble", "click").delegate(".chat-bubble", "click", function()
	      {
	      
			event.stopPropagation();
			
	        clientid = $(this).children('a').attr('client_id');
		    doid=$(this).attr('doid');

			front_panel(clientid,doid);
													    
			return false;
	      
	      });
    
    
    
     $('#on_off_on').iphoneStyle({ checkedLabel: '%', uncheckedLabel: '%',         
          onChange: function(elem, value) 
          					{ 
//          					alert(value.toString());
          					clearTimeout(message_on);
					  		message_on = setTimeout(function() { $('#bubu').load("do.php?message_on="+value.toString()); }, 2000);
							} });
    
    $.ajaxSetup({cache:false});

	$('#chat1').hide();
	$('#whoonline').hide();
    $('.daterange').hide();
    $('#search').hide();
        
    //При клике в настройки (h3) сворачиваем или разворачиваем содержимое
  	$('*').undelegate(".paneto2 h3[id2=settings]", "click").delegate(".paneto2 h3[id2=settings]", "click", function(event) 
        {
//		event.stopPropagation();
		$(this).parent('.paneto2').next(".pane").slideToggle("fast"); 
		return false;
		});
        
        
	//jsReiting();


    //setTimeout( jsAmount(),2000);
    
		 $('*').undelegate("#r6", "click").delegate("#r6", "click", function(event) 
			{
			event.stopPropagation();										    
			jsTitle($('#r6').attr('title'));
			});
		 //Поиск
		 $('*').undelegate("#textfilter", "keyup").delegate("#textfilter", "keyup", function(event) 
			{
				radio=$('* li[class=current] a').attr('id');
			    iscars = (radio == 14) || (radio == 15) || (radio == 16);
			    
			    if (iscars)
			       {
					clearTimeout(tttt);
					tttt = setTimeout(function()
					         {
					          jsSQLcars(radio);
			    		      return false;
			    		     }, 2000);
			       }
			          
				if ((event.keyCode=='13') && !iscars)
					{
					clearTimeout(tttt);
					tttt = setTimeout(function()
					         {
								$('.accordion2').html('');
	         					jsTitle("ПОИСК: Можно искать среди всех менеджеров. Если в поиске добавить символ '+'");
								if ( $('* li[class=current] a').attr('id') )
											wastab = $('* li[class=current] a').attr('id');
								$('ul[class=tabs] li').removeClass('current');
					        	//jsShowClientsJson();
					        	jsSQLClients(-2);

					         }, 0);
					
        		    //setTimeout(jsCollapse,200);
					}
				if (event.keyCode=='27') //При нажатии ESC после поиска нужно вернуться назад
					{
					$('.accordion2').html('');
					$('#textfilter').val('');
					
				    $('#search').slideUp('fast');
	   				$('.search-ico').removeClass('active');
	    			
					clearTimeout(tttt);
					var current = $.cookie('menu-current');
				    jsSQLClients(current);
					}
			});
			

	$('#cup').click(function()
	    {
		$('#cup').addClass('current');
	    setTimeout( doLoadUp2(),50 );
		});
		
		

    //При клике в нижние информеры: договора, выдачи ...
    $('*').undelegate(".roundfooter", "click").delegate(".roundfooter", "click", function() 
            {
			event.stopPropagation();										    
			alldate = $('#datediv').html();
    	    id = $(this).attr('id3');
			var but = $(this);
            clearTimeout(tttt);
            tttt=setTimeout(function()
               {
               $('li').removeClass('current');
               $('#lidogovors').addClass('current'); 
               if(!but.hasClass('active'))
                  {
					but.addClass('active');
				  }
				else 
				  {
				  but.removeClass('active');
				  alldate = alldate[0]+alldate[1]+alldate[2]+alldate[3]+alldate[4]+alldate[5]+alldate[6];

				  }

				$('.roundfooter').css('background','#516f8f');
	    	    but.css('background','#bc4b25');
    	    
		    	$('#selectmanager').html('Все');
		    	$('.accordion2').html('');
	            $('.paneto, #h22').remove();
               
 				lnk = "do.php?ShowSQL=24&json=1&manager="+manager+"&Model="+model+"&Filter="+filter+"&Radio=statistic2&ALLDate="+alldate+"&brand="+$('#brand').html()+"&type="+id+"&groupby=manager&downmenu=1";
 				console.info(lnk);
 				$.getJSON( lnk ,function(data)
					{
					$.each(data, function(i,data)
						{  
						//console.log(i);
						$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
						});
					jsCollapse();
					jsh1('groupby');
					$('.accordion2').slideDown('fast');
					});
				},200);
			});

		
				
	$('#AllStat').click(function()
	   {
	   jsShowStat();
	   });	

			
	$('.left-amount-do2').click(function()
	    {
	    main_did=1;
	    });		
	$('.left-amount-do').click(function()
	    {
	    main_did=3;
	    });		
	
    //Выбор бренда
	$("#selectbrand a").click(function()
		{
		    $('#brand').html($(this).attr('id2'));
		    $('#brandtitle').html($(this).attr('brandname'));
		    logo = $(this).children('img').attr('src');
		    
		    $('#brand-ico').html('<img height="17px" src="'+logo+'" style="padding-top:2px;">');
		    $('#selectmanager').html('Все');
			$.cookie('brand',$(this).attr('id2'),{ expires: 30 });
			$('#userlist').load('do.php?ShowManager=1');
//			setTimeout(jsShowClientsJson, 0); 			
//            setTimeout(jsCollapse,0);
//            setTimeout(doLoadUp2,1000);
			jsMenu(menu_id);
			var current = $.cookie('menu-current');
		    jsSQLClients(current);
			jsSms();
		 	jsLeftDo();
			jsReiting();
			
            //jsAmount();
		});

	$(".search-ico").click(function()
		{
	    $('#search').slideToggle('fast');
	    $('.search-ico').toggleClass('active');
	    if ($('.search-ico').hasClass('active')) $('#textfilter').focus();
		});
	
jsMenuFirst(0);		
menu = $.cookie('menu');


if(!menu) menu=0;
var current = $.cookie('menu-current');

if (($.cookie('fpk_job')!='Генеральный директор'))
	can_view=false; //Нельзя смотреть чужие бренды


if (($.cookie('fpk_job')=='Генеральный директор') && (user!=11))
{
menu=4; 
var current=22;
setTimeout( function()
    {
	$('* li').removeClass('current');
	$('* li[id='+current+']').addClass('current');
	},3000);
}

/////////////////////Первая загрузка/////////////////////////
jsMenu(menu);	

//alert(menu);

menu_id=menu;

//console.log(menu+' '+current);
    jsSQLClients(current);

//////////////////////////////////////////////////////////////////////////

    //Подготовка чата
	jsChatRefresh();
    jsSetInterval(30000); //Запуск чата

	//Клик в список пользователей чата
	$('#online').click( 
				function(index) 
				  { 
				  if ($('#whoonline').css("display")=='none') $('#whoonline').load("do.php?online=1");
				  $('#whoonline').slideToggle('fast');
				  });
				  
				
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);

    //Обработка - активно окно или нет, нужно для чата (чтобы показать пользователь онлайн или нет
	window.onfocus = function() 
        {
		iamblur=0;
//	 	document.title='ФПК';
	    clearTimeout(onfoc);
	    clearTimeout(onf);
	    onf = setTimeout(function() {
		   		clearInterval(alertmesage1);
		   		clearInterval(alertmesage2);
		   		}, 1000);
	 	onfoc=setTimeout(	function()
			  	{
		  		$('#bubu').load("do.php?setonline=online", function ()
					{
					 $('#online').removeClass("away");
					}); 
		  		}, 1000);
		}
				
	window.onblur = function() 
			{
	 		 iamblur=1;
	 		 clearTimeout(onfoc);
	 		 onfoc=setTimeout(function()
		  			{
  		  			 $('#bubu').load("do.php?setonline=offline", function ()
								{
								 $('#online').addClass("away");
								}); 
		  			}, 20000);
			}

	//Настройка верхних панелей с фильтром, на затемнение если нет мышки сверху
	//Верхняя панель с НОВОСТЯМИ
	$(".btn-slide").click(function(){
		if ($('#panel').css("display")=='none')  
		 $('#panelin').load("do.php?news=1&date="+$('#datediv').html(), function ()
		   {															 
				$("#panel").slideDown("fast");
				clearTimeout(st);
				st = setTimeout( function() { $("#panel").slideUp("slow"); $(this).toggleClass("active"); }, 60000 );

				$(this).toggleClass("active"); return false;
		   }); 
		 else 
		   {
			   $("#panel").slideUp("fast");
			   $(this).toggleClass("active"); return false;

		   }
	
		});

  	 //Подготовка для отображения клиентов фильтр - менеджеров
    $('*').undelegate("#manager-menu a[class!=top_link]", "click").delegate("#manager-menu a[class!=top_link]", "click", function() 
      {
      event.stopPropagation();										    

      var man = $(this); 
       $('#selectmanager').html(man.html());
	   $.cookie('mymanager',man.html(),{ expires: 30 });
	   $('#textfilter').attr('value',''); //обнуляем строку поиска при смене менеджера
	   jsMenu(menu_id);
	   var current = $.cookie('menu-current');
	   jsSQLClients(current);
 	   jsLeftDo();
	   jsReiting();
      });
       

	

    $("#show-i a").click(function()
       {
	   $.cookie('showi',$(this).attr("id2"),{ expires: 30 });
       $("* #i1,#i2,#i3,#i4,#i5").hide();
       $("* #"+$(this).attr('id2')).show();
       });
       


    //css("border", "2px dotted blue");	
    ////////////////////////////////////////////////////////////////////////////
	//jsShowClientsJson(); //Отобразить Всех клиентов в зависимости от фильтров
	//setTimeout(doLoadUp2,0);
 }

//////////////////////////Функция вывода клиентов/////////////////////////////////
function jsShowClientsJson(){ //Показать Всех клиентов в зависимости от фильтров
 var myTimeOut = null;
 //считываю данные из фильтров
 manager = encodeURIComponent($('#selectmanager').html()); 
 model = $('#selectmodel option:selected').attr('value');
 filter =  encodeURIComponent($('#textfilter').attr('value'));
// filter =  '';
 radio=$('* li[class=current] a').attr('id');
 alldate = $('#datediv').html();
 //alert(radio);
 if (!radio) return true;
// alldate = '2011-02-12';
  clearInterval(si2);
			if ( radio=='do' ) { jsShowDo(1); return true; }
			if ( radio=='journal_v' ) { jsShowDo(2); return true; }
			if ( radio=='journal_t' ) { jsShowDo(3); return true; }
			if ( radio=='statistic' ) { jsShowTimeline(); return true; }
			if ( radio=='cup' ) 
			   { 
			   setTimeout( jsSmsCup(), 5000 ); 
				
			   return true; 
			   }
			if ( radio=='stat' ) { return true; }
			if ( radio=='SetupUser' ) { return true; }
			if ( radio=='SetupModels' ) { return true; }
			if ( radio=='AllStat' ) { jsShowStat(); return true; }

// $('.accordion2').hide();//скрываю общее поле клиентов, чтобы не мелькало

 
 if (radio!='statistic') $('#my-timeline').hide(); 
 //console.log("Радио="+radio);
 
//Загружаю разом Всех клиентов - одна из главных функций
 $('.accordion2').hide().html('');
 lnk = "do.php?ClientEmpty=24&json=1&Manager="+manager+"&Model="+model+"&Filter="+filter+"&Radio="+radio+"&ALLDate="+alldate+"&radarrange=";
 //console.info(lnk);
 $.getJSON( lnk ,function(data)
	{
		$.each(data, function(i,data)
			{  
			//console.log(i);
			$('#clients-tmpl-mini').tmpl(data).appendTo(".accordion2");
			});
		jsCollapse();
	});

}



///////////////////////////////////////////////////////////////////////////////////////////////////
function jsShowClients(){ //Показать Всех клиентов в зависимости от фильтров
 var myTimeOut = null;
 $('.accordion2').hide();//сворачиваю общее поле клиентов, чтобы не мелькало
 //считываю данные из фильтров
 manager = encodeURIComponent($('#selectmanager').html());
 model = $('#selectmodel option:selected').attr('value');
 filter =  encodeURIComponent($('#textfilter').attr('value'));
 radio=$('* li[class=current] a').attr('id');
 
 alldate = $('#datediv').html();
 radarrange = encodeURIComponent($('#selectdaterange option:selected').attr('value'));
 
//Загружаю разом Всех клиентов
 $('.accordion2').hide().html('');
 $('.accordion2').load("do.php?ClientEmpty=24&Manager="+manager+"&Model="+model+"&Filter="+filter+"&Radio="+radio+"&ALLDate="+alldate+"&radarrange="+radarrange, function ()
   {															 
		jsCollapse();	//через задержку сворачиваю Все панели
   }); 
//setTimeout(doLoadUp2,10);	//Загружаю дела менеджера
}




function jsShowClientsPrepare(onlyid) {
    $(".clientform").hide();  $(".clientformmini").show();
    
   // $('input[title!=""]').hint();
    
   	$("* #phone").unbind('blur').blur(function(event){ 
	  		var dataString = 'CheckPhone='+ $(this).val()+'&client='+$(this).parents('.paneto').attr('id');
	  		var phone = $(this).val();
	  	 if (($(this).val().length)>5)
		  	$txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function()
		  		{
		  		if ($txt.responseText!=0)
		  		 {
			     jsTitle('Клиент с телефоном '+phone+' уже есть в базе ('+$txt.responseText+' раз). Воспользуйтесь поиском.');
			     $('#search').slideDown('fast');
	    		 $('.search-ico').addClass('active');
	    		 $('#textfilter').val(phone+'+').focus();
	    		 }
 				}
			  });
			});
    
    
    //При клике в клиента (h3) сворачиваем или разворачиваем содержимое
    $(".accordion2 .paneto h3").unbind('click').click(function()
        {
//		alert($(this).attr('cantopen'));
		if ($(this).attr('cantopen')=='true') { jsTitle('Вы не можете просматривать клиентов другого бренда. У вас нет прав.'); return false; }
        
        if ($(this).hasClass('notloaded')) 
           {
        	jsRefreshClientJson($(this).attr('id'));
        	$(this).removeClass('notloaded');
           }
		$(this).next(".pane").slideToggle("fast"); $(this).toggleClass("active"); $(this).siblings("h3").removeClass("active");
		
		});
    //При клике в дело (h4) сворачиваем или разворачиваем содержимое
    $("h4").unbind('click').click(function(){ 
		$(this).next(".pane2").slideToggle("fast");	$(this).toggleClass("active"); $(this).siblings("h4").removeClass("active");
		 
		combo();
		 
		 });
		
    //При клике в кнопку свернуть всё сворачиваем и скрываем кнопку
    $(".colapseall").unbind('click').click(function(){
	$(".accordion2 h3").removeClass("active"); $(".accordion2 .pane").slideUp("fast"); $(this).hide(); $(".expandall").show();});
	
	//Клик по табам внутри клиента
	$(".tabsmini li a").unbind('click').click(function(){
		id2 = $(this).parent('li').attr('id2');
		$(this).parents('.clientform').find('.client_tab').hide();
		$(this).parents('.clientform').find('li').removeClass('current');
		$(this).parents('.clientform').find('.client_tab[id2='+id2+']').show();
		$(this).parent('li').addClass('current');
		if(id2=='client_tab2') 
		   {
				    var doid1 = $(this).parents('.accordion').children('.clientform').attr('id');
                    vvv = $(this).parents('.accordion').children('.clientform').find('#finder');
                    console.info(vvv);

		                vvv.elfinder({
							url : 'elfinder/php/connector.php?mydir='+doid1,  // connector URL (REQUIRED)
						    lang: 'ru',             // language (OPTIONAL)
						    height: '300'
							}).elfinder('instance');
		   }
	    });
		
	
	$(".clientformmini").unbind('click').click(function(){
						var doid1 = $(this).attr('id');
                    $(".clientform[id="+doid1+"]").slideToggle("fast");
                    $(".clientformmini[id="+doid1+"]").slideToggle("fast");

					$(".client_tab").hide();
					myv = $(".clientform[id="+doid1+"]");
					myv.children(".client_tab:first").show();
					return false;							
					});
	$("img[class=dotype]").unbind('click').click(function(event){ 
				event.stopPropagation();														
				doid = $(this).parents('div').parents('div').attr('id');
    			client=$(this).parent('div').parent('div').attr("id");
		  		var dataString = 'Adddo='+ doid + '&Type=' + $(this).attr('title');
		  		$txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function()
						{ 
						//alert(dataString);
						clearTimeout(adddo);
						adddo = setTimeout(jsRefreshClientJson(doid,$txt.responseText),500);
						setTimeout(function(){ combo(); } ,1000)
						} });
				return false;
				
				
	});
  //Прогрессбар клиентов
	$(".ic").unbind('click').click(function(event){ 
				event.stopPropagation();														
				doid=$(this).attr('id2');
				img=$(this);
		  		var dataString = 'Icon='+ doid;
		  		$txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function()
						{ 
						//img.attr({'src':'img/progres-'+$txt.responseText+'.gif'});
						$('* .icon[id2='+doid+']').attr({'src':'img/progres-'+$txt.responseText+'.gif'});
						//alert('* #'+doid);
						} });
					});
					
	$(".ic2").unbind('click').click(function(event){ 
				event.stopPropagation();
				doid=$(this).attr('id2');
				img=$(this);
		  		var dataString = 'Icon2='+ doid;
		  		$txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function()
						{ 
						//alert($txt.responseText+' : '+dataString);														
						//img.attr({'src':'img/progres-'+$txt.responseText+'.gif'});
						$('* .icon2[id2='+doid+']').attr({'src':'img/progres-'+$txt.responseText+'.gif'});
						jsSms();
						setTimeout( function() 
						   {
						   jsTitle($('#r6').attr('title'));
						   },1000);

						//alert('* #'+doid);
						} });
					});
					
	    $("* #i1,#i2,#i3,#i4,#i5").unbind("click").click(function(event)
        {
		event.stopPropagation();														

        clearTimeout(myt);
        var th1=$(this);
        myt = setTimeout( function()
           {
	       $("* #i1,#i2,#i3,#i4,#i5").hide();
	       iii = (th1.attr('id')[1]);
	       if (iii==1) myi = 2;
	       if (iii==2) myi = 3;
	       if (iii==3) myi = 4;
	       if (iii==4) myi = 5;
	       if (iii==5) myi = 1;
	       $.cookie('showi','i'+myi);
    	   //$("* #i1").show();
    	   $("* #i"+myi).show();
           },300);
        });
				
					
    //При клике в кнопку Развернуть всё сворачиваем и скрываем кнопку
	$(".expandall").unbind('click').click(function(){
	$(".accordion2 h3").addClass("active");	$(".accordion2 .pane").slideDown("fast"); $(this).hide(); $(".colapseall").show();});
 $("* #i1,#i2,#i3,#i4,#i5").hide();

 if($.cookie('showi')==null) $.cookie('showi','i1');

 $("* #"+$.cookie('showi')).show();

	jsInputClick();
	
	

}



function jsRefreshClientJson(doid,maxid)
{
 radio=$('* li[class=current] a').attr('id');

   $(".paneto[id="+doid+"]:last").each(function()
		{
		var client;
		client=$(this).attr("id");
		pan=$(this);
		
		lnk = "do.php?Clientid2="+client+"&json=8&Did=0";
		//console.log(lnk);
 //setTimeout(doLoadUp2,70);	

 $.getJSON( lnk ,function(data)
	{ 
			pan.html('');
			$('#clients-tmpl').tmpl(data).appendTo(pan);
			jsShowClientsPrepare();
						    //Всё сворачиваем
			$(".pane2").hide();
//			alert(maxid);
//			console.log('maxid='+maxid);
			if (maxid) $(".paneto[id="+doid+"] .pane2[id="+maxid+"]").slideDown('fast');
			
			iamblur2=iamblur;
			if ((maxid) && (radio!='do')) $(".paneto[id="+doid+"] .pane2[id="+maxid+"] input[id=TEXT]").focus();
			if(iamblur2==1) { iamblur=0; }
			
		    jsPrepareDate();
			jsMenu(menu_id);
		jsRound();
		jsMakeDraggable();
		jsSetAutocomlete();
		
		//jsCollapse();
	});
							
		});

}


function jsSetAutocomlete()
{
$('#FIO').autocomplete('do.php?textfilter=1', {
    multiple: false,
    dataType: "json",
    width:450,
    parse: function(data) {
    	return $.map(data, function(row) {
    		return {
    			data: row,
    			value: row.name,
    			result: row.name
    		}
    	});
    },
    formatItem: function(item) {
    	return format(item);
    }
});

											function format2(mail) {
												return mail.phone1 + ' ('+mail.fio+')';
											}


$('input[name=PHONE1],input[name=PHONE2],input[name=PHONE3],input[name=PHONE4]').autocomplete('do.php?phonefilter=2', {
    multiple: false,
    dataType: "json",
    width:450,
    parse: function(data) {
    	return $.map(data, function(row) {
    		return {
    			data: row,
    			value: row.phone1,
    			result: row.phone1
    		}
    	});
    },
    formatItem: function(item) {
    	return format2(item);
    }
});


}


function jsRefreshClient(doid,maxid)
{
   $(".paneto[id="+doid+"]").each(function()
		{
		var client;

		client=$(this).attr("id");
    	$(this).load("do.php?Clientid2="+client+"&Did=0&Template=fpk-do-acordion.php", function()
						{
							jsShowClientsPrepare();
						    //Всё сворачиваем
							$(".pane2").hide(); //css("border", "2px dotted blue")
							if (maxid) $(".paneto[id="+doid+"] .pane2[id="+maxid+"]").slideDown('slow');
							if (maxid) $(".paneto[id="+doid+"] .pane2[id="+maxid+"] input[id=TEXT]").focus();
						    jsPrepareDate();
							//setTimeout(doLoadUp2,700);	

						});
							
		});

}




function jsInputClick() {
	
	$("* #addclient").unbind('click').click(function()
		{ 
		 manager = encodeURIComponent($('#selectmanager').html());

		  		var dataString = 'AddClient='+$(this).attr('id2')+'&Manager='+manager;
		  		$txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function()
						{ 
						$txt2 = $.ajax({type: "GET",url: "do.php?UpdateIcons="+$txt.responseText });
						clientid = $txt.responseText;
						front_panel(clientid,-3);
						setTimeout(function(){ $('.clientformmini').click(); },500);
						setTimeout(function(){ $('.clientform input[name=FIO]').focus(); },600);
						//$('<div class="paneto" id="'+$txt.responseText+'"></div>').appendTo($(".accordion2"));
						//jsRefreshClientJson($txt.responseText,$(".paneto:last").attr('id'));


						} });
		return false;
		});

		
				


	$("input[type!=radio]").unbind('click').click(function(event)
		{
		event.stopPropagation();										    

		mydiv=$(this); 
		doid = $(this).parents('div').attr('id');
	
    	if ($(this).attr('name') == 'clientadddo')
	    		{
    			client=$(this).parent('div').attr("id");
		  		var dataString = 'Adddo='+ doid;
		  		$txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function()
						{ 
						jsRefreshClientJson(doid,$txt.responseText);
						} });
		  		} 

    	
	
	//alert ($(this).val());
	
    if ($(this).val() == 'Снять выполнение')
	   {
	    if ($(this).attr('readonly')) { jsTitle('Недостаточно прав для редактирования дела. Обратитесь к руководителю или ответственному.'); 
	    	return false; }

	  var dataString = 'notDone='+ doid;
	  $txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function() 
			{			//Обновляю информацию по датам дел этого клиента   
			$txt2 = $.ajax({type: "GET",url: "do.php?UpdateIcons="+$('.pane2[id='+doid+']').attr('id2') });
$('h4[id='+doid+'] .mystrike').css({"text-decoration":"none"}).next('.pane2').slideUp("fast");
			$('h4[id='+doid+']').next('.pane2').slideUp("fast");							
			//setTimeout(doLoadUp2,700);	

			$('input[idd='+doid+']').attr({'name':'Done', 'value':'Выполнить'});
			jsRefreshClientJson($('.pane2[id='+doid+']').attr('id2'));
			jsLeftDo();			
			}});
       }

   if ($(this).val()== 'Выполнить')
	   {


	  var dataString = 'Done='+ doid;
	  $txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function() 
			{			//Обновляю информацию по датам дел этого клиента   
//			$txt2 = $.ajax({type: "GET",url: "do.php?tr=8&UpdateIcons="+$('.pane2[id='+doid+']').attr('id2') });
$('h4[id='+doid+'] .mystrike').css({"text-decoration":"line-through"});
			$('h4[id='+doid+']').next('.pane2').slideUp("fast");
			jsLeftDo();			
	  		$('input[idd='+doid+']').attr({'name':'notDone', 'value':'Снять выполнение'});

			}});
       }

    //Редактирую дело
    if ( ($(this).attr('name') == 'Save') || ($(this).attr('name') == 'Done'))
	   {
	    if ($(this).attr('readonly')) { jsTitle('Недостаточно прав для редактирования дела. Обратитесь к руководителю или ответственному.'); 
	    	return false; }

		date3 = $('.pane2[id='+doid+'] input[name=DATE2]').attr('title') + ' ' + $('.pane2[id='+doid+'] input[name=test]').val() + ':' + $('.pane2[id='+doid+'] input[name=test2]').val() + ':00';

		sr=$('.pane2[id='+doid+'] input, .pane2[id='+doid+'] textarea, .pane2[id='+doid+'] select').serialize();   
  		  var dataString = 'Update='+ doid + '&'+ sr + '&DATE3=' + date3 + '&slave=' + $('.pane2[id='+doid+'] #SLAVE option:selected').html();
  		  console.log('Savedo='+dataString);
          $txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function() 
					   {			//Обновляю информацию по датам дел этого клиента   
			$txt2 = $.ajax({type: "GET",url: "do.php?tr=3&UpdateIcons="+$('.pane2[id='+doid+']').attr('id2') });
$('h4[id='+doid+'] .text').html($('.pane2[id='+doid+'] input[id=TEXT]').attr('value'));   
						$('h4[id='+doid+']').next('.pane2').slideUp("fast");
						jsLeftDo();			
    					jsRefreshClientJson($('.pane2[id='+doid+']').attr('id2'));

					   } });
	   }

    //Удаляю дело
    if ($(this).attr('name') == 'Delete') 
	   if (confirm("Вы действительно хотите удалить дело №"+ doid +"?")) 
	      {  
	    if ($(this).attr('readonly')) { alert('Недостаточно прав для удаления дела. Обратитесь к руководителю или ответственному.'); 
	    	return false; }
  		  var dataString = 'Delete='+ doid;
		  $txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function() 
							{			//Обновляю информацию по датам дел этого клиента   
			$txt2 = $.ajax({type: "GET",url: "do.php?UpdateIcons="+$('.pane2[id='+doid+']').attr('id2') });
mydiv.parent('div').animate({height: "0",width: "0", opacity: "0"}, 1000, function()
														{ 
														mydiv.parent('div').hide(); 
														});
							
							$('h4[id='+doid+']').animate({height: "0",width: "0", opacity: "0"}, 1000, function()
														{ 
													    $('h4[id='+doid+']').hide();
														});
							jsLeftDo();			
			jsRefreshClientJson($('.pane2[id='+doid+']').attr('id2'));
							
							} });
		  }

    if ($(this).attr('name') == 'clientclose')
	   {
						$.ajax({type: "GET",url: "do.php?scandir"});
						$(".clientform").slideUp('fast');
						$(".clientformmini").slideDown('fast');
	   }
    //Редактирую клиента
    if ($(this).attr('name') == 'clientsave')
	   {
	   //$(this).attr('readonly');
	    if (false) { jsTitle('Недостаточно прав для редактирования клиента. Обратитесь к руководителю или ответственному.'); 
			$(".clientform").slideUp('fast');
			$(".clientformmini").slideDown('fast');
	    	return false; }
		sr=$('.clientform[id='+doid+'] input, .clientform[id='+doid+'] textarea').serialize();   
//		$('.clientform[id='+doid+'] input, .clientform[id='+doid+'] textarea').remove();   
	    manager = encodeURIComponent($('.clientform[id='+doid+'] #selectmanagerclient option:selected').attr('value'));
	    creditmanager = encodeURIComponent($('.pane[id='+doid+'] #selectcredit option:selected').attr('value'));
	    model = encodeURIComponent($('.pane[id='+doid+'] #selectmodel option:selected').attr('modelid'));
	    status = encodeURIComponent($('.pane[id='+doid+'] #selectstatus option:selected').attr('value'));
	    commercial = encodeURIComponent($('.pane[id='+doid+'] #selectcommercial option:selected').attr('value'));

		$.ajax({type: "GET",url: "do.php?scandir"});

  		  var dataString = 'UpdateClient='+ doid + '&'+ sr + '&manager=' + manager + '&creditmanager=' + creditmanager+'&model='+model+'&status='+status+'&commercial='+commercial;
		  //console.info(dataString);
		  
		 
		  $txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function() 
					   {
						$('h3[id='+doid+'] .text').html($('.pane[id='+doid+'] input[id=FIO]').attr('value')); 
						jsLeftDo();			
						$(".clientform").slideUp('fast');
						$(".clientformmini").slideDown('fast');
    					jsRefreshClientJson(doid);
					   } });
	   }

    //Сохраняю клиента и формирую договор поставки
    if ($(this).attr('name') == 'clientsave2')
	   {
	   //$(this).attr('readonly');
	    if (false) { jsTitle('Недостаточно прав для редактирования клиента. Обратитесь к руководителю или ответственному.'); 
			$(".clientform").slideUp('fast');
			$(".clientformmini").slideDown('fast');
	    	return false; }
		sr=$('.clientform[id='+doid+'] input, .clientform[id='+doid+'] textarea').serialize();   
//		$('.clientform[id='+doid+'] input, .clientform[id='+doid+'] textarea').remove();   
	    manager = encodeURIComponent($('.clientform[id='+doid+'] #selectmanagerclient option:selected').attr('value'));
	    creditmanager = encodeURIComponent($('.pane[id='+doid+'] #selectcredit option:selected').attr('value'));
	    model = encodeURIComponent($('.pane[id='+doid+'] #selectmodel option:selected').attr('modelid'));
	    status = encodeURIComponent($('.pane[id='+doid+'] #selectstatus option:selected').attr('value'));
	    commercial = encodeURIComponent($('.pane[id='+doid+'] #selectcommercial option:selected').attr('value'));




		$.ajax({type: "GET",url: "do.php?scandir"});

  		  var dataString = 'UpdateClient='+ doid + '&'+ sr + '&manager=' + manager + '&creditmanager=' + creditmanager+'&model='+model+'&status='+status+'&commercial='+commercial;
		  //console.info(dataString);
		  
		  var mythis = $(this);
		 
		  $txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function() 
					   {
						$('h3[id='+doid+'] .text').html($('.pane[id='+doid+'] input[id=FIO]').attr('value')); 

						lnk = "http://uah.uu.ru:3000/makedoc?client_id="+doid+"&doc_type=1&callback=?";

			console.info('hello');
			$.get(lnk,function(data)
							{
							text_error = '';
							$(".clientform input[type=text]").css("border","1px solid gray");
							if(data.document == 'ok') 
							  {
							  no_error = true;
							  }
							else
							  {
							  no_error = false;
							  for(var p in data.errors.client) 
							     { 
							     f_name = 'поле';
							     if(p == 'client_adress') { $myname="CLIENT_ADRESS"; $f_name="Адрес клиента";}
							     if(p == 'id_series') { $myname="PAS1"; $f_name="Серия паспорта";}
							     if(p == 'id_number') { $myname="PAS2"; $f_name="Номер паспорта";}
							     if(p == 'id_dep') { $myname="PAS3"; $f_name="Кем выдан";}
							     if(p == 'clientbirthday') { $myname="CLIENTBIRTHDAY";  $f_name="День рождения клиента"; }
							     if(p == 'contract_date') { $myname="DATE_CONTRACT"; $f_name="Дата договора";}

							     text_error = text_error+$f_name+' - '+data.errors.client[p][0]+'\n';
							     
							     
							     $("input[name="+$myname+"]").css("border","4px solid green");
							     
							     }
							  }
							
						if(no_error)
							{
							//Открываю вкладку с файлами
							id2 = "client_tab2";
							mythis.parents('.clientform').find('.client_tab').hide();
							mythis.parents('.clientform').find('li').removeClass('current');
							mythis.parents('.clientform').find('.client_tab[id2='+id2+']').show();
							mythis.parents('.clientform').find('li[id2=client_tab2]').addClass('current');
							if(id2=='client_tab2') 
							   {
									    var doid1 = mythis.parents('.accordion').children('.clientform').attr('id');
    					                vvv = mythis.parents('.accordion').children('.clientform').find('#finder');
    					                console.info(vvv);
							                vvv.elfinder({
												url : 'elfinder/php/connector.php?mydir='+doid1,  // connector URL (REQUIRED)
											    lang: 'ru',             // language (OPTIONAL)
											    height: '300'
												}).elfinder('instance');
							   }
							  	     setTimeout(function(){$('#finder')[0].elfinder.exec('reload');},1000);
							 }
						else //если ошибка генерации договора
						    {
						    alert('Возникли ошибки заполнения следующих полей:\n\n'+text_error);
						    }

					 });







						
					   } });
	   }


    //Удаляю клиента
    if ($(this).attr('name') == 'clientdelete') 
	   if (confirm("Вы действительно хотите удалить клиента №"+ doid +"?")) 
	      {  
	    if ($(this).attr('readonly')) { alert('Недостаточно прав для удаления клиента. Обратитесь к руководителю или ответственному.'); 
			$(".clientform").slideUp('fast');
			$(".clientformmini").slideDown('fast');
	    	return false; }
  		  var dataString = 'DeleteClient='+ doid;
		  $txt = $.ajax({type: "GET",url: "do.php", data: dataString, success: function() 
							{ 
							jsMenu(menu_id);
							$('.paneto[id='+doid+']').slideUp('fast');
							mydiv.parent('div').animate({height: "0",width: "0", opacity: "0"}, 1000, function()
														{ 
														mydiv.parent('div').hide(); 
    													});
							jsLeftDo();			
							$('h3[id='+doid+']').animate({height: "0",width: "0", opacity: "0"}, 1000, function()
														{ 
													    $('h4[id='+doid+']').hide();
														});
							} });
		  }
    });

}







function doClear() 
{
		if ($('#textfilter').val=='Поиск') $('#textfilter').val = '';
		
}

var timeout = null;

function doLoadUp() 
{
		
        if (document.getElementById('query').value=='') $("#debug").hide();
		if (timeout) clearTimeout(timeout);
		if (document.getElementById('query').value=='') ; else timeout = setTimeout(doload, 500);
}

function doload() 
{
       query=document.getElementById('query').value;

//do.php?Search=%8%
  		  var dataString = 'Search=%'+ encodeURIComponent(query) +'%';

		  $("#debug").load('do.php?'+dataString, function()
								{
									$('#debug a').click(function ()
											{
											$(".accordion2 .pane").hide();	
											$(".accordion2 .pane[id="+ $(this).attr('id2') +"]").slideDown("fast");
										    $(".pane2[id="+ $(this).attr('id') +"]").slideDown("fast");	
											$("*[value*="+query+"]").animate({opacity: "0"}, 500, function()
														{ 
														$("*[value*="+query+"]").animate({opacity: "1"}, 700);
														});
											//alert($(this).attr('id2'));
											});
								});
   	      $('#debug').slideDown('fast');
}

function doLoadUp2(radiodo)
{ 
 return true;
 manager = encodeURIComponent($('#selectmanager').html()); 
 model = $('#selectmodel option:selected').attr('value');
 radio=$('* li[class=current] a').attr('id');
 if (radio=='do') return true;
 alldate = $('#datediv').html();
 filter='';
 lnk = "do.php?AmountDo=1&Manager="+manager+"&date2="+alldate;
 $('.left-amount-do2').load(lnk);
 //alert(lnk);
 jsReiting();

 lnk = "do.php?AmountDo=2&Manager="+manager+"&date2="+alldate;
 $('.left-amount-do').load(lnk);
 
 
//   clearInterval(si2);

   jsSms();

    if ( ($('* li[class=current] a').attr('id'))!='do' ) return true;

	query = $('#datediv').html();
    manager = encodeURIComponent($('#selectmanager').html());
    if (!manager) manager = encodeURIComponent('%');

    var dataString = 'Did='+main_did+'&Date='+ query+'&Manager='+manager;
    main_did=0;

	
    $(".accordion2").load('do.php?'+dataString, function() 
                 {
           		 $('h3').hide();
				$('.linkdo a').unbind('click').click(function ()
											{
						        			client = $(this).attr('id2');
						        			pn = $(".paneto[id="+client+"]");
				        					//$.ajaxSetup({async: false}); //отключаем асинхронность

						        			if(pn.hasClass("notloaded"))
						        			  { 
							        		
											   $('.paneto[id='+client+']').each( function()
        											{
        											$(this).removeClass("notloaded");
        											client = $(this).attr('id');
    												jsRefreshClientJson(client);
    												//alert(client);
        											});
							           		   //pn.css('display','none');
							           		   //return true;

						        			  }
						        			//$.ajaxSetup({async: true}); //включаем асинхронность

						        			
						        			dsp = pn.css('display');
						        			$('.paneto').hide();
						        			if ( dsp=='none' )
						        			   {
  										        $('.pane').slideDown('fast');
  										        pn.slideDown('fast');
  										       }
  										       else
  										       {
  										        $('.pane').slideUp('fast');
  										        pn.slideUp('fast');
  										       }
					               		    

											});
 				jsRoundDo();
 	 	        $('#myh2').remove();
 		        $('<h2 id="myh2">'+$('#selectmanager').html()+'</h2>').prependTo('.accordion2');

				 });

}


function jsPrepareDate()
 {
 
 
    if ( ($('#selectmanager').html()!='Все') && 
         ($('#textfilter').attr('value')=='') ) $('* #showmemanager').hide();
	

	$.datetimeEntry.setDefaults({spinnerImage: 'css/images/spinnerDefault.png'});
    $('*[name=defaultEntry]').each( function()
        { 
	x='#'+$(this).attr('id');
	$(x).datetimeEntry({datetimeFormat: 'W N Y / H:M', 
                   altField: '#alt'+$(this).attr('id'), 
				   altFormat: 'Y-O-D H:M:S'}).datetimeEntry('setDatetime', new Date( $('#alt'+$(this).attr('id')).val() ));
        });
        
    $('input[id2=DATE]').datepicker({ inline: true, dateFormat: "dd-mm-yy",changeMonth: true, changeYear:true });


}




//Очистка строки поиска при клике в "очистить"
function cleansearch() 
{ 
$('#textfilter').attr('value',''); 
setTimeout(jsShowClientsJson,50);

}
//Запускается при наборе данных в строке поиска запускается
function jsRefreshclientSearch()
{
    clearTimeout(searchtimeout); 
	searchtimeout = setTimeout(jsShowClientsJson,600);	
}



//Инициализация событий чата, автоматически делигируются вновь созданым чатам
function jsChatRefresh()
{	
	  	$('*').undelegate("#chatminimize, #chatname", "click").delegate("#chatminimize,  #chatname", "click", function() 
				{
				event.stopPropagation();										    
 
				setTimeout( function() {
				 clearInterval( alertmesage1);
				 clearInterval( alertmesage2);
				 document.title='ФПК';}, 6000);

				who2 = $(this).parents('#chat');
  		        who2.find("#chattop").css('background','#006600');

				if (who2.height()==600)
						who2.animate({"height": 24}, 700, 'easeInOutBack', function()
														{ 
														who2.find('#chattext,#chatbottom').hide();
														});

				else 
				    {
				     who2.find('#chattext,#chatbottom').show().scrollTop(1000000);

				     who2.animate({"height": 600}, 700, 'easeInOutBack', function()
														{ 
														who2.find('#chatcontent').focus();
														
														});
					}
				});

		$('*').undelegate("#chatclose", "click").delegate("#chatclose", "click", function() 
				{
				event.stopPropagation();										    
 
				who2 = $(this).parents('#chat');
				who2.fadeOut(700, function() {
				   who2.remove(); 
				   nchat=0;
				   $('* #chat').each(function()
		 			{
					//console.info(nchat+' / '+$(this).attr('who'));
					$(this).animate({"margin-right": 20+286*nchat}, 700+150*nchat, 'easeInOutBack', function()
														{ 
														});
					nchat=nchat+1;
					});
				  });
				return false;
				});

		 $('*').undelegate("#chatcontent", "keydown").delegate("#chatcontent", "keydown", function(event) 
			{
				if (event.keyCode=='13') 
					{
					event.stopPropagation();														
					who = $(this).parents('#chat').attr('who');
							  var user = $.cookie('fpk_id');
			 				  var touser = who;
							  var boxval = $("* #chat[who='"+who+"'] #chatcontent").val();
							  if (boxval=='') return false;
							  
							  console.info(user+' to '+touser+':'+boxval);
							  var dataString = 'user='+ encodeURIComponent(user) + '&msg=' + encodeURIComponent(boxval)+'&touser=' + encodeURIComponent(touser);
							  $.ajax({
								     type: "POST",
            						 url: "chatajax.php",
									 data: dataString,
									 cache: false,
									 success: function(html)
									          {
											  $("* #chat[who='"+who+"'] #chattext").append(html);
											  $("* #chat[who='"+who+"'] #chattext").scrollTop(10000);
											  $("* #chat[who='"+who+"'] p:last").css({"margin-top": "20px"}).animate({"margin-top": "4px"}, 300);
											  $("* #chat[who='"+who+"'] #chatcontent").val('');
											  $("* #chat[who='"+who+"'] #chatcontent").focus();
											  }
									 });
			   return false;

					}
			});

//Клик на фио менеджера для чата в списке юзеров онлайн
			$('#whoonline').undelegate("#username", "click").delegate("#username", "click",
										function(index) 
										  { event.stopPropagation();										    
											jsSetInterval(30000);
										  	iduser = $(this).attr('iduser'); 
											if ( $('* #chat[who="'+iduser+'"]').attr("who")==null )
											     {
												 jsCreateChat(iduser,$(this).html()+' <img src="img/'+$(this).attr('idbrand')+'">',600);
									  console.info(iduser+' (to) '+$(this).html());

												 }
											else { 
											      $('* #chat[who="'+iduser+'"]').hide();
												  $('* #chat[who="'+iduser+'"]').slideDown('fast');
											      $('* #chat[who="'+iduser+'"] #chatcontent').focus();
												 }
										  return false;
										  });



}


//Создает новое окно чата
function jsCreateChat(iduser,nameuser, height1)
{
	
	  newchat = $('#chat1').clone();
	  console.info(newchat);
	  //newchat.each('#chat', function() { alert(this.attr('id')); });
	  nn = newchat.insertBefore('#chat1').end().css("margin-right", 20+286*nchat);
	  nchat=nchat+1;
	  //$('#chat').hide();										  
	  nn.attr('who',iduser).attr('id','chat');
	  $("* #chat[who='"+iduser+"']").height(600).show().animate({"height": height1}, 400);
	  $("* #chat[who='"+iduser+"'] #chatname").html(nameuser);
	  $('#whoonline').slideUp('slow');
	  lnk = "chat_json.php?chathistory=1&touser="+iduser+"&user="+user;
	  console.log('chat='+lnk);
	  $("* #chat[who='"+iduser+"'] #chattext").load(lnk, function()
	         {								   
	          $("* #chat[who='"+iduser+"'] #chattext").scrollTop(1000000);
	         });
	  $('* #chat[who="'+iduser+'"] #chatcontent').focus().click( function() 
		{
			//Убираю все всплывающие уведомления
			jsClearAlerts();

		$('* #chat[who="'+iduser+'"] #chattop').css('background','#006600');	
	    } );
	  
	
}


function jsSetInterval(sec)
{		
	    clearInterval(auto_refresh);
		var auto_refresh = setInterval(function ()
   			{
			  var touser = $('#chat').attr('who');
			$.getJSON("chat_json.php?user="+encodeURIComponent(user)+"&touser="+encodeURIComponent(touser),function(data)
					{
						$.each(data.posts, function(i,data)
							{  
	   							if (iamblur)
									 jsAlert('simple',0,data.m.user,data.m.name+':', data.m.msg);
								else 	PlaySound("sound1");


								var div_data="<div class='chat-bubble'>"+data.m.msg+"<div class='chat-bubble-arrow-border'></div><div class='chat-bubble-arrow'></div></div><div class='chat_time'>"+data.m.datetime+"</div>";
    
								var chat_user = $("* #chat[who='"+data.m.user+"']");
								height = chat_user.height();
								if (height==null) 
								   {
									//Если окна чата нет, создаем его
									jsCreateChat(data.m.user,data.m.name+' <img src="img/'+data.m.logo+'">',600);
									//alert('Новое сообщение в чате.');
								   }
	   								var chat_user = $("* #chat[who='"+data.m.user+"']");

								   chat_user.find("#chattop").css('background','darkred');
								   chat_user.find("#chattext").append(div_data).scrollTop(10000000);
								   chat_user.find("p:last").css({"margin-left": "300px"}).animate({"margin-left": "0px"}, 200,
									function()
									  {
										$("* #chat[who='"+data.m.user+"'] #chattop").css('background','darkred');
										  if (iamblur==1) 
												 {
												 //document.focus();
												 //alert('Вам сообщение.');
												 //alertmesage1 = setInterval ( function() 
												 //	   { document.title=data.m.name+' - сообщение'; },500);
												 //alertmesage2 = setInterval ( function() 
												 //	   { document.title='ФПК'; },800);
												 }
									  });
								//Моргаем.
							});
					});
				}, sec);	

	
}


function jsRound()
{
			$('h3:first').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
			$('h2').next('.paneto').find('h3').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
            $('h2').prev('.paneto').find('h3').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
            $('h3:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");

}
function jsRoundNews()
{
			$('h3:first').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
			$('h2').next('.paneto2').find('h3').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
            $('h2').prev('.paneto2').find('h3').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");
            $('h3:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");

}
function jsRoundDo()
{
			$('.mystrike2:first').css("-webkit-border-top-left-radius","10px 10px").css("-webkit-border-top-right-radius","10px 10px");
            $('.mystrike2:last').css("-webkit-border-bottom-left-radius","10px 10px").css("-webkit-border-bottom-right-radius","10px 10px");

}


 var resizeTimerID = null;
 function onResize() {
		  height=$('#left-col').height()-$('#indented').height()-420;
		  $('.left-bottom').css('height',height);

     if (resizeTimerID == null) {
         resizeTimerID = window.setTimeout(function() {
             resizeTimerID = null;
             //tl.layout();
         }, 500);
     }
 }





(function($) {

        var opts = {};

        $.fn.dropzone = function(options) {

                // Extend our default options with those provided.
                opts = $.extend( {}, $.fn.dropzone.defaults, options);

                var id = this.attr("id");
                var dropzone = document.getElementById(id);

                log("adding dnd-file-upload functionalities to element with id: " + id);

                if ($.client.browser == "Safari" && $.client.os == "Windows") {
                        var fileInput = $("<input>");
                        fileInput.attr( {
                                type : "file"
                        });
                        fileInput.bind("change", change);
                        fileInput.css( {
                                'opacity' : '0',
                                'width' : '100%',
                                'height' : '100%'
                        });
                        fileInput.attr("multiple", "multiple");
                        fileInput.click(function() {
                                return false;
                        });
                        this.append(fileInput);
                } else {
                        dropzone.addEventListener("drop", drop, true);
                        var jQueryDropzone = $("#" + id);
                        jQueryDropzone.bind("dragenter", dragenter);
                        jQueryDropzone.bind("dragover", dragover);
                }

                return this;
        };

        $.fn.dropzone.defaults = {
                url : "",
                method : "POST",
                numConcurrentUploads : 3,
                printLogs : false,
                // update upload speed every second
                uploadRateRefreshTime : 1000
        };

        // invoked when new files are dropped
        $.fn.dropzone.newFilesDropped = function() {
        };

        // invoked when the upload for given file has been started
        $.fn.dropzone.uploadStarted = function(fileIndex, file) {
        };

        // invoked when the upload for given file has been finished
        $.fn.dropzone.uploadFinished = function(fileIndex, file, time) {
        };

        // invoked when the progress for given file has changed
        $.fn.dropzone.fileUploadProgressUpdated = function(fileIndex, file,
                        newProgress) {
        };

        // invoked when the upload speed of given file has changed
        $.fn.dropzone.fileUploadSpeedUpdated = function(fileIndex, file,
                        KBperSecond) {
        };

        function dragenter(event) {
                event.stopPropagation();
                event.preventDefault();
                return false;
        }

        function dragover(event) {
                event.stopPropagation();
                event.preventDefault();
                return false;
        }

        function drop(event) {
                var dt = event.dataTransfer;
                var files = dt.files;

                event.preventDefault();
                uploadFiles(files);

                return false;
        }

        function log(logMsg) {
                if (opts.printLogs) {
                        // console && console.log(logMsg);
                }
        }

        function uploadFiles(files) {
                $.fn.dropzone.newFilesDropped();
                for ( var i = 0; i < files.length; i++) {
                        var file = files[i];

                        // create a new xhr object
                        var xhr = new XMLHttpRequest();
                        var upload = xhr.upload;
                        upload.fileIndex = i;
                        upload.fileObj = file;
                        upload.downloadStartTime = new Date().getTime();
                        upload.currentStart = upload.downloadStartTime;
                        upload.currentProgress = 0;
                        upload.startData = 0;

                        // add listeners
                        upload.addEventListener("progress", progress, false);
                        upload.addEventListener("load", load, false);

                        xhr.open(opts.method, opts.url);
                        xhr.setRequestHeader("Cache-Control", "no-cache");
                        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                        xhr.setRequestHeader("X-File-Name", file.fileName);
                        xhr.setRequestHeader("X-File-Size", file.fileSize);
                        xhr.setRequestHeader("Content-Type", "multipart/form-data");
                        xhr.send(file);

                        $.fn.dropzone.uploadStarted(i, file);
                }
        }

        function load(event) {
                var now = new Date().getTime();
                var timeDiff = now - this.downloadStartTime;
                $.fn.dropzone.uploadFinished(this.fileIndex, this.fileObj, timeDiff);
                log("finished loading of file " + this.fileIndex);
        }

        function progress(event) {
                if (event.lengthComputable) {
                        var percentage = Math.round((event.loaded * 100) / event.total);
                        if (this.currentProgress != percentage) {

                                // log(this.fileIndex + " --> " + percentage + "%");

                                this.currentProgress = percentage;
                                $.fn.dropzone.fileUploadProgressUpdated(this.fileIndex, this.fileObj, this.currentProgress);

                                var elapsed = new Date().getTime();
                                var diffTime = elapsed - this.currentStart;
                                if (diffTime >= opts.uploadRateRefreshTime) {
                                        var diffData = event.loaded - this.startData;
                                        var speed = diffData / diffTime; // in KB/sec

                                        $.fn.dropzone.fileUploadSpeedUpdated(this.fileIndex, this.fileObj, speed);

                                        this.startData = event.loaded;
                                        this.currentStart = elapsed;
                                }
                        }
                }
        }

        // invoked when the input field has changed and new files have been dropped
        // or selected
        function change(event) {
                event.preventDefault();

                // get all files ...
                var files = this.files;

                // ... and upload them
                uploadFiles(files);
        }

})(jQuery);

function combo()
{
/////////combobox_run
	var listout = 
		[
            'OUT1 – Неодобрение кредита ()',
            'OUT2 – Покупка продукции другого бренда ()',
            'OUT3 – Покупка ЭТОЙ ЖЕ продукции у другого поставщика ()',
            'OUT4 – Покупка ЭТОЙ ЖЕ продукции внутри Холдинга ()',
            'OUT5 – Покупка другой продукции внутри Холдинга ()',
            'OUT52 – Покупка другой продукции в другом месте ()',
            'OUT6 – Отказ (сроки поставки) ()',
            'OUT7 – Отказ (изменение цены) ()',
            'OUT8 – Изменение финансовой ситуации ()',
            'OUT9 – Не сообщил причину отказа ()',
            'OUT10 – Другое ()',
            'OUT11 – Клиент пропал ()',
            'OUT12 – Собирается покупать позже ()',
        ];		 

	$( "* #TEXT" ).each(function() {
		mytype = $(this).attr('mytype');


		if (mytype!='OUT') list = ['Кредит одобрен','Кредит отказ', 'Рассмотрение'];
		else 
			list = listout;
		
	        if (mytype=='OUT') $(this).combobox(list);
        });
}

function format(mail) {
    return mail.name + ' ('+mail.manager+')';
}



