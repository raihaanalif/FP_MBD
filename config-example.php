<?php

$connect = pg_connect("host=localhost dbname=fp-mbd user=postgres password=");

if(!$connect){
    echo "Koneksi Gagal";
}

?>