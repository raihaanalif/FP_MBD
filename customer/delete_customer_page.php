<?php
include '../config.php';

$id = $_GET['id'];
$result=pg_query($connect, "delete from customers where customer_id = '$id'");

if(!$result){
    echo "Gagal di Hapus";
}else{
    header('location:customer_page.php?delete=berhasil');
}
?>