<?php

require_once("phpmailer/class.phpmailer.php");

// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "Nenhum dado de contato informado!";
   return false;
   }
   
$name          = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone         = strip_tags(htmlspecialchars($_POST['phone']));
$message       = strip_tags(htmlspecialchars($_POST['message']));

$body          = "Nome:     ".$name          ."\n";
$body         .= "Email:    ".$email_address ."\n";
$body         .= "Telefone: ".$phone         ."\n";
$body         .= "Mensagem: ".$message       ."\n";
   
  $mailer = new PHPMailer();
  $mailer->IsSMTP();
  $mailer->SMTPDebug = 1;// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
  $mailer->Port      = 587; //Indica a porta de conexão
  $mailer->Host      = 'smtp.wgltec.com.br';//Endereço do Host do SMTP
  $mailer->SMTPAuth  = true; //define se haverá ou não autenticação
  $mailer->Username  = 'wesley@wgltec.com.br'; //Login de autenticação do SMTP
  $mailer->Password  = 'Nike@ir7665'; //Senha de autenticação do SMTP
  $mailer->FromName  = utf8_decode($name); //Nome que será exibido
  $mailer->From      = 'wesley@wgltec.com.br'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP
  $mailer->AddAddress('wesleylg01@gmail.com',utf8_decode($name));
  $mailer->AddAddress('wesley@wgltec.com.br',utf8_decode($name));
  
  //Destinatários
  $mailer->Subject   = utf8_decode('Fale Conosco - WGL tecnologia');
  $mailer->Body      = utf8_decode($body);
  
if(!$mailer->Send()){
       echo "<script>alert('Erro ao enviar :(, tente novamente');document.location='../index.html';</script>";
  }
  else{
    echo "<script>alert('Enviado com sucesso!');document.location='../index.html';</script>";
    //header("Location: ../index.html"); 
  }
?>