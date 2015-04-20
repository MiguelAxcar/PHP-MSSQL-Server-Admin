<head>

<!-- Syntax highlighting editor kindly provided by Fernando M.A.d.S. <fermads@gmail.com>
Take a look on codepress website project at https://sourceforge.net/projects/codepress -->
<script src="codepress/codepress.js" type="text/javascript"></script> 

<meta http-equiv="content-type" content="text/html; charset=iso8859-1" />
<title>PHP Query Analyzer</title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="outer">

	<div id="header">
		<h1><a href="index.php">PHP Query Analyzer</a></h1>
		<h2>a web based opensource client for Microsoft SQL Server</h2>
	</div>
	
	<div id='designed-for-firefox' style='position:absolute; right:0px; top:0px;'>
		<a href='http://www.spreadfirefox.com?from=sfx&amp;uid=0&amp;t=358' target='_blank'>
			<img src='http://www.spreadfirefox.com/files/images/affiliates_banners/Community-Member-Firefox.png' alt='Spread Firefox Affiliate Button' border='0' />
		</a>		
	</div>
	
<?php

	if ($_SERVER['REMOTE_ADDR'] != '192.168.0.254' && $_SERVER['REMOTE_ADDR'] != '192.168.0.7' && $_SERVER['REMOTE_ADDR'] != '192.168.0.10')
	{
		echo "<div id='content'>";
		
		echo "
		<div id='primaryContentContainer' style='float:left; padding:20px;'>
		<div id='primaryContent'>
		<p>
			<h3>I'm sorry, Dave. I'm afraid I can't do that</h3>
			<blockquote style='color: red; border-left: solid 0.75em #FF0000;'>		
				Unfortunately the access isn't allowed to IP <b>{$_SERVER['REMOTE_ADDR']}</b> at this moment, and this try was recorded on logfile.<br>
				If you think your access to this tool is needed please contact your database manager to ask permission.		
			</blockquote>
		</p>
		</div>
		</div>
		
		<div class='clear'></div></div>";
	
		include ('common.footer.php');
	
		echo "</div>";	
		echo "</body></html>";
		
		exit();
	}
?>
