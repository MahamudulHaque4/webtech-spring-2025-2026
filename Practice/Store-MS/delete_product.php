<?php
require ('connectiondb.php');

if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'){
    echo "<script>alert('Product deleted successfully!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
</head>
<body>

<?php
// initialize variables 
$product_id = $product_name = $product_category = $product_code = $product_entry_date = "";

if (isset($_GET['id'])){
    $getid = $_GET['id'];

    $selectSql = "SELECT * FROM product WHERE product_id='$getid'";
    $result = mysqli_query($connection, $selectSql);

    if(mysqli_num_rows($result) > 0){
        $productData = mysqli_fetch_assoc($result);

        $product_id = $productData['product_id'];
        $product_name = $productData['product_name'];
        // $product_category = $productData['product_category'];
        $product_code = $productData['product_code'];
        // $product_entry_date = $productData['product_entry_date'];
    } else {
        die("Invalid ID");
    }
}

$categorySql = "SELECT * FROM category";
$category_result = mysqli_query($connection, $categorySql);

if(isset($_POST['delete'])){

    $id = $_POST['product_id'];

    if(!empty($id)){

        $deleteSql = "DELETE FROM product WHERE product_id='$id'";
        $result1 = mysqli_query($connection, $deleteSql);

        if ($result1) {
            header("Location: product_list.php?msg=deleted");
            exit;
        } else {
            echo "Error deleting record: " . mysqli_error($connection);
        }

    } else {
        echo "Invalid Product ID";
    }
}
?>

<form action="delete_product.php" method="POST">

    Product :<br/>
    <input type="text" value="<?php echo $product_name ?>" readonly> 
    <br/><br/>

    <!-- Product category :<br/>

    <select disabled>
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

    <br/><br/> -->

    Product code :<br/>
    <input type="text" value="<?php echo $product_code ?>" readonly> 
    <br/><br/>

    <!-- Product Entrydate : <br/>
    <input type="date" value="<?php echo $product_entry_date ?>" readonly> 
    <br/><br/> -->

    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

    <input type="submit" name="delete" value="Delete"
       onclick="return confirm('Are you sure?')"
    > 

    <a href="product_list.php">
      <button type="button">Cancel</button>
    </a>

</form>

</body>
</html>