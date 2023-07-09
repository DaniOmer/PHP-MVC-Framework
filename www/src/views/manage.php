<?php

use App\core\Application;

$userId = Application::$app->user->getId();

$users = Application::$app->user->getAllBy('admin_id', $userId);

?>


<section>
    <div style="width:50%; margin:0 auto;">
        <h3>Here's the place to manage your users !</h3>
        <table style="width:100%; text-align:left" class="table ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr> 
            </thead>
            <tbody>
                <?php foreach($users as $key => $user): ?>
                    <tr>
                        <th scope="row"><?= $key +1 ?></th>
                        <td><?= $user->getFirstname() ?></td>
                        <td><?= $user->getLastname() ?></td>
                        <td><?= $user->getEmail() ?></td>
                        <td><?= $user->getRole() !== '' ? $user->getRole() : '-'  ?></td>

                        <td>
                            <a href="/dashboard/users/manage?edit=<?= $user->getId() ?>">
                                <button style="padding:5px; margin-top:10px" type="submit">Edit</button>
                            </a>
                        </td>
                        <td>
                            <a href="/dashboard/users/manage?delete=<?= $user->getId() ?>">
                                <button style="padding:5px; margin-top:10px" type="submit">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>
