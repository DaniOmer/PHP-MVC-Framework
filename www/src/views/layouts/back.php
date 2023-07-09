<?php

use App\core\Application;

$message = Application::$app->session->getFlash('success') ?? Application::$app->session->getFlash('alerte');

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
    <?php if (Application::$app->user) : ?>
    <header style="width:80%; display:flex; justify-content:flex-end; margin:0 auto">
        <nav style="width:50%;">
            <ul style="display:flex; justify-content:space-between; list-style:none">
                <li style="list-style:none; margin-right:35px;">
                    <a href="/">Back office</a>
                </li>
                <li style="list-style:none"><a href="/" style="text-decoration: none; color:black;">My website</a></li>
                <li style="list-style:none; margin-left:10px">
                    <a href="/logout" style="text-decoration: none; color:black">
                        <?=Application::$app->user->getDisplayName()?> (Logout)
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <aside>
                <nav>
                    <ul style="list-style:none">
                        <li>
                            Profile
                            <ul>
                                <li><a href="/dashboard/profile/edit">Account details</a></li>
                                <li><a href="/dashboard/profile/reset-password">Account security</a></li>
                            </ul>
                        </li>
                        <?php if(Application::$app->user->getRole() === 'admin'): ?>
                        <li>
                            <a href="/dashboard/users">Users</a>
                            <ul>
                                <li><a href="/dashboard/users/create">Add user</a></li>
                                <li><a href="/dashboard/users/manage">Manage users</a></li>
                            </ul>
                        </li>
                        <?php endif ?>
                        <li><a href="/dashboard/page">Pages</a></li>
                        <li><a href="/dashboard/comment">Comments</a></li>
                        <li><a href="/dashboard/chart">Chart</a></li>
                    </ul>
                </nav>
            </aside>

            <article>
                <?php if($message): ?>
                <div>
                    <?= $message ?>
                </div>
                <?php endif ?>
                
                {{content}}
            </article>
        </section>
    </main>
    <?php else: ?>
        {{content}}
    <?php endif ?>
</body>
</html>