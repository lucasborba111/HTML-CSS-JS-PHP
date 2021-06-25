<?php
   session_start();
   $conectar = mysqli_connect('localhost','root','');
   $banco = mysqli_select_db($conectar,'revenda');

   if(isset($_POST['bt_inserir'])){
            $codcategoria = $_POST['codcategoria'];
            $nome = $_POST['nome'];
           
            $sql = "insert into categorias(codcategoria,nome)
            values('$codcategoria','$nome')";

            $resultado = mysqli_query($conectar,$sql);

            if($resultado == 1){
            echo 'cadastro realizado!';
            }
            else{
            echo 'erro!';
            }
   }
?>

