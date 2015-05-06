<script language='javascript'>

function addslashes (str) {
    // Escapes single quote, double quotes and backslash characters in a string with backslashes  
    // 
    // version: 1004.2314
    // discuss at: http://phpjs.org/functions/addslashes    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Ates Goral (http://magnetiq.com)
    // +   improved by: marrtins
    // +   improved by: Nate
    // +   improved by: Onno Marsman    // +   input by: Denny Wardhana
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Oskar Larsson Högfeldt (http://oskar-lh.name/)
    // *     example 1: addslashes("kevin's birthday");
    // *     returns 1: 'kevin\'s birthday' 
    return (str+'').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}

function ajaxInit() 
{
	var xmlhttp;

	try {	xmlhttp = new XMLHttpRequest();	} 
	
	catch(ee) 
	{
    	try {	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); } 
		catch(e) 
		{
	  		try {	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } 
			
			catch(E) 
			{
				xmlhttp = false;
	  		}
    	}
	}

	return xmlhttp;
}

function carrega(query)
{	
	var retrieving = false;
	document.getElementById('retorno_busca_ajax').innerHTML = '';
	
	ajax = ajaxInit();
	
	ajax.open("GET", "common.content.ajax.php?query="+encodeURIComponent(query), true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');   
	ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
	ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
	ajax.setRequestHeader("Pragma", "no-cache");

	document.getElementById('retorno_busca_ajax').innerHTML = '<b>Background activity:</b><br>';
	
	document.getElementById('retorno_busca_ajax').innerHTML += '- Sending query to DB... ';
	
	ajax.onreadystatechange = function() 
	{
		if(ajax.readyState == 1)
		{
			document.getElementById('retorno_busca_ajax').innerHTML += 'OK<br>';
			document.getElementById('busca_loading').style.display = '';
			document.getElementById('retorno_busca_ajax').innerHTML += '- Executing query... ';
		}

		if(ajax.readyState == 2) 
		{
			document.getElementById('retorno_busca_ajax').innerHTML += 'OK<br>';
			document.getElementById('retorno_busca_ajax').innerHTML += '- Communication start... ';
		}
		
		if(ajax.readyState == 3 && retrieving == false) 
		{
			retrieving = true;
			
			document.getElementById('retorno_busca_ajax').innerHTML += 'OK<br>';
			document.getElementById('retorno_busca_ajax').innerHTML += '- Retrieving data, please wait...';
			document.getElementById('retorno_busca_taking_too_long_ajax').innerHTML = 'If it is taking too long try to tune your query, avoid using SELECT *, reducing fields or reducing rows requested.<br><small><i>PHP Query Analyzer needs your help to improve this section, like a progress bar telling how much data was already returned, compact returned data, showing parcial results while it\'s available. Please contact me if you want to help.</i></small>';
			
			document.getElementById('busca_loading').style.display = 'none';
		}
		
		if(ajax.readyState == 4) 
		{
			document.getElementById('retorno_busca_ajax').innerHTML += ' OK';
			document.getElementById('retorno_busca_taking_too_long_ajax').innerHTML = '';
			
			if(ajax.status == 200)
			{		
				if(ajax.responseText != "")
				{
					document.getElementById('contadorLastQueries').innerHTML++;
			
					var hoje = new Date();
					var meses  = new Array("01","02","03","04","05","06","07","08","09","10","11","12");
					var minutos = (hoje.getMinutes() <=9) ? 0 + hoje.getMinutes() : hoje.getMinutes();
					var segundos = (hoje.getSeconds() <=9) ? 0 + hoje.getSeconds() : hoje.getSeconds();
					var data = hoje.getDate() + "/" + meses[hoje.getMonth()] + " "+hoje.getHours() + ":" + minutos + ":" + segundos;
				
					document.getElementById('superqueries').innerHTML += "<a onclick='setCode(\""+addslashes(query)+"\")'>("+data+"): "+query+"</a><br>";
					document.getElementById('retorno_busca_ajax').innerHTML += '<br><hr>' + ajax.responseText;
				}	
				ajax = null;
			}
		}
	}
	ajax.send(null);
}

function clear_most_used_tables()
{
	alert ('This function isn\'t ready yet, sorry. Please, be in contact if you can help phpqa.');
}

function clear_last_queries()
{
	document.getElementById('contadorLastQueries').innerHTML = 0;
	document.getElementById('superqueries').innerHTML = "<h3>Last queries (<span id='contadorLastQueries'>0</span>) - <span onclick='clear_last_queries()' style='cursor: pointer; text-decoration: underline;'>clear</span></h3>";
}

</script>



<div id="primaryContentContainer">
	<div id="primaryContent">

	<?php
	$query = (! empty ($_GET['query'])) ? stripslashes($_GET['query']) : stripslashes($_POST['auxiliar']);

	echo "<br><br><div id='superqueries'><h3>Last queries (<span id='contadorLastQueries'>0</span>) - <span onclick='clear_last_queries()' style='cursor: pointer; text-decoration: underline;'>clear</span></h3></div>";

	echo "<br>
	 <textarea name='query_textarea' id='textareaQuery' onkeyup='szs(this);' wrap='false'>{$query}</textarea>
	 <br><br>
	 
	<div align='center' valign='middle' style='background-color: #EEE; width: 93%px; height: 24px; border-left: 10px solid #CCC; border-right: 10px solid #CCC; '>

	<input type='button' value='Shoot!' default onclick='carrega(getCode())'>
	</div>";

	echo "	<br>
			<div id='busca_loading' style='display:none; margin:0 0 0 0px; float: left'>
			<img src='images/loading.gif'/>
			</div>
			<div id='retorno_busca_ajax'></div>
			<div id='retorno_busca_taking_too_long_ajax'></div>";

	?>

	</div>
</div>
