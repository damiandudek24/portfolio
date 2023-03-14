
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    
    <title>Logowanie</title>
</head>

<body>
    <section id="top_sec">
        <header>
                <img src="db.png" style="height: 50px; width:70px;"/>eMAGAZYN
        </header>
    </section>
    <section id="bot_sec">
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
                <br><br>
                <input 
                    class="password" 
                    name="password"
                    type="password" 
                    placeholder="Hasło: " 
                    required
                />
                <br><br>
                <button type="submit" class="add_btn">Zaloguj</button>
            </form>
        </center>
        </section>
    </section>

    <footer class="footer">
            <center><p>Damian Dudek</p></center>
    </footer>
</body>
</html>