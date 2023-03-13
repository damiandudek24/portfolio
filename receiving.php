<?php

    session_start();
    if(!isset($_SESSION["sess_user"])){    
  
        header("Location: index.php");

    }

	if(isset($_POST['receive']) && isset($_POST['rec_List']))
	{
        require("connect.php");

		$f_receive = $_POST['receive'];
		$f_id_product = $_POST['rec_List'];
        #echo "".$f_receive." ".$f_id_product;

    

        $sql = "SELECT id FROM users WHERE login= :s_login";
        $result = $pdo->prepare($sql);
        $result->bindParam(':s_login', $_SESSION["sess_user"], PDO::PARAM_INT);
        $result->execute();
        $id = $result->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT amount FROM products WHERE id = :s_id";
        $result = $pdo->prepare($sql);
        $result->bindParam(':s_id',  $f_id_product, PDO::PARAM_INT);
        $result->execute();
        $amount = $result->fetch(PDO::FETCH_ASSOC);
        $amount_var = $amount['amount'];
        #echo "amount po select ".$amount_var;
        $amount_var = $amount_var + $f_receive;
        #echo "amount po dodaniu ".$amount_var;
       
        $sql = "UPDATE products SET amount=? WHERE id=?";
        $result= $pdo->prepare($sql);
        $result->execute([$amount_var, $f_id_product]);

        $sql = "INSERT INTO warehouseop (prodid, userid, operation, value, date) VALUES (?,?,?,?,?)";
	    $result = $pdo->prepare($sql);
        #$id =1;
        $operation = "receive";
        $today = date("Y-m-d");
        $result->execute([$f_id_product, $id['id'], $operation, $f_receive, $today]);


        header("Location: member.php");


	}






?>