
<?php 
	require("connect.php");

	if(isset($_POST['login']) && isset($_POST['password']))
	{
        $f_login = $_POST['login'];
        $f_password = md5($_POST['password']);
        

        $sql = "SELECT login, password FROM users";
        $result = $pdo->query($sql);

        
        if ($result->rowCount() > 0) 
        {
            foreach ($result as $db_login)
            {
                if($db_login['login']==$f_login)
                {
                    if($db_login['password']==$f_password)
                    {
                        session_start();  
                        $_SESSION['sess_user']=$f_login;  
                        header("Location: member.php");  
                    }  
                    else
                    {
                        echo "Błędne hasło";
                    } 
                }
                else 
                {
                    echo "Nie ma takiego użytkownika";
                }
            }
        }
        else
        {
            echo "Nie ma użytkowników!";
        }
    }
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Logowanie</title>
</head>

<body>
    <section class="login_bar">
    <center>
        <h1>Logowanie</h1>
        <form action="" class="login_form" method="POST">
            <input 
                class="login" 
                name="login"
                type="text" 
                placeholder="Login: " 
                required
            />
            <input 
                class="password" 
                name="password"
                type="password" 
                placeholder="Hasło: " 
                required
            />
            <button type="submit" class="add_btn">Zaloguj</button>
        </form>
    </center>
    </section>
</body>
</html>