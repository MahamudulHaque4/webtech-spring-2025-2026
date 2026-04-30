<?php
require ('connectiondb.php');

if(isset($_GET['msg']) && $_GET['msg'] == 'updated'){
    echo "<script>alert('Product updated successfully!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>

<?php
//initialize variables 
$product_id = $product_name = $product_category = $product_code = $product_entry_date = "";

if (isset($_GET['id'])){
    $getid = $_GET['id'];

    $selectSql = "SELECT * FROM product WHERE product_id='$getid'";
    $result = mysqli_query($connection, $selectSql);

    if(mysqli_num_rows($result) > 0){
        $productData = mysqli_fetch_assoc($result);  //renamed variable

        $product_id = $productData['product_id'];
        $product_name = $productData['product_name'];
        $product_category = $productData['product_category'];
        $product_code = $productData['product_code'];
        $product_entry_date = $productData['product_entry_date'];
    } else {
        die("Invalid ID");
    }
}

$categorySql = "SELECT * FROM category";
$category_result = mysqli_query($connection, $categorySql);

if(isset($_POST['update'])){

    $new_product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
    $new_product_category = mysqli_real_escape_string($connection, $_POST['product_category']);
    $new_product_code = mysqli_real_escape_string($connection, $_POST['product_code']);
    $new_product_entry_date = mysqli_real_escape_string($connection, $_POST['product_entry_date']);
    $new_product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

    $updateSql = "UPDATE product 
                  SET product_name='$new_product_name',
                      product_category='$new_product_category',
                      product_code='$new_product_code',
                      product_entry_date='$new_product_entry_date'
                  WHERE product_id='$new_product_id'";

    $result1 = mysqli_query($connection, $updateSql);

    if ($result1) {
        header("Location: edit_product.php?id=$new_product_id&msg=updated");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}
?>

<form action="edit_product.php" method="POST">

    Product :<br/>
    <input type="text" name="product_name" value="<?php echo $product_name ?>"> <br/><br/>

    Product category :<br/>

    <select name="product_category">
        <?php 
        while($cat = mysqli_fetch_assoc($category_result)) {

            $category_id = $cat['category_id'];
            $category_name = $cat['category_name'];
        ?>
            <option value="<?php echo $category_id; ?>"
                <?php if($category_id == $product_category) echo "selected"; ?>>
                <?php echo $category_name; ?>
            </option>
        <?php } ?>
    </select>

    <br/><br/>

    Product code :<br/>
    <input type="text" name="product_code" value="<?php echo $product_code ?>"> <br/><br/>

    Product Entrydate : <br/>
    <input type="date" name="product_entry_date" value="<?php echo $product_entry_date ?>"> <br/><br/>

    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

    <input type="submit" name="update" value="Update">

</form>

</body>
</html>