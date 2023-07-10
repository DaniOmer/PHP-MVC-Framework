
<?php

use App\core\Application;

?>


<section>
    <div>
        <h3>Here's the place to manage your pages !</h3>
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Seo Title</th>
                    <th scope="col">Page URI</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pages as $key => $page): ?>
                    <tr>
                        <th scope="row"><?= $key +1 ?></th>
                        <td><?= $page->getTitle() !== '' ? $page->getTitle() : '-'  ?></td>
                        <td><?= $page->getSeoTitle() !== '' ? $page->getSeoTitle() : '-'  ?></td>
                        <td><?= $page->getPageUri() !== '' ? $page->getPageUri() : '-'  ?></td>
                        <td><?= $page->getOnMenu() !== '' ? $page->getOnMenu() : '-'  ?></td>
                        <td>
                            <a href="/<?= $page->getPageUri() ?>">
                                <button style="padding:5px; margin-top:10px" type="submit">View</button>
                            </a>
                        </td>
                        <?php if(Application::$app->isAdmin() || Application::$app->isEditor()): ?>
                        <td>
                            <a href="/dashboard/page/manage?edit=<?= $page->getId() ?>">
                                <button style="padding:5px; margin-top:10px" type="submit">Edit</button>
                            </a>
                        </td>
                        <td>
                            <a href="/dashboard/page/manage?delete=<?= $page->getId() ?>">
                                <button style="padding:5px; margin-top:10px" type="submit">Delete</button>
                            </a>
                        </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?> 
            </tbody>
        </table>
    </div>
</section>
