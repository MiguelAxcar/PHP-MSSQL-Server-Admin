<?php 

if (!empty($db_hostname) && !empty($port) && !empty($db_name) && !empty($username) && !empty($password))
{
	if ( ! ( $_CONEXAO = @mssql_connect ("$db_hostname", $username, $password) ) )
	{
		echo "<blockquote style='color: red; border-left: solid 0.75em #FF0000;'>";
		echo "There is an error on database connection, please check your data:[$username:".str_repeat("*", strlen($password))."->$db_name@$db_hostname:$port].";
		$retorno = mssql_get_last_message();
		echo "<br>MSSQL last error message: ";
		echo ($retorno) ? $retorno : "no return, PHP didn't find any MSSQL Server.";
		echo "</blockquote>";
		exit;
	} 

	if ( ! ( @mssql_select_db ($db_name, $_CONEXAO) ) )
	{
			echo "<blockquote style='color: red; border-left: solid 0.75em #FF0000;'>";
			echo "Connection data OK, error selecting database <b>$db_name</b>. Please check your data:[$username:".str_repeat("*", strlen($password))."->$db_name@$db_hostname:$port]. MSSQL return:<br>"; 
			echo mssql_get_last_message();
			echo "</blockquote>";
			exit;
	}

	function sqlexecuta ($conexao, $query, $fErroInt = 1)
	{ 
		if ( empty ($query) or ! ($conexao) ) 
		{
		 	return false;
		}
	
		if ( ($resultado = @mssql_query ($query, $conexao) ) ) return $resultado;
	}
}
?>
