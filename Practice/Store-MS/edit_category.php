<?php
  require ('connectiondb.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>

    <?php
    if (isset($_GET['id'])){
        $getid = $_GET['id'];

        $selectSql = " SELECT * FROM category WHERE category_id='$getid'  ";

        $result = mysqli_query($connection, $selectSql);

        if(mysqli_num_rows($result) > 0){
           $data = mysqli_fetch_assoc($result);

           $category_id = $data['category_id'];
           $category_name = $data['category_name'];
           $category_entrydate = $data['category_entrydate'];
        } else {
           die("Invalid ID");
        }
    }

    if(isset($_POST['update'])){

    $new_category_name = mysqli_real_escape_string($connection, $_POST['category_name']);
    $new_category_entrydate = mysqli_real_escape_string($connection, $_POST['category_entrydate']);
    $new_category_id = mysqli_real_escape_string($connection, $_POST['category_id']);

    $updateSql = "UPDATE category 
                  SET category_name='$new_category_name',
                      category_entrydate='$new_category_entrydate'
                  WHERE category_id='$new_category_id'";

    $result = mysqli_query($connection, $updateSql);

     if ($result) {
        echo "Record updated successfully";
     } else {
        echo "Error updating record: " . mysqli_error($connection);
     }
    }
    ?>


    <form action="edit_category.php" method="POST">
        Category :<br/>
        <input type="text" name="category_name" value="<?php echo $category_name ?>"> <br/> <br/>

        Category Entrydate : <br/>
        <input type="date" name="category_entrydate" value="<?php echo $category_entrydate ?>"> <br/> <br/>

        <input type="hidden" name="category_id" value="<?php echo isset($category_id) ? $category_id : ''; ?>">

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>