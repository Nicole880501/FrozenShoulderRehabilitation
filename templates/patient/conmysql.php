<?php
  //資料庫主機設定
    $host = "152.70.81.246:33306";
    $username = "root";
    $password = "880501";
  //連線伺服器
    $link = @mysqli_connect($host, $username, $password);
    if(!$link) die("資料庫系統連結失敗！");
  //設定字元集與連線校對
    mysqli_set_charset($link, "utf8");
?>