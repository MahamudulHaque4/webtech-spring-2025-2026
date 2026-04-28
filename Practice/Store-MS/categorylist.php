<?php
    require ('connectiondb.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
</head>
<body>
    <?php
    $selectSql = "SELECT * FROM category";

    $result = mysqli_query($connection, $selectSql);  //Query Select

    if(!$result){
        die("Query failed: " . mysqli_error($connection));
    }
    ?>
    <h2> Category List </h2>
    <table border="1" >
     <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Action</th>
     </tr>  

     <?php
      while($row = mysqli_fetch_assoc($result)) {

      $category_id = $row['category_id'];
      $category_name = $row['category_name'];
      $category_entrydate = $row['category_entrydate'];
     ?>

     <tr>
        <td><?php echo $row['category_id']; ?> </td>
        <td><?php echo $row['category_name']; ?> </td>
        <td><?php echo $row['category_entrydate']; ?> </td>
        <td>
           <a href="edit_category.php?id=<?php echo $category_id; ?>">Edit</a>
        </td>
     </tr>
    <?php
        }
        ?>

    </table>
    
</body>
</html>