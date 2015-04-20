<?php
	include ('common.header.php');

	include ('common.topmenu.php');
	
	include ('common.library.php');
	

	echo "<div id='content'>";
	
	echo "
	<div id='secondaryContent'>
	
	<h3>Author</h3>
	
	<b>Luiz \"Miguel\" Axcar</b><br>
	Bauru, S&atilde;o Paulo, Brasil <br><br>

	<div align='center'><img src='images/luiz_miguel_axcar.jpg'></div><br><br>
	
	<ul>
		<li>#96163762</li><br>
		<li>mail, M\$N and Orkut<br><a href='mailto:miguel.axcar@gmail.com'>miguel.axcar@gmail.com</a></li>
	</ul>
	<div class='xbg'></div>
</div>
		";			
	
	echo "<div id='primaryContentContainer'><div id='primaryContent' style='margin-top: 0px; margin-bottom: 0px; margin-right: 0px'>";
	echo "<p>";
	
	echo "<h3>Some stuff</h3>";
	echo "<p>";	
	
	echo "This small tool was made by me (when I was a kid) some years ago, to solve a especific problem - run queries on a MSSQL server on Linux, and only now when that MS problem happened again I got the idea of ressurrect and upping it to Source Forge. <br><br>
The code was licensed under GNU General Public License version 3, please take a look at <a href='COPYING'>COPYING</a> file on root.<br><br>
Please send any kind of bugs, needs, comments, or suggests to my mail, and will be a pleasure try to help you.<br><br>
Of course would be amazing any kind of stuff exchange too, like whiskey or gym, local cigarretes, postcards, paperclips or something, and something you send reach my address <b>I do promess (yes, I do!)</b> send proportional brazilian stuff back to your address =0) <br>
Address: Cel Antonio A Reboucas 630 J Florida - Bauru SP, Brazil - CEP 17024-660<br><br>
<b>SQL code highlight is up and running!</b> Thank you Fernando M.A.d.S., from <a href='https://sourceforge.net/projects/codepress'>Codepress project</a><br>
<b>PHP Query Analyzer needs your help.</b> Contact me if you want to get a shovel, roll up your sleeves and work with us.<br>
<br>Brazilian regards, Luiz \"Miguel\" Axcar. 

<br><br><br>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.<br>

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.<br>

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <a href='http://www.gnu.org/licenses/'>http://www.gnu.org/licenses/</a>	";
	
	echo "</p>";
	echo "</div></div>";	
	

	
	echo "<div class='clear'></div>";
	
	//closing div id='content'
	echo "</div>";
	
	include ('common.footer.php');
	
	//closing div id=outer
	echo "</div>";
	
	echo "</body></html>";

?>
