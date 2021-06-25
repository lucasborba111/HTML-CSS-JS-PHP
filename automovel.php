<?php
   session_start();
   $conectar = mysqli_connect('localhost','root','');
   $banco = mysqli_select_db($conectar,'revenda');

   if(isset($_POST['bt_inserir'])){
            $codigo = $_POST['codautomovel'];
            $descricao = $_POST['descricao'];
            $modelo =  $_POST['codmodelo'];
            $categoria = $_POST['codcategoria'];
            $ano =  $_POST['ano'];
            $cor = $_POST['cor'];
            $placa = $_POST['placa'];
            $localizacao = $_POST['localizacao'];
            $tipocombustivel = $_POST['tipocombustivel'];
            $opcionais = $_POST['opcionais'];
            $valor = $_POST['valor'];
           

            $sql = "insert into automovel(codautomovel,descricao,codmodelo,codcategoria,ano,cor,placa,localizacao,tipocombustivel,opcionais,valor)
            values('$codigo','$descricao','$modelo','$categoria','$ano','$cor','$placa',' $localizacao','$tipocombustivel','$opcionais','$valor')";

            $resultado = mysqli_query($conectar,$sql);

            if($resultado == 1){
            echo 'cadastro realizado!';
            }
            else{
            echo 'erro!';
            }
   }

?>

