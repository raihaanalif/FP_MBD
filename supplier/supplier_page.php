<!DOCTYPE html>
<html>
    <?php include('../fragments/header.php');?>
    <body>
    <?php include('../fragments/navs.php'); ?>
    <div class="container">
    <div class="jumbotron">
        <h1 class="display-4" style="text-align: center;">Supplier</h1>
        <p class="lead" style="text-align: center;">Berikut merupakan daftar nama supplier yang telah bekerjasama dengan kami</p>
        <hr class="my-4">
        <form class="form-inline my-2 my-lg-0 row justify-content-center">
            <input type="search" class="form-control mr-sm-2" placeholder="Cari Nama Supplier Disini" aria-label="Search" name="search">
            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Search</button>
        </form>
        <!-- <a href= "create_product_page.php" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true" style="color: white"></i></a> -->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Supplier</th>
                <th scope="col">Alamat</th>
                <th scope="col">Kota</th>
                <th scope="col">Negara</th>
                <th scope="col">Nomor Telepon</th>
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
                    $data = pg_query($connect, "select * from suppliers 
                                                where company_name like '%$search%'");
                    
                    $sum_data = pg_num_rows($data);
                    $total_data = ceil($sum_data/$limit);

                    $r_data = pg_query($connect, "select * from suppliers 
                                                  where company_name like '%$search%'
                                                  offset $first_page limit $limit");
                    
                }else{
                    $limit = 5;
                    $page = isset($_GET['page'])?(int)$_GET['page']:1;
                    $first_page = ($page>1)?($page * $limit) - $limit:0;

                    $previous = $page -1;
                    $next = $page + 1;
                    $data = pg_query($connect, "select * from suppliers");

                    $sum_data = pg_num_rows($data);
                    $total_data = ceil($sum_data/$limit);
                                    
                    $r_data = pg_query($connect, "select * from suppliers offset $first_page limit $limit");
                }
                
                
                $no = $first_page + 1;
                while($d = pg_fetch_array($r_data))
                {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['company_name']; ?></td>
                            <td><?php echo $d['address']; ?></td>
                            <td><?php echo $d['city']; ?></td>
                            <td><?php echo $d['country']; ?></td>
                            <td><?php echo $d['phone']; ?></td>
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