<?php
include("Database.php");

$id = $_GET['id'];

$d = new Database();
$ret = $d->update("DELETE FROM d_2000 WHERE id=$id");                        

if($ret){
    header("Location:index.php");
}else {
    return;
}
?>

