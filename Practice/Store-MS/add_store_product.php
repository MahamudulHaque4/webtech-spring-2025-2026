<?php
  require ('connectiondb.php');
  require ('function_call.php');  

  if(isset($_GET['msg']) && $_GET['msg'] == 'added'){
    echo "<script>alert('Your product was added successfully!');</script>";
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Product</title>
</head>
<body>

    <?php
    if(isset($_POST['store_product_name'])){

        $store_product_name = $_POST['store_product_name'];
        $store_product_amount = $_POST['store_product_amount'];
        $store_product_entry_date = $_POST['store_product_entry_date'];

        $testSql = "INSERT INTO store_product (store_product_name,store_product_amount,store_product_entry_date)
        VALUES ('$store_product_name','$store_product_amount','$store_product_entry_date')";

        if (mysqli_query($connection, $testSql)) {
          header("Location: add_store_product.php?msg=added");
          exit;
        } else {
          echo "Error: " . $testSql . "<br>" . mysqli_error($connection);
        }
    }
    ?>

    <!-- Kon page e achi seta auto nite PHP er server variable use korte hbe <?php echo $_SERVER['PHP_SELF']; ?> -->

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">     

        Product : <br/>
        <select name="store_product_name">
            <?php 
              data_list('product','product_id','product_name'); 
            ?>
        </select><br/> <br/>

        Product Amount : <br/>
        <input type="text" name="store_product_amount"> <br/> <br/>

        Store Entrydate : <br/>
        <input type="date" name="store_product_entry_date"> <br/> <br/>

        <input type="submit" value="submit">
    </form>
</body>
</html>