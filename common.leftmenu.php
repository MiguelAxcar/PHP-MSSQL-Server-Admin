<div id="secondaryContent" style='overflow: hidden'>

	<?php

	//showing hostname
	echo "<h2>$username on $db_name<br>@ $db_hostname</h2><br>";

	//most used tables
	$matrox = file("php-query-analyzer-tables-used-in-selects");
	$matrox = array_count_values($matrox);
	arsort($matrox);
	$matrox = array_slice($matrox, 0, 15);


	if (count($matrox) > 1)
	{
		echo "<h3>15 most used tables - <span onclick='clear_most_used_tables()' style='cursor: pointer; text-decoration: underline;'>clear</span></h3>";
		echo "<ul>";
		
		foreach ($matrox as $chave => $valor)
		{
			$nome_tabela = trim($chave);
			echo "<li><a onclick='textareaQuery.setCode(\"SELECT TOP 10 * FROM $nome_tabela\"); carrega(\"SELECT TOP 10 * FROM $nome_tabela\")'><acronym title='$nome_tabela'>$nome_tabela</acronym></a></li>";
		}
		echo "</ul><br>";
	}

	$query = "USE {$db_name}; SELECT * FROM information_schema.tables WHERE table_type='BASE TABLE'";
	$resultado = sqlexecuta($_CONEXAO,$query);
	$num_rows = mssql_num_rows ($resultado);

	echo "<h3>$num_rows</b> tables available</h3>";
	echo "<div id='lista-tabelas'>";
	echo "<input placeholder='Filter Tables' type='text' class='fuzzy-search' />";
	echo "<ul class='list'>";

	while($campo = mssql_fetch_array($resultado))
	{
		$nome_tabela = $campo['TABLE_NAME'];
		echo "<li><a onclick='textareaQuery.setCode(\"SELECT TOP 10 * FROM $nome_tabela\"); carrega(\"SELECT TOP 10 * FROM $nome_tabela\")'><acronym title='$nome_tabela' class='name'>$nome_tabela</acronym></a></li>";
	}
	echo "</ul>";
	echo "</div>";
	?>
	<div class="xbg"></div>
</div>	

<script>
jQuery(document).ready(function($) {
	var listaTabelas = new List('lista-tabelas', { 
	  valueNames: ['name'], 
	  plugins: [ ListFuzzySearch() ] 
	});
});
</script>
