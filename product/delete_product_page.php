<?php
include '../config.php';

$id = $_GET['id'];
$result=pg_query($connect, "delete from products where product_id = $id");

if(!$result){
    echo "Gagal di Hapus";
}else{
    header('location:product_page.php?delete=berhasil');
}
?>