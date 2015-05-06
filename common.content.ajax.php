<?php
include_once ('db.vars.php');
include_once ('db.library.php');

$query = stripslashes($_GET['query']);
$query = str_replace ("\r\n", "\n", $query);
$query = str_replace ("\r", "\n", $query);
$query = str_replace ("\n\n", "\n", $query);
$query = str_replace ("\n", " ", $query);

/*
echo $query;
exit;
*/

if (! empty ($query))
{
	$resultado = sqlexecuta($_CONEXAO,$query,false);

	/////////////////////////////////////////////////////////
	//code to append table name on text file
	//this is used to put ten most used tables on left menu
	$query_nova = str_replace ("("," ",$query);
	$query_nova = str_replace (")"," ",$query_nova);
	$matrix_query = explode(" ",strtolower($query_nova));
	if ($chave = array_search('from',$matrix_query))
	{
		$tabela = $matrix_query[$chave+1];
		$tabela = trim ($tabela);
		if (! empty ($tabela))
		{
			$nome_arquivo = "php-query-analyzer-tables-used-in-selects";
			$manipulador = fopen ($nome_arquivo, "a+");
			fwrite ($manipulador, $tabela."\n");
			fclose ($manipulador);	
		}
	}
	/////////////////////////////////////////////////////////

	if ($resultado)	
	{
		$num_rows = @mssql_num_rows($resultado);

		if ($num_rows > 0)
		{
			$string_tela .= "<table>";

			while ($campo = mssql_fetch_array($resultado, MSSQL_ASSOC))
			{
				//impressão de chaves no topo
				if (++$i == 1)
				{
					$string_tela .=  "<tr class='rowH'>";
					
					foreach ($campo as $chave => $valor)
					{
						$matrix_chaves[] = $chave;
						$string_csv .= "$chave;";
						$string_tela .=  "<th><acronym title='Click to add ORDER BY $chave to the query...'><span style='cursor: pointer; text-decoration: underline;' onclick='setCode($(\"#textareaQuery\").val() + \" ORDER BY $chave\")'>$chave</span></acronym></th>";
					}
					$string_tela .=  "</tr>";
					$string_csv .= "\r\n";	
				}

				//$campo = array_unique($campo);
				//echo "<pre>"; print_r ($campo); exit;	

				$classetr = (is_int(++$i/2)) ? "rowA" : "rowB";
				$string_tela .=  "<tr class='classetr'>";								
				
				foreach ($matrix_chaves as $chave => $valor)
				{
					if (isset ($campo[$valor]))
					{
						$valor_impressao = (is_null ($campo[$valor])) ? "NULL" : $campo[$valor];
	
						$string_tela .=  "<td>".htmlentities($valor_impressao)."</td>";
						
						$string_csv .= $valor_impressao . ";";									
					}
					else
					{
						$string_tela .=  "<td>&nbsp;</td>";
						$string_csv .= ";"; 
					}
				}
				$string_csv .= "\r\n";
				$string_tela .=  "</tr>";
			}
			$string_tela .=  "</table>";

			//rotinas para exportação de resultados em CSV
			$nome_arquivo = "php-query-analyzer_csv-export_" . date ('d-m-Y-G\h-i\m\i\n') . ".csv";
			$caminho_arquivo = "php-query-analyzer-tempfile-for-csv-export";
			$manipulador = fopen ($caminho_arquivo, "w+");
			fwrite ($manipulador, $string_csv);
			fclose ($manipulador);	

			echo "<br><h3>$num_rows rows returned. <a href='DespejoArquivo.php?CaminhoArquivo=$caminho_arquivo&NomeArquivo=$nome_arquivo' target='_blank'>Download query results in CSV format</a></h3><br>";

			//echo "</table>";

			echo $string_tela;
		}
		else
		{
			echo "<br>";
			
			echo "	<blockquote style='color: 004A11; border-left: solid 0.75em #004A11;'>
						<b>I can feel it... Dave.</b><br><br>
						Query finished sucessfully and no rows was returned. I sincerly do hope it's expected.
					</blockquote>";
		}
	}
	else
	{
		echo "<br>";
		
		echo "<blockquote style='color: red; border-left: solid 0.75em #FF0000;'>
		<b>\"<i>It can only be attributable to human error, Dave.\"</i></b><br><br><b>MSSQL error message: </b><i>" . mssql_get_last_message() . "</i>";

		if (mssql_get_last_message() == "Unicode data in a unicode-only collation or ntext data cannot be sent to clients using DB-Library (such as ISQL) or ODBC version 3.7 or earlier.")
		{
			echo "<div style='color:black'><br>Dave, <b>PHP Query Analyzer</b> is showing this error because you are using column types of like <b>ntext</b> instead of <b>text</b>. There are 2 solutions:<br>
	1. Change all ntext column types to text (recommended) or<br>
	2. Your query must look like: SELECT CAST(field1 AS TEXT) AS field1 FROM table.<br><br>
	From <a href='http://www.php.net/function.mssql-query'>http://www.php.net/function.mssql-query</a> (huberkev11@hotmail.com at May-12-2006 08:47)</div>";
		}

		echo "<div style='color:black'><br>
				Sorry pal, but MSSQL only returns the last line of an error message, and it may not be enough to help you in debugging in some situations. Take a look <a href='http://www.php.net/manual/en/function.mssql-get-last-message.php'>here</a> to get more info, and please contact me if you have any idea about solving this issue.<br>
			</div>";

		echo "</blockquote>";
	}

	
}
				
?>
