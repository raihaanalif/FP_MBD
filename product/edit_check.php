<?php
include '../config.php';

$id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$unit_price = $_POST['unit_price'];
$category = $_POST['category_name'];
$company = $_POST['company_name'];

$id_category = pg_query("select * from categories where category_name like '%$category%'");
while($s = pg_fetch_array($id_category)){
    $idc = $s['category_id'];
}

$id_company = pg_query("select * from suppliers where company_name like '%$company%'");
while($c = pg_fetch_array($id_company)){
    $ids = $c['supplier_id'];
}

$check = pg_query($connect, "update products set product_name = '$product_name',
                                                 unit_price = $unit_price,
                                                 supplier_id = $ids,
                                                 category_id = $idc
                                                 where product_id = $id");

if(!$check){
    echo "gagal mengedit data";
}
else{
    header("location:product_page.php?edit=berhasil");
}
?>