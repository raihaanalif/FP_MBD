<!DOCTYPE html>
<html>
<?php 
include '../config.php';
include '../fragments/header.php';
?>
    <body>
        <?php include '../fragments/navs.php'?>
        <div class="container">
    <div class="jumbotron">
        <h1 class="display-4" style="text-align: center;">Hasil Transaksi</h1>
        <p class="lead" style="text-align: center;">Berikut adalah hasil transaksi yang telah dilakukan</p>
        <hr class="my-4">
        <form class="form-inline my-2 my-lg-0 row justify-content-center">
            <input type="search" class="form-control mr-sm-2" placeholder="Cari Data Transaksi Disini" aria-label="Search" name="search">
            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Search</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php
                
                if(isset($_GET['search'])){
                    $limit = 5;
                    $page = isset($_GET['page'])?(int)$_GET['page']:1;
                    $first_page = ($page>1)?($page * $limit) - $limit:0;

                    $previous = $page -1;
                    $next = $page + 1;
                    $search = $_GET['search'];
                    $data = pg_query($connect, "select * from order_details
                                                join orders on order_details.order_id = orders.order_id
                                                join products on products.product_id = order_details.product_id 
                                                where products.product_name like '%$search%'
                                                and orders.order_date >= '2020-01-01'::date");
                    
                    $sum_data = pg_num_rows($data);
                    $total_data = ceil($sum_data/$limit);

                    $r_data = pg_query($connect,    "select * from order_details
                                                    join orders on order_details.order_id = orders.order_id
                                                    join products on products.product_id = order_details.product_id 
                                                    where products.product_name like '%$search%'
                                                    and orders.order_date >= '2020-01-01'::date
                                                    offset $first_page limit $limit");
                    
                }else{
                    $limit = 5;
                    $page = isset($_GET['page'])?(int)$_GET['page']:1;
                    $first_page = ($page>1)?($page * $limit) - $limit:0;

                    $previous = $page -1;
                    $next = $page + 1;
                    $data = pg_query($connect, "select * from order_details
                                                join orders on order_details.order_id = orders.order_id
                                                join products on products.product_id = order_details.product_id
                                                where orders.order_date >= '2020-01-01'::date");

                    $sum_data = pg_num_rows($data);
                    $total_data = ceil($sum_data/$limit);
                                    
                    $r_data = pg_query($connect,    "select * from order_details
                                                    join orders on order_details.order_id = orders.order_id
                                                    join products on products.product_id = order_details.product_id
                                                    where orders.order_date >= '2020-01-01'::date   
                                                    offset $first_page limit $limit");
                }
                
                
                $no = $first_page + 1;
                while($d = pg_fetch_array($r_data))
                {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['product_name']; ?></td>
                            <td>$<?php echo $d['unit_price']; ?></td>
                            <td><?php echo $d['quantity']?></td>
                            <td><?php echo $d['order_date']; ?></td>
                        </tr>
                    <?php   
                }
            ?>     
            </tbody>
        </table>
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if($page > 1){ echo "href='?page=$previous'"; } ?>>Previous</a>
                    </li>
                    <li class="page-item">
                        <a  class="page-link" <?php if($page < $total_data) { echo "href='?page=$next'"; } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    </body>
</html>