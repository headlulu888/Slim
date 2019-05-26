<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/templates/css/style.css">
</head>
<body>
    <div class="wrap">
            <?php foreach ($list as $item): ?>
                <h2><?php echo $item; ?></h2>
            <?php endforeach; ?>
        <a href="<?php echo $link; ?>">Ссылка</a>
    </div>
</body>
</html>