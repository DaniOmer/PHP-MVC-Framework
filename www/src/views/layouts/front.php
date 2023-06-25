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
    <header style="width:80%; display:flex; justify-content:flex-end; margin:0 auto">
        <nav style="width:50%; display:flex; justify-content:space-between;">
            <ul style="display:flex; justify-content:space-between; list-style:none">
                <li style="list-style:none; margin-right:20px;">
                    <a href="/">Front office</a>
                </li>
                <li style="list-style:none; margin-left:10px"><a href="/" style="text-decoration: none; color:black">Home</a></li>
                <li style="list-style:none; margin-left:10px"><a href="/about" style="text-decoration: none; color:black">About</a></li>
                <li style="list-style:none; margin-left:10px"><a href="/contact" style="text-decoration: none; color:black">Contact</a></li>
                <li style="list-style:none; margin-left:10px"><a href="/faq" style="text-decoration: none; color:black">Faq</a></li>
            </ul>
            <?php if(Application::$app->isGuest()): ?>
            <ul style="display:flex; justify-content:space-between; list-style:none">
                <li style="list-style:none; margin-left:10px"><a href="/login" style="text-decoration: none; color:black">Login</a></li>
                <li style="list-style:none; margin-left:10px"><a href="/register" style="text-decoration: none; color:black">Register</a></li>
            </ul>
            <?php else: ?>
            <ul style="display:flex; justify-content:center; list-style:none">
                <li style="list-style:none; margin-left:10px">
                    <a href="/profile" style="text-decoration: none; color:black">
                        Profile
                    </a>
                </li>
                <li style="list-style:none; margin-left:10px">
                    <a href="/logout" style="text-decoration: none; color:black">
                        <?= Application::$app->user->getDisplayName()?> (Logout)
                    </a>
                </li>
            </ul>
            <?php endif ?>
        </nav>
    </header>

    <main>
        <?php if (Application::$app->session->getFlash('success')): ?>
        <div>
            <?= Application::$app->session->getFlash('success') ?>
        </div>
        <?php endif ?>
        {{content}}
    </main>
</body>
</html>