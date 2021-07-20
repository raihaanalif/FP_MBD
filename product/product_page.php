<!DOCTYPE html>
<html>
    <?php include('../fragments/header.php');?>
    <body>
    <?php include('../fragments/navs.php'); ?>
    <?php
        if(isset($_GET['create']))
        {
            if($_GET['create']=="berhasil"){
                echo "<div class='alert alert-success' role='alert' align='center'>Berhasil Menambahkan Data</div>";
            }
        }
        elseif(isset($_GET['edit'])){
            if($_GET['edit']=="berhasil"){
                echo "<div class='alert alert-success' role='alert' align='center'>Berhasil Merubah Data</div>";
            }
        }
        elseif(isset($_GET['delete'])){
            if($_GET['delete']=="berhasil"){
                echo "<div class='alert alert-success' role='alert' align='center'>Berhasil Menghapus Data</div>";
            }
        }
        elseif(isset($_GET['bayar'])){
            if($_GET['bayar']=="sukses"){
                echo "<div class='alert alert-success' role='alert' align='center'>Berhasil Membayar</div>";
            }
        }
    ?>
    <div class="container">
    <div class="jumbotron">
        <h1 class="display-4" style="text-align: center;">Produk</h1>
        <p class="lead" style="text-align: center;">Berikut ini merupakan katalog produk yang kami jual</p>
        <hr class="my-4">
        <form class="form-inline my-2 my-lg-0 row justify-content-center">
            <input type="search" class="form-control mr-sm-2" placeholder="Cari Nama Produk Disini" aria-label="Search" name="search">
            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Search</button>
        </form>
        <a href= "create_product_page.php" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true" style="color: white"></i></a>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Kategori</th>
                <th scope="col">Supplier</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            include '../config.php';
                
                if(isset($_GET['search'])){
                    $limit = 5;
                    $page = isset($_GET['page'])?(int)$_GET['page']:1;
                    $first_page = ($page>1)?($page * $limit) - $limit:0;

                    $previous = $page -1;
                    $next = $page + 1;
                    $search = $_GET['search'];
                    $data = pg_query($connect, "select * from products 
                                                join categories on products.category_id = categories.category_id
                                                join suppliers on products.supplier_id = suppliers.supplier_id
                                                where products.product_name like '%$search%'");
                    
                    $sum_data = pg_num_rows($data);
                    $total_data = ceil($sum_data/$limit);

                    $r_data = pg_query($connect,    "select * from products 
                                                    join categories on products.category_id = categories.category_id
                                                    join suppliers on products.supplier_id = suppliers.supplier_id
                                                    where products.product_name like '%$search%'
                                                    offset $first_page limit $limit");
                    
                }else{
                    $limit = 5;
                    $page = isset($_GET['page'])?(int)$_GET['page']:1;
                    $first_page = ($page>1)?($page * $limit) - $limit:0;

                    $previous = $page -1;
                    $next = $page + 1;
                    $data = pg_query($connect, "select * from products 
                                                join categories on products.category_id = categories.category_id
                                                join suppliers on products.supplier_id = suppliers.supplier_id");

                    $sum_data = pg_num_rows($data);
                    $total_data = ceil($sum_data/$limit);
                                    
                    $r_data = pg_query($connect,    "select * from products   
                                                    join categories on products.category_id = categories.category_id
                                                    join suppliers on products.supplier_id = suppliers.supplier_id
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
                            <td><?php echo $d['category_name']; ?></td>
                            <td><?php echo $d['company_name']; ?></td>
                            <td>
                                <a href="../transaction/transaction_check.php?id=<?php echo $d['product_id']?>" class="btn btn-success" role="button"><i class="fa fa-money"></i></>
                                <a href="edit_product_page.php?id=<?php echo $d['product_id']; ?>" class="btn btn-warning" role="button"><i class="fa fa-edit"></i></>
                                <a href="delete_product_page.php?id=<?php echo $d['product_id'];?>" class="btn btn-danger" role="button"><i class="fa fa-trash"></i></a>
                            </td>
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
    <?php include('../fragments/script.php'); ?>
  </body>
</html>