<?php 

$endereco_arquivo = $_GET['CaminhoArquivo'];
$nome_arquivo = $_GET['NomeArquivo'];

$handle = fopen($endereco_arquivo, "r");
$conteudo = fread ($handle, filesize ($endereco_arquivo));
fclose($handle); 

header("Content-Type: application/save");
header("Content-Length: $tamanho");
header("Content-Disposition: attachment; filename={$nome_arquivo}");

echo $conteudo;

exit;

?>
