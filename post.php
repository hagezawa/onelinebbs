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

    //TODO フォームから投稿→テーブルにデータ保存の処理が
    //     出来たので、リファクタリングをする
    //     その前に、ひとこと一覧の表示をする

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

        $comment = null;

        //ひとことが正しく入力されているかチェック
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

        //データ取得
        $select = "SELECT * FROM post";
        $rows = $dbh->query($select)->fetchALL();

        $dbh = null;
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ひとこと一覧</title>
</head>

<body>
    <ul>
        <?php foreach($rows as $row): ?>
            <?= $row['id'] . ' ' . $row['name'] . ' ' . $row['comment']; ?><br />
        <?php endforeach;?>
    </ul>

    <form action="send.php">
        <input type="submit" name="submit" value="送信" />
    </form>
</body>
</html>