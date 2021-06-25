<?php
   session_start();
   $conectar = mysqli_connect('localhost','root','');
   $banco = mysqli_select_db($conectar,'revenda');

   if(isset($_POST['bt_inserir'])){
    $login      = $_POST['login'];
    $senha      = $_POST['senha'];

   $error = 0;
   $query_select = "SELECT login FROM usuarios WHERE login = '$login'";
   $select = mysqli_query($conectar,$query_select);

   $array = mysqli_fetch_array($select);
   $logarray = $array['login'];

   if($login == "" || $login == null)
   {
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido...');
    window.location.href='intranet.html';</script>";

    }
    else
    {
        if($logarray == $login)
        {

        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login ja existe....');
        window.location.href='intranet.html';</script>";
        die();

        }
        
        else{
        $query = "INSERT INTO usuarios (login, senha)
                    VALUES ('$login','$senha')";
        echo "'$query;'";
        $insert = mysqli_query($conectar,$query);

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuario cadastrado com sucesso!');
          window.location.href='home.html'</script>";
        }
        else
        {
          echo"<script language='javascript' type='text/javascript'>
          alert('Nao foi possivel cadastrar esse usuario');
          window.location.href='intranet.html'</script>";
        }
      }
    }
  }
?>