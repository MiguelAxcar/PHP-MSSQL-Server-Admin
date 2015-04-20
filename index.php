<?php
	include ('common.header.php');

	include ('common.topmenu.php');
	
	include ('db.vars.php');

	echo "<div id='content'>";

	if (!empty($db_hostname) && !empty($port) && !empty($db_name) && !empty($username) && !empty($password))
	{	
		include ('db.library.php');
		include ('common.leftmenu.php');
		include ('common.content.php');
	}
	else
	{
		echo "
		<div id='primaryContentContainer' style='float:left; padding:20px;'>
		<div id='primaryContent'>
		<p>
			<h3>I'm sorry, Frank, I think you missed it. Queen to Bishop 3, Bishop takes Queen, Knight takes Bishop. Mate.</h3>
			<blockquote style='color: red; border-left: solid 0.75em #FF0000;'>		
				Database credentials isn't properly seted yet.<br>
				Please take a look on <a href='Configuration.php'>Configuration page</a> before use PHP Query Analyzer		
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
			
	echo "<div class='clear'></div>";
	
	//closing div id='content'
	echo "</div>";
	
	include ('common.footer.php');
	
	//closing div id=outer
	echo "</div>";
	
	echo "</body></html>";

?>
