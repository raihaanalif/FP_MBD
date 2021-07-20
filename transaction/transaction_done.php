<?php
session_start();
include '../config.php';
$sid = session_id();

function trolley(){
    $fill = array();
    $sid = session_id();
    $query = pg_query("select * from order_details where session_id = '$sid'");

    while($g = pg_fetch_array($query)){
        $fill[] = $g;
    }
    return $fill;
}

$fill = trolley();
$sum = count($fill);

// for ($i = 0; $i<$sum; $i++){
//     $cek = pg_query("insert into order_details (order_id, product_id, unit_price, discount, quantity)
//              values ({$fill[$i]['order_id']}, {$fill[$i]['product_id']}), {$fill[$i]['unit_price']}, 0, {$fill[$i]['quantity']}");

//     if(!$cek){
//         echo "gagal menyimpan";
//     }
    
// }
// for($i = 0; $i<$sum; $i++){
//     pg_query("delete from order_details 
//              where session_id = '$sid'");
// }

session_regenerate_id();
header('location:../product/product_page.php?bayar=sukses');

?>