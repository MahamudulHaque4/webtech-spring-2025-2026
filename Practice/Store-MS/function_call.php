<?php 

   function data_list($tablename, $column1, $column2){
    require ('connectiondb.php');

        $selectSql = "SELECT * FROM $tablename";
          $result = mysqli_query($connection, $selectSql);

    while($data = mysqli_fetch_assoc($result)){
                $data_id = $data[$column1];
                $data_name = $data[$column2];

                echo"<option value=$data_id>$data_name</option>";
               }
    }

?>