<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>あいさつ</title>
    </head>

    <body>
        <?php date_default_timezone_set('Asia/Tokyo'); ?>
        
        <?php $hour = date('H'); ?>

        <?php if ($hour >= 5 && $hour <= 10): ?>
            <p>おはようございます</p>
        <?php elseif ($hour > 10 && $hour <= 18): ?>
            <p>こんにちは</p>
        <?php else:?>
            <p>こんばんは</p>
        <?php endif; ?>

        <p>現在の時刻は<?= $hour; ?>時です。</p>
    </body>
</html>