<?php
  require ('connectiondb.php');

  if(isset($_GET['msg']) && $_GET['msg'] == 'added')
    {
        echo "<script>
        alert('Category added successfully!');
        </script>";
    }
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
    if(isset($_POST['category_name'])){
        $category_name = $_POST['category_name'];
        $category_entrydate = $_POST['category_entrydate'];
        // echo $_GET['category_name'];
        // echo $_GET['category_entrydate'];

        $testSql = "INSERT INTO category (category_name,category_entrydate)
        VALUES ('$category_name','$category_entrydate')";

       if ($connection->query($testSql) === TRUE) {
            header("Location: add_category.php?msg=added");
            exit;
        } else {
            echo "Error: " . $connection->error;
        }
    }
    ?>


    <form action="add_category.php" method="POST">
        Category :<br/>
        <input type="text" name="category_name"> <br/> <br/>

        Category Entrydate : <br/>
        <input type="date" name="category_entrydate"> <br/> <br/>

        <input type="submit" value="Add">
    </form>
</body>
</html>