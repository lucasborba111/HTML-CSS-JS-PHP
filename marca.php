<?php
   session_start();
   $conectar = mysqli_connect('localhost','root','');
   $banco = mysqli_select_db($conectar,'revenda');

   if(isset($_POST['bt_inserir'])){
            $codmarca = $_POST['codmarca'];
            $nome = $_POST['nome'];
           
            $sql = "insert into marcas(codmarca,nome)
            values('$codmarca','$nome')";

            $resultado = mysqli_query($conectar,$sql);

            if($resultado == 1){
            echo 'cadastro realizado!';
            }
            else{
            echo 'erro!';
            }
   }
?>
