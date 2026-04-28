<?php
  require ('connectiondb.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>

    <?php
    if(isset($_GET['category_name'])){
        $category_name = $_GET['category_name'];
        $category_entrydate = $_GET['category_entrydate'];
        // echo $_GET['category_name'];
        // echo $_GET['category_entrydate'];

        $testSql = "INSERT INTO category (category_name,category_entrydate)
        VALUES ('$category_name','$category_entrydate')";

        if ($connection->query($testSql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $testSql . "<br>" . $connection->error;
        }
    }
    ?>


    <form action="add_category.php" method="GET">
        Category :<br/>
        <input type="text" name="category_name"> <br/> <br/>

        Category Entrydate : <br/>
        <input type="date" name="category_entrydate"> <br/> <br/>

        <input type="submit" value="submit">
    </form>
</body>
</html>