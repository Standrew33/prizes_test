<?php
    include "globFunction.php";
    
    if($_GET['action'] == "out")
        LogOut();
            
    function Enter()
    {
        if ($_POST['login'] != "" && $_POST['password'] != "")
        { 		
        	$login = $_POST['login']; 
        	$password = $_POST['password'];
        
        	if ($login == "root" && $password == "12345")
        	{
        	    session_start();
        	    $guidId = globFunction::GUID();
        	    $_SESSION['id'] = $guidId;
        	    return null;
        	} 			
        	else
        	{ 				
        		$error = "Неверный логин или пароль"; 										
        		return $error; 			
        	} 		
        } 	
        else
        { 		
            $error = "Заполните поля!";
            return $error;
        } 
    }
    
    function Login()
    { 	
        ini_set("session.use_trans_sid", true);
        session_start();
        
        if (isset($_SESSION['id']))
            return true;
        else
            return false;
    }
    
    function LogOut(){
        session_start();
        unset($_SESSION['id']);
        $UID = null;
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/enter.php');
    }
    
    if (Login())
    {
    	$UID = $_SESSION['id'];
    	if ($_SERVER["REQUEST_URI"] == "enter.php")
    	    header("Location: index.php");
    }
    else if(isset($_POST['logIn'])) 
        if (enter() == null)
        {
            $UID = $_SESSION['id'];
            header("Location: index.php");
        }

    if(!$UID)
    {?>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>PrizeTest - Вход</title>
                <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,900" rel="stylesheet">
                <link rel="stylesheet" href="/css/style.css">
                <link rel="stylesheet" href="/css/media.css">
            </head>
        <body class="body body-enter">
           <div class="wrapper wrapper-flex">
               <div class="m-form__wrap">
                    <h1 class="m-form__title">
                        Добро пожаловать на розыгрыш<br>ПРИЗОВ
                    </h1>
                    <form class="m-form" action="" method="post">
                        <input type="text" name="login" placeholder="Логин" class="m-form__input"/><br>
                        <input type="password" name="password" placeholder="Пароль" class="m-form__input"/><br>
                        <input type="submit" value="Войти" name="logIn" class="m-form__btn"/>
                    </form>
                </div>    
           </div>
        </body>
        </html>
    <?}
?>