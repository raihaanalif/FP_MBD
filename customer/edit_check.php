<?php
include '../config.php';

$id = $_POST['customer_id'];
$company_name = $_POST['company_name'];
$contact_name = $_POST['contact_name'];
$city = $_POST['city'];
$country = $_POST['country'];
$phone = $_POST['phone'];


$check = pg_query($connect, "update customers set company_name = '$company_name',
                                                 contact_name = '$contact_name',
                                                 city = '$city',
                                                 country = '$country',
                                                 phone = '$phone'
                                                 where customer_id = '$id'");

if(!$check){
    echo "gagal mengedit data";
}
else{
    header("location:customer_page.php?edit=berhasil");
}
?>