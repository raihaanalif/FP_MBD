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
                <form action="create_check.php" method="post">
              <div class="form-group">
                <input type="text" name="product_name" placeholder="Masukan Nama Produk" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="number" name="unit_price" placeholder="Masukan Harga" class="form-control" required>
              </div>
              <div class="form-group">
                <input class="form-control" name="category_name" list="category_name">
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
               <input class="form-control" name="company_name" list="company_name">
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
            </div>    
        </div>
        <?php include('../fragments/script.php'); ?>
    </body>
</html>