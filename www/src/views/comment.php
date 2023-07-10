
<?php

use App\core\Application;

?>

<section>
    <div style="width:50%; margin:0 auto;">
        <h3>Here's the place to manage comments !</h3>
        <table style="width:100%; text-align:left" class="table ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Owner Email</th>
                    <th scope="col">Content</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($comments as $key => $page): ?>
                    <tr>
                        <th scope="row"><?= $key +1 ?></th>
                        <td><?= $comment->getCommentName() ?></td>
                        <td><?= $comment->getCommentEmail() ?></td>
                        <td><?= $comment->getCommentText() ?></td>
                        <td><?= $comment->getCommentStatus() ?></td>
                        <?php if($comment->getCommentStatus() !== 'approve'): ?>
                        <td>
                            <a href="/dashboard/page/comment?approve=<?= $comment->getId() ?>">
                                <button style="padding:5px; margin-top:10px" type="submit">Approve</button>
                            </a>
                        </td>
                        <?php endif ?>
                        <td>
                            <a href="/dashboard/page/comment?delete=<?= $comment->getId() ?>">
                                <button style="padding:5px; margin-top:10px" type="submit">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?> 
            </tbody>
        </table>
    </div>
</section>
