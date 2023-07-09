<?php

use App\core\Application;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our application front office</title>
</head>
<body>
    <main>
    <?php if (Application::$app->session->getFlash('alerte')): ?>
        <div>
            <?= Application::$app->session->getFlash('alerte')  ?>
        </div>
    <?php endif ?>
        {{content}}
    </main>
</body>
</html>