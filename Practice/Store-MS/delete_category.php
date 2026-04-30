<?php
require('connectiondb.php');

$category_id = $category_name = "";


if (!isset($_GET['id'])) {
    header("Location: categorylist.php");
    exit;
}

$getid = (int) $_GET['id']; // safer

$selectSql = "SELECT * FROM category WHERE category_id=$getid";
$result = mysqli_query($connection, $selectSql);

if (mysqli_num_rows($result) > 0) {
    $categoryData = mysqli_fetch_assoc($result);
    $category_id = $categoryData['category_id'];
    $category_name = $categoryData['category_name'];
} else {
    header("Location: categorylist.php");
    exit;
}

if (isset($_POST['delete'])) {

    $id = (int) $_POST['category_id'];

    $deleteSql = "DELETE FROM category WHERE category_id=$id";
    $result1 = mysqli_query($connection, $deleteSql);

    if (!$result1) {
        die("SQL ERROR: " . mysqli_error($connection));
    }

    // redirect after delete
    header("Location: categorylist.php?deleted=1");
    exit;
}
?>

<form action="" method="POST">

    Category:<br/>
    <input type="text" value="<?php echo $category_name ?>" readonly>
    <br/><br/>

    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">

    <input type="submit" name="delete" value="Delete"
       onclick="return confirm('Are you sure you want to delete this category?');">

    <button type="button" onclick="window.location.href='categorylist.php'">
        Cancel
    </button>

</form>