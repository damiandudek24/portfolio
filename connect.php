<?php

//Łączenie z bazą danych
$servername = "localhost";
$username = "${{ secrets.PASS1 }}";
$password = "${{ secrets.PASS2 }}";
$my_db    = "${{ secrets.PASS3 }}";
$port = '3306'; //domyślnie jest to port 3306

try{
$pdo = new PDO('mysql:host='.$servername.';dbname='.$my_db.';port='.$port, $username, $password );
$pdo -> query ('SET NAMES utf8');
$pdo -> query ('SET CHARACTER_SET utf8_unicode_ci');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//end Łączenie z bazą danych
}
catch(PDOException $e) 
{
    echo "Error Błąd połączenia z bazą danych". $e->getMessage();
}

?>
