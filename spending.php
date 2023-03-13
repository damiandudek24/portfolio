<?php

    session_start();
    if(!isset($_SESSION["sess_user"])){    
  
        header("Location: index.php");

    }

	if(isset($_POST['spend']) && isset($_POST['spend_List']))
	{
        require("connect.php");

		$f_spend = $_POST['spend'];
		$f_id_product = $_POST['spend_List'];
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
        $amount_var = $amount_var - $f_spend;
        #echo "amount po dodaniu ".$amount_var;
       
        $sql = "UPDATE products SET amount=? WHERE id=?";
        $result= $pdo->prepare($sql);
        $result->execute([$amount_var, $f_id_product]);

        $sql = "INSERT INTO warehouseop (prodid, userid, operation, value, date) VALUES (?,?,?,?,?)";
	    $result = $pdo->prepare($sql);
        #$id =1;
        $operation = "spend";
        $today = date("Y-m-d");
        $result->execute([$f_id_product, $id['id'], $operation, $f_spend, $today]);


        header("Location: member.php");


	}






?>