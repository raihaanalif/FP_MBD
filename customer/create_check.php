<?php
include '../config.php';

$company_name = $_POST['company_name'];
$contact_name = $_POST['contact_name'];
$city = $_POST['city'];
$country = $_POST['country'];
$phone = $_POST['phone'];

$check = pg_query($connect, "insert into customers(customer_id, company_name, contact_name, city, country, phone) 
                            values ('CID'|| nextval('sqc_supplier'::regclass), '$company_name', '$contact_name', '$city', '$country', '$phone')");

if(!$check){
    echo "gagal memuat data";
}
else{
    header("location:customer_page.php?create=berhasil");
}
?>