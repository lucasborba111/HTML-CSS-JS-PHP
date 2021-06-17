<?php
    // iniciar a sessão e conectar no servidor e database.
    session_start();
    $conectar = mysqli_connect('localhost','root','');
    $banco    = mysqli_select_db($conectar,'carro');

    // se clicou no botão cadastrar

if (isset($_POST['cadastrar']))
{
    $codusuario = $_POST['codusuario'];
    $nome       = $_POST['nome'];
    $login      = $_POST['login'];
    $senha      = $_POST['senha'];
    $foto       = $_FILES['foto'];  // anexar a foto na variavel

    $error = 0;
 
    // Se a foto estiver sido selecionada
    if (!empty($foto['name']))
    {
        // Largura maxima em pixels
       // $largura = 200;
        // Altura maxima em pixels
       // $altura = 200;
        // Tamanho maximo do arquivo em bytes
       // $tamanho = 5000;

        // Verifica se o arquivo nao e uma imagem (extensoes)
        if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/",$foto['type'])){
            $error[1] = "NAO é uma imagem...";
            }

        // capturar as dimensoes da imagem
        //$dimensoes = getimagesize($foto['tmp_name']);

        // Verifica se a largura da imagem maior que a largura permitida
       // if($dimensoes[0] > $largura) {
       //     $error[2] = "A largura da imagem nÃ£o deve ultrapassar ".$largura." pixels";
       // }

        // Verifica se a altura da imagem  maior que a altura permitida
       // if($dimensoes[1] > $altura) {
       //     $error[3] = "Altura da imagem nÃ£o deve ultrapassar ".$altura." pixels";
       // }

        // Verifica se o tamanho da imagem maior que o tamanho permitido
      //  if($foto['size'] > $tamanho) {
                //$error[4] = "A imagem deve ter no mÃ¡ximo ".$tamanho." bytes";
       // }

        // Se nao houver nenhum erro
        if ($error == 0)
        {
            // Pega extensao da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",$foto['name'],$ext);

            // Gera um nome unico para a imagem
            $nome_imagem = md5(uniqid(time())).".".$ext[1];

            // Caminho de onde armazena a imagem
            $caminho_imagem = "fotos/".$nome_imagem;

            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto['tmp_name'],$caminho_imagem);

   $query_select = "SELECT login FROM usuarios WHERE login = '$login'";
   $select = mysqli_query($conectar,$query_select);

   $array = mysqli_fetch_array($select);
   $logarray = $array['login'];

   if($login == "" || $login == null)
   {
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido...');
    window.location.href='cadusuario.htm';</script>";

    }
    else
    {
        if($logarray == $login)
        {

        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login ja existe....');
        window.location.href='cadusuario.htm';</script>";
        die();

        }
        
        else{
        $query = "INSERT INTO usuarios (codusuario, nome, login, senha, foto)
                    VALUES ('$codusuario','$nome','$login','$senha','$caminho_imagem')";
        echo "'$query;'";
        $insert = mysqli_query($conectar,$query);

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuario cadastrado com sucesso!');
          window.location.href='cadusuario.htm'</script>";
        }
        else
        {
          echo"<script language='javascript' type='text/javascript'>
          alert('Nao foi possivel cadastrar esse usuario');
          window.location.href='cadusuario.htm'</script>";
        }
      }
    }
    }
    }
}
?>