<!DOCTYPE html>

<html lang="ja">
    <head>
        <title>ひとこと掲示板</title>
    </head>

    <body>
        <h1>ひとこと掲示板</h1>
        
        <form action="bbs.php" method="post">
            名前:<input type="text" name="name" /><br />
            ひとこと:<input type="text" name="oneline" size="60" /><br />
            <input type="submit" name="submit" value="送信" />
        </form>

    </body>
</html>