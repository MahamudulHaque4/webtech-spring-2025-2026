<?php
require('connectiondb.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
</head>
<body>

<?php
$selectSql = "
SELECT product.*, category.category_name 
FROM product
LEFT JOIN category 
ON product.product_category = category.category_id
";

$result = mysqli_query($connection, $selectSql);

if(!$result){
    die("Query failed: " . mysqli_error($connection));
}
?>

<h2>Product List</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Code</th>
        <th>Action</th>
    </tr>

<?php
while($data = mysqli_fetch_assoc($result)) {

    $product_id = $data['product_id'];
    $product_name = $data['product_name'];
    $category_name = $data['category_name']; 
    $product_code = $data['product_code'];
?>
    <tr>
        <td><?php echo $product_id; ?></td>
        <td><?php echo $product_name; ?></td>


        <td><?php echo $category_name; ?></td>

        <td><?php echo $product_code; ?></td>

        <td>
            <a href="edit_product.php?id=<?php echo $product_id; ?>">Edit</a>

            <a href="delete_product.php?id=<?php echo $product_id; ?>">Delete</a>
            |
            <!-- <a onclick="return confirm('Are you sure?')" 
               href="delete_product.php?id=<?php echo $product_id; ?>">
               Delete
            </a> -->
        </td>
    </tr>
<?php
}
?>

</table>

</body>
</html>