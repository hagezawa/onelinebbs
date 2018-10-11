<!DOCTYPE html>

<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>フォーム</title>
    </head>

    <body>
        <?php if (isset($_GET['name']) && strlen($_GET['name']) > 0): ?>
            <p><?php echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8'); ?>さんこんにちは</p>
        <?php endif; ?>

        <form action="form.php" method="get">
            <p>
                <input type="text" name="name" />
                <input type="submit" value="送信" />
            </p>
        </form>

    </body>
</html>