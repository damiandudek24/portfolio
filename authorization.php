<?php 
	require("connect.php");

	if(isset($_POST['login']) && isset($_POST['password']))
	{
		$f_login = $_POST['login'];
		$f_password = md5($_POST['password']);
	}

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
                    echo "zalogowano";
                    header("Location: entry.php");
                    die();
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

?>
