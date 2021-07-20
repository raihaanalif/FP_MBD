<!DOCTYPE html>
<html>
    <?php
    session_start();
    $sid = session_id();
    include '../config.php'; 
    include('../fragments/header.php');
    global $total;
    ?>
    <body>
    <?php include('../fragments/navs.php'); ?>
    <div class="container">
    <div class="jumbotron">
        <h1 class="display-4" style="text-align: center;">Keranjang</h1>
        <p class="lead" style="text-align: center;">Berikut merupakan daftar yang sudah anda order</p>
        <hr class="my-4">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $query = pg_query($connect, "select * from order_details
                                         join orders on order_details.order_id = orders.order_id
                                         join products on products.product_id = order_details.product_id
                                         where order_details.session_id = '$sid'");
            while($d = pg_fetch_array($query)){
                $subtotal = $d['unit_price'] * $d['quantity'];
                $total = $total + $subtotal;
                $no = 1;
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['product_name']; ?></td>
                    <td><?php echo $d['quantity']; ?></td>
                    <td>$<?php echo $d['unit_price']?></td>
                    <td>$<?php echo $subtotal; ?></td>
                </tr>
                <?php
            }
            ?>     
            </tbody>
        </table>
        <p class="lead" style="text-align: center;">Total Belanja: <b>$<?php echo $total?></b></p>
        <a href="../product/product_page.php" class="btn btn-warning"><i class="fa fa-plus"></i></a>
        <a href="transaction_done.php" class="btn btn-success"><i class="fa fa-check-circle"></i></a>
        </div>
    </div>
    <?php include('../fragments/script.php'); ?>
  </body>
</html>