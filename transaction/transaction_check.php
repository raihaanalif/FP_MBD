<?php
session_start();
include '../config.php';
$sid = session_id();

$product_id = $_GET['id'];

$query = pg_query($connect, "select order_details.product_id from order_details
                             join orders on orders.order_id = order_details.order_id
                             where order_details.product_id = $product_id and order_details.session_id = '$sid'");
$find = pg_num_rows($query);
if($find == 0){
    pg_query($connect, "insert into orders (order_id, order_date)
                        values (nextval('sqc_order'), current_date)");
    $check = pg_query($connect, "insert into order_details (order_id, product_id, unit_price, quantity, discount, session_id)
                        values (nextval('sqc_orderdetail'), $product_id, (
                            select unit_price from products
                            where product_id = $product_id
                        ), 1, 0, '$sid')");
    

    if(!$check){
        echo "gagal memasukan data ke keranjang";
    }
    else{
        header('location:transaction_page.php');
    }
    
}
else{
    pg_query($connect, "update order_details 
                        set quantity = quantity + 1
                        where session_id='$sid' and product_id = $product_id");
    header('location:transaction_page.php');
    }
    
?>