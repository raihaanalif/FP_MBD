<DOCTYPE html>
<html>
    <?php 
    include('../fragments/header.php');
    include('../config.php') 
    ?>
    <body>
    <?php include('../fragments/navs.php'); ?>
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4" style="text-align: center;">Tambahkan Produk</h1>
                <p class="lead" style="text-align: center;">Berikut ini merupakan form untuk menambah produk</p>
                <hr class="my-4">
                <?php
                $id=$_GET['id'];
                $old=pg_query($connect, "select * from products
                                         join categories on products.category_id=categories.category_id
                                         join suppliers on products.supplier_id=suppliers.supplier_id 
                                         where product_id = '$id'");
                while($o = pg_fetch_array($old)){
                ?>
                <form action="edit_check.php" method="post">
              <div class="form-group">
                <input type="hidden" name="product_id" value="<?php echo $o['product_id'];?>">
                <input type="text" name="product_name" placeholder="Masukan Nama Produk" class="form-control" value="<?php echo $o['product_name']?>" required>
              </div>
              <div class="form-group">
                <input type="number" name="unit_price" placeholder="Masukan Harga" class="form-control" value="<?php echo $o['unit_price']?>"required>
              </div>
              <div class="form-group">
                <input class="form-control" name="category_name" list="category_name" placeholder="<?php echo $o['category_name']?>">
                 <datalist id="category_name">
                    <?php
                    $querry = pg_query($connect, "select * from categories");

                    while($list = pg_fetch_array($querry)){
                        ?>
                        <option value="<?= $list['category_name'];?>"><?=$list['category_name']; ?></option>
                        <?php
                    }
                    ?>
                </datalist>
              </div>
              <div class="form-group">
               <input class="form-control" name="company_name" list="company_name" placeholder="<?php echo $o['company_name'];?>">
                <datalist id="company_name">
                    <?php
                    $querry = pg_query($connect, "select * from suppliers");

                    while($list = pg_fetch_array($querry)){
                        ?>
                        <option value="<?= $list['company_name']; ?>"><?=$list['company_name']; ?></option>
                        <?php
                    }
                    ?>
                </datalist>
                <!-- <input type="text" name="company_name" placeholder="Masukan Nama Supplier" class="form-control" required> -->
              </div>
              <div class="form-group">
                <input type="submit" value="SUBMIT" class="btn btn-primary btn-block">
              </div>
            </form>
            <?php
                }
            ?>
            </div>    
        </div>
        <?php include('../fragments/script.php'); ?>
    </body>
</html>