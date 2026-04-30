<?php
  require ('connectiondb.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>

    <?php
    if(isset($_POST['product_name'])){

        // For Data Entry test 
        // echo "<pre>";
        //   print_r($_POST);
        // echo "</pre>";

        $product_name = $_POST['product_name'];
        $product_category =  $_POST['product_category'];
        $product_code = $_POST['product_code'];
        $product_entry_date = $_POST['product_entry_date'];
        // echo $_GET['category_name'];
        // echo $_GET['category_entrydate'];

        $testSql = "INSERT INTO product (product_name,product_category,product_code,product_entry_date)
        VALUES ('$product_name','$product_category','$product_code','$product_entry_date')";

        // if ($connection->query($testSql) === TRUE) {
        //   echo "New record created successfully";
        // } else {
        //   echo "Error: " . $testSql . "<br>" . $connection->error;
        // }

        if (mysqli_query($connection, $testSql)) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $testSql . "<br>" . mysqli_error($connection);
        }
    }
    ?>

        <!-- Kon page e achi seta auto nite PHP er server variable use korte hbe <?php echo $_SERVER['PHP_SELF']; ?> -->

        <?php  
          $selectSql = "SELECT * FROM category";
          $result = mysqli_query($connection, $selectSql);
        ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">     
        Product :<br/>
        <input type="text" name="product_name"> <br/> <br/>  

        Product Category : <br/>
        <select name="product_category">
            <?php 
               while($data = mysqli_fetch_assoc($result)){
                 $category_id = $data['category_id'];
                 $category_name = $data['category_name'];

                 echo"<option value='$category_id'>$category_name</option>";
               }
            ?>
        </select><br/> <br/>

        Product Code : <br/>
        <input type="text" name="product_code"> <br/> <br/>

        Product Entrydate : <br/>
        <input type="date" name="product_entry_date"> <br/> <br/>

        <input type="submit" value="submit">
    </form>
</body>
</html>