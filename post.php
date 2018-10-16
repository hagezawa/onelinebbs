<?php

    $dsn = "mysql:host=localhost;dbname=oneline_bbs;charset=utf8";
    $user = 'root';
    $password = '';
    //データベースに接続

    try {
        $dbh = new PDO($dsn, $user, $password);
        
        //エラーの属性を設定、PDO::ERRMODE_EXCEPTIONで例外を投げる
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo 'Connection failed' . $e->getMessage();
    }

    $errors = array();

    //POSTなら保存処理実行
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = null;

        //バリデーションエラーがないか判定する
        if (!isset($_POST['name']) || !strlen($_POST['name'])) {
            $errors['name'] = '名前を入力してください';
        } elseif (strlen($_POST['name'] > 40)) {
            $errors['name'] = '名前は40文字以内で入力して下さい';
        } else {
            $name = $_POST['name'];
        }

        //ひとことが正しく入力されているかチェック
        $comment = null;

        if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
            $errors['comment'] = 'ひとことを入力して下さい';
        } elseif (strlen($_POST['name'] > 200)) {
            $errors['comment'] = 'ひとことは200文字以内で入力して下さい';
        } else {
            $comment = $_POST['comment'];
        }

        //エラーがなければ保存
        if (count($errors) === 0) {
            $stmt = $dbh->prepare('INSERT INTO post (name, comment, created_at) VALUES(?, ?, ?)');
            $stmt->execute(array($name, $comment, date('Y-m-d H:i:s')));


        }
    }

    $db = null;
?>