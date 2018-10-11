<?php

    //データベースに接続
    $db = new PDO('mysql:host=localhost;dbname=oneline_bbs;charset=utf8', 'root', '');
    
    $result = $db->query("select * from oneline_bbs.post")
    ->fetch(PDO::FETCH_NUM);

    print_r($result);

    $db = null;
?>