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
                $old=pg_query($connect, "select * from customers
                                         where customer_id = '$id'");
                while($o = pg_fetch_array($old)){
                ?>
                <form action="edit_check.php" method="post">
              <div class="form-group">
                <input type="hidden" name="customer_id" value="<?php echo $o['customer_id'];?>">
                <input type="text" name="company_name" placeholder="Masukan Nama Perusahaan" class="form-control" value="<?php echo $o['company_name']?>" required>
              </div>
              <div class="form-group">
                <input type="text" name="contact_name" placeholder="Masukan Nama yang Dapat Dihubungi" class="form-control" value="<?php echo $o['contact_name']?>"required>
              </div>
              <div class="form-group">
                <input class="form-control" name="city" placeholder="Masukan Asal Kota" value="<?php echo $o['city']?>">
              </div>
              <div class="form-group">
                <input class="form-control" name="country" placeholder="Masukan Asal Negara" value="<?php echo $o['country']?>">
              </div>
              <div class="form-group">
                <input class="form-control" name="phone" placeholder="Masukan Nomor Telepon" value="<?php echo $o['phone']?>">
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