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
                <h1 class="display-4" style="text-align: center;">Tambahkan Pelanggan</h1>
                <p class="lead" style="text-align: center;">Berikut ini merupakan form untuk mendaftar sebagai pelanggan baru</p>
                <hr class="my-4">
                <form action="create_check.php" method="post">
              <div class="form-group">
                <input type="text" name="company_name" placeholder="Masukan Nama Perusahaan" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="text" name="contact_name" placeholder="Masukan Nama yang dapat dihubungi" class="form-control" required>
              </div>
              <div class="form-group">
               <input type="text" name="city" placeholder="Masukan Kota" class="form-control" required>
              </div>
              <div class="form-group">
               <input type="text" name="country" placeholder="Masukan Negara" class="form-control" required>
              </div>
              <div class="form-group">
               <input type="tel" name="phone" placeholder="Masukan nomor telepon" class="form-control" required>
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