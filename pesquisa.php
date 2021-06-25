<?php

$host = "localhost";
$user = "root";
$pass = "";
$banco = "revenda";
$conectar = mysqli_connect($host, $user, $pass, $banco) or die ("Erro ao conectar-se");
mysqli_select_db($conectar, $banco) or die ("Não foi possível selecionar o banco");

//------- pesquisa marcas

$sql_marcas = "SELECT * FROM marcas ";
$pega_marcas = mysqli_query($conectar,$sql_marcas);

//------- pesquisa modelos
$sql_modelos = "SELECT * FROM modelos ";
$pega_modelos = mysqli_query($conectar,$sql_modelos);

//------- falta ainda a pesquisa categorias ??????




if(!empty($_POST['pesquisar']))
{
$marca  = (empty($_POST['marca']))? 'null' : $_POST['marca'];

$modelo = (empty($_POST['modelo']))? 'null' : $_POST['modelo'];

// falta a pesquisa categoria....


if (($marca <> 'null') and ($modelo == 'null'))
{
     $sql_veiculos = "SELECT automovel.descricao,automovel.cor,automovel.ano,automovel.valor, automovel.foto1
                      FROM automovel, modelos, marcas
                      WHERE automovel.codmodelo = modelos.codmodelo and
                      modelos.codmarca = marcas.codmarca and
                      modelos.codmarca = $marca ";
     $seleciona_veiculos = mysqli_query($conectar,$sql_veiculos);
}
else
{
if (($marca == 'null') and ($modelo == 'null'))
{
       $sql_veiculos = "SELECT descricao,cor,ano,valor, foto1 FROM automovel order by descricao";
       $seleciona_veiculos = mysqli_query($conectar,$sql_veiculos);
}
else
{
     $sql_veiculos = "SELECT descricao,cor,ano,valor, foto1 FROM automovel
                      WHERE codmodelo = $modelo";
     $seleciona_veiculos = mysqli_query($conectar,$sql_veiculos);
}
}
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Pesquisar: </title>
</head>
<body>
<form name="form" action="pesquisa.php" method="post" enctype="multipart/form-data">

<span></span>
Marcas: <select name="marca">
<option value="" selected="selected">Selecione a marca ...</option>
<?php
if(mysqli_num_rows($pega_marcas) == 0)
{
   echo '<option value="0"> Escolha uma marca ... </option>';
}
else
{
while($linha = mysqli_fetch_array($pega_marcas))
{
echo '<option value="'.$linha['codmarca'].'">'.utf8_encode($linha['nome']).'</option>';
}
}
?>
</select>


<span></span>
Modelos: <select name="modelo">
<option value="" selected="selected">Selecione o modelo ...</option>
<?php
if(mysqli_num_rows($pega_modelos) == 0)
{
echo '<option value="0">Escolha um modelo ... </option>';
}
else
{
while($linha = mysqli_fetch_array($pega_modelos))
{
echo '<option value="'.$linha['codmodelo'].'">'.utf8_encode($linha['nome']).'</option>';
}
}
?>
</select>

<br><br>
<input type="submit" name="pesquisar" value="pesquisar" /><br>
</form>

<hr>

<?php
if(!empty($_POST['pesquisar']))
{
if(mysqli_num_rows($seleciona_veiculos) == 0)
{
echo '<h1>Desculpe, mas sua busca nao retornou resultados ... </h1>';
}
else
{
echo "<Table>";
while($resultado = mysqli_fetch_array($seleciona_veiculos))
{
echo '<td width="200">'.utf8_encode($resultado['descricao']).
   ' Cor : '.utf8_encode($resultado['cor']).
   ' Ano : '.utf8_encode($resultado['ano']).
   ' Valor R$: '.utf8_encode($resultado['valor']).'</td>';
echo '<td> '.utf8_encode('<img src="fotos/'.$resultado['foto1'].'"  height="100" width="100" />').'</td>';
}
echo "</table>";
}
}
?>
</body>
</html>
