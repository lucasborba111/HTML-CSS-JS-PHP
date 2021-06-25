<?php
   session_start();
   $conectar = mysqli_connect('localhost','root','');
   $banco = mysqli_select_db($conectar,'revenda');

   if(isset($_POST['bt_inserir'])){
            $codmodelo = $_POST['codmodelo'];
            $nome = $_POST['nome'];
            $codmarca = $_POST['codmarca'];
           
            $sql = "insert into modelos(codmodelo,nome,codmarca)
            values('$codmodelo','$nome','$codmarca')";

            $resultado = mysqli_query($conectar,$sql);

            if($resultado == 1){
            echo 'cadastro realizado!';
            }
            else{
            echo 'erro!';
            }
   }
?>
