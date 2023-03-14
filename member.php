<?php
    
    session_start();
    if(!isset($_SESSION["sess_user"]))
    {    
  
        header("Location: index.php");
    }

?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Panel</title>
</head>

<body>
    <section class="products" style="height: 300px">
    <h1>Stan magazynowy</h1>

    <?php
        require("connect.php");
        $sql = "SELECT * FROM products";
        $result = $pdo->query($sql);
    ?>

    <table style="background-color: gray;">
        <thead>
            <tr style="background-color: white; width: 25%;">
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr style="background-color: white; width: 25%;">
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars($row['amount']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </section>


    

        
    <section claas="warehouse">
    <h2> Przyjęcie towaru</h2>
        <form action="receiving.php" name="receiving" class="form" method="POST">
            <select name="rec_List" placeholder="Wybierz nazwę produktu">
                <?php
                $sql = "SELECT * FROM products";
                $result = $pdo->query($sql);
                while($row = $result->fetch(PDO::FETCH_ASSOC)) :
                $prod_name = $row['name'];
                $prod_id = $row['id'];
                echo "<option value='$prod_id'>$prod_name</option>";
            
                endwhile; ?>
            </select>
            <input 
                class="receive" 
                name="receive"
                type="text" 
                placeholder="Przyjęcia produktu" 
            />
            <button type="submit" class="add_btn1">Przyjmij</button>
        </form>

        <br>
        <h2> Wydanie towaru</h2>
        <form action="spending.php" name="spending" class="form" method="POST">
            <select name="spend_List" placeholder="Wybierz nazwę produktu">
                <?php
                $sql = "SELECT * FROM products";
                $result = $pdo->query($sql);
                while($row = $result->fetch(PDO::FETCH_ASSOC)) :
                $prod_name = $row['name'];
                $prod_id = $row['id'];
                echo "<option value='$prod_id'>$prod_name</option>";
            
                endwhile; ?>
            </select>
            <input 
                class="spend" 
                name="spend"
                type="text" 
                placeholder="Wydanie produktu" 
            />
            <button type="submit" class="add_btn1">Wydaj</button>
        </form>

        
            
        

        <form action="logout.php" name="logout" class="form" method="POST">
            <button type="submit" action="logout.php" class="add_btn1" style="padding: 20px">Wyloguj</button>
        </form>

    </section>
    <footer>
        <center><p>Damian Dudek</p></center>
    </footer>
</body>
</html>