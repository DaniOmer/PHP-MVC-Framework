<?php
 /*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/views/layouts/back.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

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
    <header>
        <nav>
            <ul>
                <li><a href="/" style="text-decoration: none; color:black;">Website Home</a></li>
                <l>
                <?php if (!Application::$app->isGuest()) : ?>
                    <a href="/logout" style="text-decoration: none; color:black">
                        <?=Application::$app->user->getDisplayName()?> (Logout) 
                    </a>
                <?php endif; ?>
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
                        <?php if(Application::$app->isAdmin()): ?>
                        <li>
                            Users
                            <ul>
                                <li><a href="/dashboard/users/create">Add user</a></li>
                                <li><a href="/dashboard/users/manage">Manage users</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <li>
                            Pages
                            <ul>
                                <?php if(Application::$app->isAdmin()): ?>
                                <li><a href="/dashboard/page/create">Create page</a></li>
                                <?php endif; ?>
                                <?php if(Application::$app->isAdmin() || Application::$app->isEditor()): ?>
                                <li><a href="/dashboard/page/manage">Manage pages</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li>
                            Comments
                                <ul>
                                    <li><a href="/dashboard/page/comment">Manage Comments</a></li>
                                </ul>
                        </li>
                        <li>Statistics</li>
                    </ul>
                </nav>
            </aside>

            <article>
            <?php if (Application::$app->session->getFlash('success')): ?>
            <div class="alert alert-success">
                <?= Application::$app->session->getFlash('success') ?>
            </div>
            <?php endif ?>
            <?php if (Application::$app->session->getFlash('alerte')): ?>
            <div class="alert alert-warning">
                <?= Application::$app->session->getFlash('alerte') ?>
            </div>
            <?php endif; ?>
                {{content}}
            </article>
        </section>
    </main>
</body>
</html>